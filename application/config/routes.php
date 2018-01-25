<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['404_override'] = '';

// alert Routes
$route['scheduler'] = "scheduler";
$route['scheduler/(.+)'] = "scheduler/index/$1";

// genexpertsms Routes
$route['genexpertsms'] = "genexpertsms";
$route['genexpertsms/(.+)'] = "genexpertsms/index/$1";

// autosms Routes
$route['sms'] = "sms";
$route['sms/(.+)'] = "sms/index/$1";

$route['smsauto'] = "smsauto";
$route['smsauto/(.+)'] = "smsauto/index/$1";

// Gx Routes
$route['gx'] = "gx";
$route['gx/(.+)'] = "gx/index/$1";
