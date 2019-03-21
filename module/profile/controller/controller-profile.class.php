<?php
    echo json_decode('controller');
    
    $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    session_start();
    // include ($path . "/module/profile/utils/functions-profile.inc.php");
    include ($path . "/utils/upload.php");
    include ($path . "/utils/common.inc.php");
    
   
    
    switch($_GET['op']){

        case 'update_profile':

            if (empty($_SESSION['result_prodpic'])){
                $_SESSION['result_prodpic'] = array('result' => true, 'error' => "", "data" => $_SESSION['avatar']);
            }

            $result_prodpic = $_SESSION['result_prodpic'];
            $nombre =$_POST["user"];
            $mail =$_POST["mail"];
            $tf = $_POST["tf"];
            $province = $_POST["selprovince"];
            $city = $_POST["selcity"];
            //$result=validateregister();
            $arrArgument = array(
                'name' => $nombre,
                'email'=>$mail,
                'tf'=>$tf,
                'province'=>$province,
                'city'=>$city,
                'prodpic' => $result_prodpic['data']
                
              );
            $arrValue = false;
            $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
            $arrValue = loadModel($path_model, "profile_model", "update_user", $arrArgument);

            if ($arrValue){
                $message = "User updated";
            }else{
                $message = "Dont updated";
            }
            echo json_encode($message);
            
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
            echo json_decode($result);
            
        break;
        case 'load_data_user':///////////////////datos del ususario desde bd
                //$jsondata = array();
                if(($_SESSION['mail'])) {
                $user = $_SESSION['mail'];
                // echo json_encode($user);
                // die;
                $arrValue = false;
                $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
                $arrValue = loadModel($path_model, "profile_model", "select_user", $user);
                //echo json_encode($arrValue);
                //die();
            
            }
            echo json_encode($arrValue);
        break;
        case 'load_data_favorites':///////////////////datos de favoritos del ususario desde bd
                //$jsondata = array();
                if(($_SESSION['mail'])) {
                $user = $_SESSION['mail'];
            
                $arrValue = false;
                $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
                $arrValue = loadModel($path_model, "profile_model", "select_user_fav", $user);
              
            }
            echo json_encode($arrValue);
        break;
        case 'load_data_purchases':///////////////////datos de compras del ususario desde bd
                //$jsondata = array();
                if(($_SESSION['mail'])) {
                $user = $_SESSION['mail'];
                $arrValue = false;
                $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
                $arrValue = loadModel($path_model, "profile_model", "select_user_pur", $user);
                
            }
            echo json_encode($arrValue);
        break;
        case 'delete_favorites':///////////////////borrar favorites
                //$jsondata = array();
                if(($_SESSION['mail'])) {
                    $user = $_SESSION['mail'];
                    $name = $_GET['nombre'];
                    $arrArgument = array(
                        'user'=>$user,
                        'home'=>$name
                    );
                $arrValue = false;
                $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
                $arrValue = loadModel($path_model, "profile_model", "delete_favo", $arrArgument);
                if ($arrValue){
                    $message = "Favorite delete";
                }else{
                    $message = "Dont find favorite";
                }
            }
            echo json_encode($message);
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