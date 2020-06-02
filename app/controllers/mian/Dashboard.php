<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('mian/M_dashboard', 'mymodel');
  }

  function index()
  {
    $statistik = $this->mymodel->get_stat()->result();
    $data['get_stat'] = json_encode($statistik);
    $data['controller'] = str_replace('_', ' ', $this->router->fetch_class());
    $this->load->admin_view('dashboard/index', $data);
  }
}
