<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
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

//$route['default_controller'] = 'welcome';

$route['default_controller'] = 'pages/';
$route['(:any)'] = 'pages/$1';
$route['404_override'] = '';
$route['demo/query'] = 'query_controller';
$route['demo/insert'] = 'insert_controller';
$route['demo/update'] = 'update_controller';
$route['demo/delete'] = 'delete_controller';
$route['register'] = 'register';
$route['login'] = 'login';
$route['logout'] = 'login/logout';
$route['browse'] = 'browse';
$route['browse/(:any)'] = 'browse/index/$1';
$route['browse/(:any)/(:any)'] = 'browse/index/$1/$2';
$route['browse/(:any)/(:any)/(:any)'] = 'browse/index/$1/$2/$3';
$route['search'] = 'search';
$route['dashboard'] = 'dashboard';
$route['profile'] = 'profile';
$route['profile/update'] = 'profile/update';
$route['profile/updateCompanyProfile'] = 'profile/updateCompanyProfile';
$route['profile/(:any)'] = 'profile/index/$1';
$route['admin'] = 'admin';
$route['job_list'] = 'job_list';
$route['company'] = 'company';
$route['job'] = 'job';
$route['job/apply_job'] = 'job/apply_job';
$route['job/delete'] = 'job/delete';
$route['job/delete_application'] = 'job/delete_application';
$route['job/create'] = 'job/create';
$route['job/create_job'] = 'job/create_job';
$route['job/update'] = 'job/update';
$route['job/(:any)'] = 'job/index/$1';
$route['job_match'] = 'job_match';
$route['translate_uri_dashes'] = FALSE;
