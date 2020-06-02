<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('mian/M_auth', 'mymodel');
  }

  public function index()
  {
    $data['system_settings'] = $this->db->get_where('system_settings', ['id' => '1'])->row();
    if ($this->session->userdata('admin_logged_in') == TRUE) {
      redirect('mian/dashboard');
    } else {
      if (!empty(get_cookie('admmian')) || !empty(get_cookie('identity'))) {
        $cek = $this->db->get_where('administrator', ['remember_code' => get_cookie('admmian'), 'email' => get_cookie('identity'), 'status' => '1']);
        if ($cek->num_rows() > 0) {
          $data = $cek->row();
          $this->session->set_userdata('admin_logged_in', TRUE);
          $this->session->set_userdata('admin_id', $data->id);
          redirect(base_url($data['system_settings']['system_login']));
        } else {
          $this->load->backend_view('login', $data);
        }
      } else {
        $this->load->backend_view('login', $data);
      }
    }
  }

  function login()
  {
    $email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
    $remember_me = htmlspecialchars($this->input->post('remember_me', TRUE), ENT_QUOTES);
    $cek = $this->mymodel->auth_user($email);
    if ($cek->num_rows() > 0) {
      $data = $cek->row_array();
      $password = $data['password'];
      if (password_verify($this->input->post('password'), $password)) {
        $this->mymodel->update_login($email, $password);
        if (!empty($remember_me)) {
          $this->mymodel->update_remember($email, $password);
          $data = $this->mymodel->auth_user($email, $password)->row_array();
          set_cookie(array('name' => 'admmian', 'value'  => $data['remember_code'], 'expire'   => 3600 * 24 * 90, 'prefix'   => ''));
          set_cookie(array('name' => 'identity', 'value'  => $data['email'], 'expire'   => 3600 * 24 * 90, 'prefix'   => ''));
        }
        $this->session->set_userdata('admin_logged_in', TRUE);
        $this->session->set_userdata('admin_id', $data['id']);
        redirect('mian/dashboard');
      } else {
        $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Incorrect password
        </div>');
        $url = base_url($system_settings->system_login);
        redirect($url);
      }
    } else {
      $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      Email not registered
      </div>');
      $url = base_url($system_settings->system_login);
      redirect($url);
    }
  }

  function forgot_password()
  {
    $this->load->backend_view('forgot_password');
  }

  public function reset_password()
  {
    $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
    $email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
    $cek = $this->mymodel->auth_user($email);

    if ($cek->num_rows() > 0) {
      $this->mymodel->update_token($email);
      $token = $this->db->get_where('administrator', ["email" => $email])->row();
      $mail = $this->db->get_where('smtp', ["id" => 1])->row();
      $settings = $this->db->get_where('system_settings', ["id" => 1])->row();

      $config = array();
      $config['mailtype'] = "html";
      $config['charset'] = 'utf-8';
      if ($settings->mail == 1) {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $email_sender = 'noreply@andreyansyah.com';
      } else {
        $config['useragent'] = 'Codeigniter';
        $config['protocol'] = "smtp";
        $config['smtp_host'] = $mail->host;
        $config['smtp_port'] = $mail->port;
        $config['smtp_timeout'] = "400";
        $config['smtp_crypto'] = $mail->secure;;
        $config['smtp_user'] = $mail->username;
        $config['smtp_pass'] = $mail->password;
        $email_sender = $config['smtp_user'];
      }
      $config['crlf'] = "\r\n";
      $config['newline'] = "\r\n";
      $config['wordwrap'] = TRUE;
      $this->email->initialize($config);
      $this->email->from($email_sender);
      $this->email->to($email);
      $this->email->subject("Reset Password");
      $this->email->message(site_url($system_settings->system_login . "/login/change/" . $token->reset_password));

      if ($this->email->send()) {
        $this->session->set_flashdata('notice', 'A password reset link has been sent to your e-mail address, check your e-mail to change password');
        $this->load->backend_view('notice');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Notification failed to send</div>');
        redirect(base_url($system_settings->system_login . '/login/forgot_password'));
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      Email is not registered</div>');
      redirect(base_url($system_settings->system_login . '/login/forgot_password'));
    }
  }

  function change($token)
  {
    if (!isset($token)) redirect('notfound');
    $cek_token = $this->mymodel->cek_token($token);
    if ($cek_token->num_rows() > 0) {
      $data['token'] = $token;
      $this->load->backend_view('reset_password', $data);
    } else {
      $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
      $url = base_url($system_settings->system_login);
      redirect($url);
    }
  }

  function change_password($token)
  {
    $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
    if (!isset($token)) redirect('notfound');
    $cek_token = $this->mymodel->cek_token($token);
    if ($cek_token->num_rows() > 0) {
      $password_1 = htmlspecialchars($this->input->post('password_1', TRUE), ENT_QUOTES);
      $password_2 = htmlspecialchars($this->input->post('password_2', TRUE), ENT_QUOTES);
      if ($password_1 == $password_2) {
        $data = $cek_token->row();
        $this->mymodel->update_password($token, $password_1);
        $this->mymodel->update_token($data->email);
        $this->session->set_flashdata('notice', 'Password successfully changed, please login again');
        $this->load->backend_view('notice');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Password is different!
        </div>');
        redirect($system_settings->system_login . '/login/change/' . $token);
      }
    }
  }

  function logout()
  {
    delete_cookie('admmian');
    delete_cookie('identity');
    $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row();
    $this->session->sess_destroy();
    redirect(base_url($system_settings->system_login));
  }
}
