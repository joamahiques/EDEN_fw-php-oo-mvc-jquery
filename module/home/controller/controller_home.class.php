<?php

class controller_home {
    function __construct() {
        $_SESSION['module'] = "home";
    }

    function list_home() {
        
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header-home.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(MODULE_VIEW_PATH . "home.php");
        require_once(VIEW_PATH_INC . "footer.php");
    }

function scroll_home() {
    
        $totalResults = loadModel(MODEL_MODULE, "home_model", "count");/// to count the total of houses
        if( isset($_POST['p']) ){
            $page					=	intval($_POST['p']);//number of page
            $current_page			=	$page - 1;
            $records_per_page		=	6; // records to show per page
            $start					=	$current_page * $records_per_page;//first limit to search
            $arrArgument = array(
                'start'=>$start,
                'records'=>$records_per_page
            );
            $arrValue = loadModel(MODEL_MODULE, "home_model", "select_scroll", $arrArgument);
            $result= array('totalcount'=>$totalResults,'results' => $arrValue);
            echo json_encode($result);
            exit;
        }
}

function active_user(){
    if(isset($_GET['aux'])){
        loadModel(MODEL_MODULE,"home_model","active_user",$_GET['aux']);
        header('Location: '. SITE_PATH);
    }
}
}
 ?>       