<?php (defined('BASEPATH')) or exit('No direct script access allowed');
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader
{
  private $_ci;

  function backend_view($view, $vars = array(), $return = FALSE)
  {
    $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH . 'pmworks/views/' => TRUE));
    return $this->_ci_load(array(
      '_ci_view' => $view,
      '_ci_vars' => $this->_ci_prepare_view_vars($vars),
      '_ci_return' => $return
    ));
  }

  function frontend_view($view, $vars = array(), $return = FALSE)
  {
    $this->_ci = &get_instance();
    $this->_ci->load->database();
    $themes = $this->_ci->db->get_where('themes', array('id' => '1'))->row();
    $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH . 'themes/' . $themes->folder . '/views/' => TRUE));
    return $this->_ci_load(array(
      '_ci_view' => $view,
      '_ci_vars' => $this->_ci_prepare_view_vars($vars),
      '_ci_return' => $return
    ));
  }

  public function admin_view($template_name, $vars = array(), $return = FALSE)
  {
    if ($this->session->userdata('admin_logged_in') == TRUE) {
      if ($return) :
        $content  = $this->backend_view('header', $vars, $return);
        $content .= $this->backend_view($template_name, $vars, $return);
        $content .= $this->backend_view('footer', $vars, $return);

        return $content;
      else :
        $this->backend_view('header', $vars);
        $this->backend_view($template_name, $vars);
        $this->backend_view('footer', $vars);
      endif;
    } else {
      if (!empty(get_cookie('admmian')) || !empty(get_cookie('identity'))) {
        $cek = $this->db->get_where('administrator', array('remember_code' => get_cookie('admmian'), 'email' => get_cookie('identity'), 'status' => '1'));
        if ($cek->num_rows() > 0) {
          $data = $cek->row_array();
          $this->session->set_userdata('admin_logged_in', TRUE);
          $this->session->set_userdata('admin_id', $data['id']);
          if ($return) :
            $content  = $this->backend_view('header', $vars, $return);
            $content .= $this->backend_view($template_name, $vars, $return);
            $content .= $this->backend_view('footer', $vars, $return);

            return $content;
          else :
            $this->backend_view('header', $vars);
            $this->backend_view($template_name, $vars);
            $this->backend_view('footer', $vars);
          endif;
        } else {
          redirect('notfound');
        }
      } else {
        redirect('notfound');
      }
    }
  }
}
