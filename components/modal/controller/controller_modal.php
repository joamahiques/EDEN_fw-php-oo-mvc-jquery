<?php
    // class controller_modal{

    //     function __construct() {
            
    //     }
    //     function favorites(){
    $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    include($path . "components/modal/model/DAOModal.php");
   echo('controllermodal');
   exit;
//     class controller_modal {
//         function __construct() {
//             // include(FUNCTIONS_HOME . "utils.inc.php");
//             $_SESSION['components'] = "modal";
//         }
//         function read_modal() {
//             try{
//                 $DAOmodal = new DAOModal();
//             	$rdo = $DAOmodal->select_home($_POST['modal']);// modal
    
//             }catch (Exception $e){
//                 echo json_encode("error");
//                 exit;
//             }
//             if(!$rdo){
//                 echo json_encode("error");
//                 exit;
//             }else{
//                 $home=get_object_vars($rdo);
//                 echo json_encode($home);
//                 exit;
//             }
//         break;
//         }
    
    switch($_POST['op']){
        case 'read_modal':
       
            try{
                $DAOmodal = new DAOModal();
            	$rdo = $DAOmodal->select_home($_POST['modal']);// modal
    
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode("error");
                exit;
            }else{
                $home=get_object_vars($rdo);
                echo json_encode($home);
                exit;
            }
        break;
   
    ////DEFAULT
    default;
        include("vista/include/error404.php");
        break;
    }