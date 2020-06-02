<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

  function auth_user($email)
  {
    $query = $this->db->query("SELECT * FROM administrator WHERE email='$email' AND status='1'");
    return $query;
  }

  function update_remember($email, $password)
  {
    $data = array(
      'remember_code' => random_string('alpha', 16)
    );

    $this->db->where('email', $email);
    $this->db->where('password', $password);
    $this->db->update('administrator', $data);

    return true;
  }

  function update_login($email, $password)
  {
    $data = array(
      'last_login' => date('Y-m-d H:i:s'),
      'ip' => $_SERVER['SERVER_ADDR']
    );

    $this->db->where('email', $email);
    $this->db->where('password', $password);
    $this->db->update('administrator', $data);

    return true;
  }

  function update_token($email)
  {
    $data = array(
      'reset_password' => random_string('alnum', 16)
    );

    $this->db->where('email', $email);
    $this->db->update('administrator', $data);

    return true;
  }

  function cek_token($token)
  {
    $query = $this->db->query("SELECT * FROM administrator WHERE reset_password='$token' LIMIT 1");
    return $query;
  }

  function update_password($token, $password)
  {
    $data = array(
      'password' => password_hash($password, PASSWORD_DEFAULT)
    );

    $this->db->where('reset_password', $token);
    $this->db->update('administrator', $data);

    return true;
  }
}
