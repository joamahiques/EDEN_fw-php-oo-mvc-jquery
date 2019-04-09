<?php
    
    // $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    // include($path . "components/modal/model/DAOModal.php");
//    echo('controllermodal');
//    exit;
    class controller_modal {
        
        function __construct() {
            // include(FUNCTIONS_HOME . "utils.inc.php");
            $_SESSION['components'] = "modal";
        }

        function read_modal() {
            try{
            	$modal=($_POST['modal']);// modal
                $data = loadModel(MODEL_MODAL, "modal_model", "select_home", $modal);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$data){
                echo json_encode("error");
                exit;
            }else{
                //$home=get_object_vars($rdo);
                echo json_encode($data);
                exit;
            }
       
        }
    }
    // switch($_POST['op']){
    //     case 'read_modal':
       
    //         try{
    //             $DAOmodal = new DAOModal();
    //         	$rdo = $DAOmodal->select_home($_POST['modal']);// modal
    
    //         }catch (Exception $e){
    //             echo json_encode("error");
    //             exit;
    //         }
    //         if(!$rdo){
    //             echo json_encode("error");
    //             exit;
    //         }else{
    //             $home=get_object_vars($rdo);
    //             echo json_encode($home);
    //             exit;
    //         }
    //     break;
   
    // ////DEFAULT
    // default;
    //     include("vista/include/error404.php");
    //     break;
    // }