<?php
require_once("paths.php");
require ('autoload.php');
include(UTILS . "functions.inc.php");
include(UTILS . "errors.inc.php");
include(UTILS . "common.inc.php");
//include(UTILS . "filters.inc.php");

if (PRODUCTION) { //estamos en producción
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ERROR | E_WARNING); //error_reporting(E_ALL) ;
    //error_reporting(E_ALL) ; | E_NOTICE --> commit E_NOTICE to use timeout userdao_country
} else {
    ini_set('display_errors', '0');
    ini_set('error_reporting', '0'); //error_reporting(0); 
}


$_SESSION['module'] = "";

function handlerRouter() {
    if (!empty($_GET['module'])) {
        $URI_module = $_GET['module'];
    } else {
        $URI_module = 'home';
    }
       
    if (!empty($_GET['function'])) {
        $URI_function = $_GET['function'];
    } else {
        // $URI_function = 'begin';
        $URI_function = 'list_home';
    }
    
    handlerModule($URI_module, $URI_function);
}

function handlerModule($URI_module, $URI_function) {
    $modules = simplexml_load_file('resources/modules.xml');
    $exist = false;

    foreach ($modules->module as $module) {
        if (($URI_module === (String) $module->uri)) {///module exist
            $exist = true;
            //  echo($URI_module);
            $path = MODULES_PATH . $URI_module . "/controller/controller_" . $URI_module . ".class.php";
            
            if (file_exists($path)) {///controller exist
                require_once($path);
                
                $controllerClass = "controller_" . $URI_module;
                
                $obj = new $controllerClass;
            } else {
                //die($URI_module . ' - Controlador no encontrado');
                require_once(VIEW_PATH_INC ."top-page.php");
                if ((!empty($_GET['module']))||($_GET['module']==='home')){
                    require_once(VIEW_PATH_INC ."header-home.php");///si estamos en homepage
                }else{
                    require_once(VIEW_PATH_INC ."header.php");
                } 
               
                if(!isset($_SESSION['type'])){
                    require_once(VIEW_PATH_INC ."menu.php");
                }else if ($_SESSION['type']==='client'){
                    require_once(VIEW_PATH_INC ."menuuser.php");   
                }else if($_SESSION['type']==='admin'){
                    require_once(VIEW_PATH_INC ."menuadmin.php");   
                } 
                
                require_once(VIEW_PATH_INC_ERROR . "error404.php");
                require_once(VIEW_PATH_INC . "footer.php");
            }
            handlerfunction(((String) $module->name), $obj, $URI_function);
            break;
        }
    }
    if (!$exist) {
        //die($URI_module . ' - Controlador no encontrado');
        require_once(VIEW_PATH_INC ."top-page.php");
        require_once(VIEW_PATH_INC . "header.php");

        if(!isset($_SESSION['type'])){
            require_once(VIEW_PATH_INC ."menu.php");
        }else if ($_SESSION['type']==='client'){
            require_once(VIEW_PATH_INC ."menuuser.php");   
        }else if($_SESSION['type']==='admin'){
            require_once(VIEW_PATH_INC ."menuadmin.php");   
        } 
        // require_once(VIEW_PATH_INC . "menu.php");
        require_once(VIEW_PATH_INC_ERROR . "error404.php");
        // showErrorPage(1, "", 'HTTP/1.0 400 Bad Request', 400);
        require_once(VIEW_PATH_INC . "footer.php");
    }
}

function handlerFunction($module, $obj, $URI_function) {
    $functions = simplexml_load_file(MODULES_PATH . $module . "/resources/functions.xml");
    $exist = false;
       
    foreach ($functions->function as $function) {
        if (($URI_function === (String) $function->uri)) {
            $exist = true;
            $event = (String) $function->name;
            break;
        }
    }
    if (!$exist) {
        // die($URI_function . ' - Funci&oacute;n no encontrada');
        require_once(VIEW_PATH_INC ."top-page.php");
        require_once(VIEW_PATH_INC . "header.php");
        if(!isset($_SESSION['type'])){
            require_once(VIEW_PATH_INC ."menu.php");
        }else if ($_SESSION['type']==='client'){
            require_once(VIEW_PATH_INC ."menuuser.php");   
        }else if($_SESSION['type']==='admin'){
            require_once(VIEW_PATH_INC ."menuadmin.php");   
        } 
        // require_once(VIEW_PATH_INC . "menu.php");
        require_once(VIEW_PATH_INC_ERROR . "error404.php");
        // showErrorPage(1, "", 'HTTP/1.0 400 Bad Request', 400);
        require_once(VIEW_PATH_INC . "footer.php");
    } else {
        //$obj->$event();
        call_user_func(array($obj, $event));
    }
}

handlerRouter();
