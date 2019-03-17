<?php
    
    $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    session_start();
    // include ($path . "/module/profile/utils/functions-profile.inc.php");
    include ($path . "/utils/upload.php");
    include ($path . "/utils/common.inc.php");
    
   
    
    switch($_GET['op']){
    ////////////LIST   
        case 'view':
            include("module/profile/view/profile.html");
            
        break;
        case 'uploadimg':

            $result_prodpic = upload_files();
            $_SESSION['result_prodpic'] = $result_prodpic;
            echo json_encode($result_prodpic);
            
        break;
        case 'delete':

            $_SESSION['result_prodpic'] = array();
            $result = remove_files();
            if($result === true){
            echo json_encode(array("res" => true));
            }else{
            echo json_encode(array("res" => false));
            }
            //echo json_decode($result);
            
        break;
        case 'load_data'://////////para que si hay algun error no se vacie el formulario
            // echo json_encode('controller');
            // exit;
            $jsondata = array();
        
            if (isset($_SESSION['profile'])) {
                $jsondata["profile"] = $_SESSION['profile'];
                echo json_encode($jsondata);
                exit;
            } else {
                $jsondata["profile"] = "";
                echo json_encode($jsondata);
                exit;
            }
            
        break;
        default:
        include($path ."view/include/error/error404.php");
        break;
}


?>