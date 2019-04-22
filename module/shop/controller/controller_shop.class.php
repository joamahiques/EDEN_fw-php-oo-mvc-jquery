<?php
class controller_shop{

    function __construct() {
        // include(FUNCTIONS_HOME . "utils.inc.php");
        $_SESSION['module'] = "shop";
    }
    function list_shop() {
        // echo json_encode("yeess list home");
        // exit;
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header-home.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(MODULE_VIEW_PATH . "shop.php");
        require_once(VIEW_PATH_INC . "footer.php");
        if (isset($_SESSION["tiempo"])) {  
            $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
        }
    }
    function products(){
        $search= json_decode($_POST['search'],true);
        if( isset($search['page_num']) ){

            //set_error_handler('ErrorHandler');
            try{
            $page					=	intval($search['page_num']);//number of page
            $current_page			=	$page - 1;
            $records_per_page		=	6; // records to show per page
            $start					=	$current_page * $records_per_page;//first limit to search
            $val                    =   ($search['val']);
            $provi                  =   ($search['provi']);
            $local                  =   ($search['local']);
            $arrArgument = array(
                'start'=>$start,
                'records'=>$records_per_page,
                'val'=>$val,
                'provi'=>$provi,
                'local'=>$local
            );
            
            $totalResults = loadModel(MODEL_MODULE, "shop_model", "count", $arrArgument);/// to count the total of houses
            $arrValue = loadModel(MODEL_MODULE, "shop_model", "alldrops", $arrArgument);
            $result= array('totalcount'=>$totalResults,'results' => $arrValue);
            
         }catch(Exception $e) {echo json_encode($e+"error shop");}
            restore_error_handler();
            if(($totalResults)&&($arrValue)){
                echo json_encode($result);
            }else{
                echo json_encode($result);
            }
           
        }
    }

}
     ?>
            