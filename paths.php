<?php
// console_log($_SESSION('module'));
//console_log($_SESSION('module'));

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
//resources
define('RESOURCES', SITE_ROOT . 'resources/');
//media
define('MEDIA_PATH', SITE_ROOT . 'media/');
//utils
define('UTILS', SITE_ROOT . 'utils/');
//LOGS
define('USER_LOG_DIR',SITE_ROOT.'log/user/Site_User_errors.log');
define('GENERAL_LOG_DIR',SITE_ROOT.'log/general/Site_General_errors.log');
// LOGIN
define('FUNCTIONS_LOGIN', SITE_ROOT . 'components/login/');
define('MODEL_PATH_LOGIN', SITE_ROOT . 'components/login/model/');
define('DAO_LOGIN', SITE_ROOT . 'components/login/model/DAO/');
define('BLL_LOGIN', SITE_ROOT . 'components/login/model/BLL/');
define('MODEL_LOGIN', SITE_ROOT . 'components/login/model/model/');
define('LOGIN_JS_PATH', SITE_PATH . 'components/login/view/js/');
define('LOGIN_VIEW_PATH', SITE_ROOT . 'components/login/view/');

// HOME
define('FUNCTIONS_HOME', SITE_ROOT . 'module/home/utils/');
define('MODEL_PATH_HOME', SITE_ROOT . 'module/home/model/');
define('DAO_HOME', SITE_ROOT . 'module/home/model/DAO/');
define('BLL_HOME', SITE_ROOT . 'module/home/model/BLL/');
define('MODEL_HOME', SITE_ROOT . 'module/home/model/model/');
define('HOME_JS_PATH', SITE_PATH . 'module/home/view/js/');
define('HOME_VIEW_PATH', SITE_ROOT . 'module/home/view/');

// SHOP
define('FUNCTIONS_SHOP', SITE_ROOT . 'module/shop/utils/');
define('MODEL_PATH_SHOP', SITE_ROOT . 'module/shop/model/');
define('DAO_SHOP', SITE_ROOT . 'module/shop/model/DAO/');
define('BLL_SHOP', SITE_ROOT . 'module/shop/model/BLL/');
define('MODEL_SHOP', SITE_ROOT . 'module/shop/model/model/');
define('SHOP_JS_PATH', SITE_PATH . 'module/shop/view/js/');
define('SHOP_VIEW_PATH', SITE_ROOT . 'module/shop/view/');


//amigables
define('URL_AMIGABLES', TRUE);
define('PRODUCTION', TRUE);