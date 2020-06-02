<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
if (file_exists($file_path = APPPATH . 'config/database.php')) {
  include($file_path);
}
$config = $db[$active_group];
if ($config['dbdriver'] === 'mysqli') {
  $host = $config['hostname'];
  $username = $config['username'];
  $database = $config['database'];
  if (!empty($host) && !empty($username) && !empty($database)) {
    require_once(BASEPATH . 'database/DB' . EXT);
    $db = &DB();
    $system_settings = $db->get('system_settings')->row();
    $route[$system_settings->system_login] = 'mian/auth';
    $route['mian/auth'] = $system_settings->system_login;
    $route[$system_settings->system_login . '/auth/forgot_password'] = 'mian/auth/forgot_password';
    $route['mian/auth/forgot_password'] = $system_settings->system_login . '/auth/forgot_password';
    $route[$system_settings->system_login . '/auth/reset_password'] = 'mian/auth/reset_password';
    $route['mian/auth/reset_password'] = $system_settings->system_login . '/auth/reset_password';
    $route[$system_settings->system_login . '/auth/change/(.+)'] = 'mian/auth/change/$1';
    $route['mian/auth/change/(.+)'] = $system_settings->system_login . '/auth/change/$1';
    $route[$system_settings->system_login . '/auth/change_password/(.+)'] = 'mian/auth/change_password/$1';
    $route['mian/auth/change_password/(.+)'] = $system_settings->system_login . '/auth/change_password/$1';
    $route[$system_settings->system_login . '/auth/logout'] = 'mian/auth/logout';
    $route['mian/auth/logout'] = $system_settings->system_login . '/auth/logout';
  }
}

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
