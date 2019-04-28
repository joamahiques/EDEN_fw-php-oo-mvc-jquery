<?php
// console_log($_SESSION('module'));
if (!isset($_GET['module'])){
    $_GET['module'] = 'home';
}
// echo($_GET['module']);
// exit;

//SITE_ROOT
$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
define('SITE_ROOT', $path);
//SITE_PATH
define('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . '/www/EDEN/');
//CSS
define('CSS_PATH', SITE_PATH . 'view/css/');
//JS
define('JS_PATH', SITE_PATH . 'view/js/');
//IMG
define('IMG_PATH', SITE_PATH . 'view/img/');
//model
define('MODEL_PATH', SITE_ROOT . 'model/');
//view
define('VIEW_PATH_INC', SITE_ROOT . 'view/include/');
define('VIEW_PATH_INC_ERROR', SITE_ROOT . 'view/include/error/');
//modules
define('MODULES_PATH', SITE_ROOT . 'module/');
///components
define('COMPONENTS_PATH', SITE_ROOT . 'components/');
//resources
define('RESOURCES', SITE_ROOT . 'resources/');
//media
define('MEDIA_PATH', SITE_ROOT . 'media/');
//utils
define('UTILS', SITE_ROOT . 'utils/');
//LOGS
define('USER_LOG_DIR',SITE_ROOT . 'log/user/Site_User_errors.log');
define('GENERAL_LOG_DIR',SITE_ROOT . 'log/general/Site_General_errors.log');
///MODULES
define('FUNCTIONS_MODULE', SITE_ROOT . 'module/'.$_GET['module'].'/utils/');
define('MODEL_PATH_MODULE', SITE_ROOT . 'module/'.$_GET['module'].'/model/');
define('DAO_MODULE', SITE_ROOT . 'module/'.$_GET['module'].'/model/DAO/');
define('BLL_MODULE', SITE_ROOT . 'module/'.$_GET['module'].'/model/BLL/');
define('MODEL_MODULE', SITE_ROOT . 'module/'.$_GET['module'].'/model/model/');
define('MODULE_JS_PATH', SITE_PATH . 'module/'.$_GET['module'].'/view/js/');
define('MODULE_VIEW_PATH', SITE_ROOT . 'module/'.$_GET['module'].'/view/');
//JS MODULES
define('HOME_JS_PATH', SITE_PATH . 'module/home/view/js/');
define('SHOP_JS_PATH', SITE_PATH . 'module/shop/view/js/');
define('CONTACT_JS_PATH', SITE_PATH . 'module/contact/view/js/');
define('LOGIN_JS_PATH', SITE_PATH . 'module/login/view/js/');
define('PROFILE_JS_PATH', SITE_PATH . 'module/profile/view/js/');
define('HOMES_JS_PATH', SITE_PATH . 'module/crud/view/js/');
define('CART_JS_PATH', SITE_PATH . 'module/cart/view/js/');
define('USERFAVORITES_JS_PATH', SITE_PATH . 'module/userfavorites/view/js/');
///JS COMPONENTS


////COMPONENTS
// LOGIN
define('FUNCTIONS_LOGIN', SITE_ROOT . '/login/');
// define('MODEL_PATH_LOGIN', SITE_ROOT . 'components/login/model/');
// define('DAO_LOGIN', SITE_ROOT . 'components/login/model/DAO/');
// define('BLL_LOGIN', SITE_ROOT . 'components/login/model/BLL/');
// define('MODEL_LOGIN', SITE_ROOT . 'components/login/model/model/');
define('LOGIN_VIEW_PATH', SITE_ROOT . 'module/login/view/');/////no borrar
///FAVORITES
define('MODEL_PATH_FAVORITES', SITE_ROOT . 'components/favorites/model/');
define('DAO_FAVORITES', SITE_ROOT . 'components/favorites/model/DAO/');
define('BLL_FAVORITES', SITE_ROOT . 'components/favorites/model/BLL/');
define('MODEL_FAVORITES', SITE_ROOT . 'components/favorites/model/model/');
define('FAVORITES_JS_PATH', SITE_PATH . 'components/favorites/view/js/');
define('FAVORITES_VIEW_PATH', SITE_ROOT . 'components/favorites/view/');
///MODAL
define('MODEL_MODAL', SITE_ROOT . 'components/modal/model/model/');
define('MODAL_JS_PATH', SITE_PATH . 'components/modal/view/js/');
///SEARCH
define('MODEL_SEARCH', SITE_ROOT . 'components/search/model/model/');
define('SEARCH_JS_PATH', SITE_PATH . 'components/search/view/js/');
///GEOAPI
define('GEOAPI_JS_PATH', SITE_PATH . 'components/apis/geoapi/');

//CLUBRURAL
define('CRURAL_JS_PATH', SITE_PATH . 'components/apis/clubrural/');

//amigables
define('URL_AMIGABLES', TRUE);
//produccion
define('PRODUCTION', TRUE);







// HOME
// define('FUNCTIONS_HOME', SITE_ROOT . 'module/home/utils/');
// define('MODEL_PATH_HOME', SITE_ROOT . 'module/home/model/');
// define('DAO_HOME', SITE_ROOT . 'module/home/model/DAO/');
// define('BLL_HOME', SITE_ROOT . 'module/home/model/BLL/');
// define('MODEL_HOME', SITE_ROOT . 'module/home/model/model/');
// define('HOME_JS_PATH', SITE_PATH . 'module/home/view/js/');
// define('HOME_VIEW_PATH', SITE_ROOT . 'module/home/view/');


// SHOP
// define('FUNCTIONS_SHOP', SITE_ROOT . 'module/shop/utils/');
// define('MODEL_PATH_SHOP', SITE_ROOT . 'module/shop/model/');
// define('DAO_SHOP', SITE_ROOT . 'module/shop/model/DAO/');
// define('BLL_SHOP', SITE_ROOT . 'module/shop/model/BLL/');
// define('MODEL_SHOP', SITE_ROOT . 'module/shop/model/model/');
// define('SHOP_JS_PATH', SITE_PATH . 'module/shop/view/js/');
// define('SHOP_VIEW_PATH', SITE_ROOT . 'module/shop/view/');





