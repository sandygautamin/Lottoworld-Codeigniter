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
//$route['default_controller'] = 'users';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['/'] = '/home/index';
//$route['default_controller'] = 'users/index';
//$route['(:any)'] = 'pages/view/$1';


// $route['news'] = 'news';
// $route['news/create'] = 'news/create';
 
// $route['news/edit/(:any)'] = 'news/edit/$1';
 
// $route['news/view/(:any)'] = 'news/view/$1';
// $route['news/(:any)'] = 'news/view/$1';

$route['upload'] = 'Upload';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['cart'] = 'lottery/cart';
$route['cart/delete'] = 'lottery/delete_cart';
$route['checkout_payment'] = 'lottery/checkout_payment';
$route['thankyou'] = 'home/thankyou';
$route['process'] = 'home/process';
$route['support'] = 'home/support';
$route['about-us'] = 'home/about_us';
$route['privacy-policy'] = 'home/privacy_policy';
$route['update_order'] = 'lottery/update_order';
$route['callback'] = 'lottery/callback';
$route['lotteries'] = 'lottery/lotteries';
$route['lottery-results'] = 'lottery/lottery_result';
$route['login-signup'] = 'users/frontend_login_signup';
//$route[$val] = 'lottery/index/$1';
$default_lottery= $this->config->item('default_lotto_links');
foreach($default_lottery as $val){
    $route[$val] = 'lottery/index/$1';
}


$route['admin/login'] = 'admin/login/loginMe';
$route['admin/dashboard'] = 'admin/user';
$route['admin/logout'] = 'admin/user/logout';
$route['admin/userListing'] = 'admin/user/userListing';
$route['admin/userListing/(:num)'] = "admin/user/userListing/$1";
$route['admin/addNew'] = "admin/user/addNew";
$route['admin/addNewUser'] = "admin/user/addNewUser";
$route['admin/editOld'] = "admin/user/editOld";
$route['admin/editOld/(:num)'] = "admin/user/editOld/$1";
$route['admin/editUser'] = "admin/user/editUser";
$route['admin/deleteUser/(:any)'] = "admin/user/deleteUser/$1";
$route['admin/profile'] = "admin/user/profile";
$route['admin/profile/(:any)'] = "admin/user/profile/$1";
$route['profileUpdate'] = "admin/user/profileUpdate";
$route['profileUpdate/(:any)'] = "admin/user/profileUpdate/$1";

$route['admin/tickets'] = 'admin/tickets/index';
$route['admin/tickets/(:any)'] = "admin/tickets/index/$1";
$route['admin/ticketDetails/(:num)'] = "admin/tickets/ticket/$1";

$route['admin/paymentList'] = 'admin/payments/index';
$route['admin/paymentList/(:num)'] = "admin/payments/index/$1";

$route['admin/lotteries'] = 'admin/lottery/index';
$route['admin/addLottery'] = "admin/lottery/addNew";
$route['admin/addNewLottery'] = "admin/lottery/addNewLottery";
$route['admin/editLottery'] = "admin/lottery/editLottery";
$route['admin/editLottery/(:num)'] = "admin/lottery/editLottery/$1";
$route['admin/editLottery2/(:num)'] = "admin/lottery/editLottery2/$1";
$route['admin/lotteries/(:num)'] = 'admin/lottery/index/$1';
$route['admin/deleteLottery/(:any)'] = "admin/lottery/deleteLottery/$1";
$route['order_success'] = "lottery/order_success";
$route['order_decline'] = "lottery/order_decline";

$route['admin/addProductDraws'] = "admin/draws/addNew";
$route['admin/addDraw'] = "admin/draws/addNewDraws";
$route['admin/editDraws'] = "admin/draws/editDraws";
$route['admin/editDraws/(:num)'] = "admin/draws/editDraws/$1";
$route['admin/editDraws2/(:num)'] = "admin/draws/editDraws2/$1";
$route['admin/deleteDraw/(:any)'] = "admin/draws/deleteDraw/$1";
$route['admin/productDrawsList'] = 'admin/draws/index';
$route['admin/productDrawsList/(:num)'] = 'admin/draws/index/$1';

$route['loadChangePass'] = "admin/user/loadChangePass";
$route['changePassword'] = "admin/user/changePassword";
$route['changePassword/(:any)'] = "admin/user/changePassword/$1";
$route['pageNotFound'] = "admin/user/pageNotFound";
$route['checkEmailExists'] = "admin/user/checkEmailExists";
$route['login-history'] = "admin/user/loginHistoy";
$route['login-history/(:num)'] = "admin/user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "admin/user/loginHistoy/$1/$2";

$route['admin/forgotPassword'] = "admin/login/forgotPassword";
$route['resetPasswordUser'] = "admin/login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "admin/login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "admin/login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "admin/login/resetPasswordConfirmUser/$1/$2";

