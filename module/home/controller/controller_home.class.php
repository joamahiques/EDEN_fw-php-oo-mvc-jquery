<?php

class controller_home {
    function __construct() {
        // include(FUNCTIONS_HOME . "utils.inc.php");
        $_SESSION['module'] = "home";
    }

    function list_home() {
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header-home.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(HOME_VIEW_PATH . "home.php");

        //  loadView('modules/products/view/', 'home.php');
        

        require_once(VIEW_PATH_INC . "footer.php");
    }

function scroll_home() {
    $totalResults = loadModel(MODEL_HOME, "home_model", "count");/// to count the total of houses
        if( isset($_POST['p']) ){
            $page					=	intval($_POST['p']);//number of page
            $current_page			=	$page - 1;
            $records_per_page		=	6; // records to show per page
            $start					=	$current_page * $records_per_page;//first limit to search
            $arrArgument = array(
                'start'=>$start,
                'records'=>$records_per_page
            );
            $arrValue = loadModel(MODEL_HOME, "home_model", "select_scroll", $arrArgument);
            $result= array('totalcount'=>$totalResults,'results' => $arrValue);
            echo json_encode($result);
            exit;
        }
}
}
//     $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
   
//     include($path ."module/home/model/DAOhome.php");
//     @session_start();
//     $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/home/model/model/';
//     include ($path . "/utils/common.inc.php");
       
//     switch($_GET['op']){
//             case 'lis':
//                 $totalResults = loadModel($path_model, "home_model", "count");/// to count the total of houses
//                 if( isset($_POST['p']) ){
//                     $page					=	intval($_POST['p']);//number of page
//                     $current_page			=	$page - 1;
//                     $records_per_page		=	6; // records to show per page
//                     $start					=	$current_page * $records_per_page;//first limit to search
//                     $arrArgument = array(
//                         'start'=>$start,
//                         'records'=>$records_per_page
//                     );
//                     $arrValue = loadModel($path_model, "home_model", "select_scroll", $arrArgument);
//                     $result= array('totalcount'=>$totalResults,'results' => $arrValue);
//                     echo json_encode($result);
//                 }
//             break;
               
//             default:
//                 include("view/inc/error/error404.php");
//                 break;
//         }
        

// ?>       