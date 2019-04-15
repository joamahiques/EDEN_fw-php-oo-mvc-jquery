<?php

class controller_favorites{

    function __construct() {
        
    }
    function favorites(){
        //set_error_handler('ErrorHandler');
        try{
            $arrArgument = array(
                'id'=>$_POST['id'],
                'tok'=>$_POST['tok']
            );
            $arrValue = false;
            $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "insertFavorites", $arrArgument);
           
        }catch(Exception $e) {echo json_encode($e+"error FAVORITES");}
        //restore_error_handler();
        if($arrValue){
            echo json_encode($arrValue);
        }else{
            echo json_encode($arrValue);
        }

    }

    function read_favorites(){
    //set_error_handler('ErrorHandler');

        try{
            $user=$_POST['tok'];
            $arrValue = false;
            $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "readFavorites", $user);

        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }
        //restore_error_handler();
        if(!$arrValue){
            echo json_encode("error");
            exit;
        }else{
            echo json_encode($arrValue);
            exit;
        }
    }

    function delete_favorites(){
        //set_error_handler('ErrorHandler');
        try{
            $arrArgument = array(
                'id'=>$_POST['id'],
                'tok'=>$_POST['tok']
            );
            $arrValue = false;
            $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "deleteFavorites", $arrArgument); 
        }catch (Exception $e){
            //echo ("conexion");
            echo json_encode($e+"error FAVORITES");
            exit;
        }
        //restore_error_handler();
        if($arrValue){
            echo json_encode($arrValue);
            exit;
        }else{
            echo json_encode($arrValue);
            exit;
        }
    }

}
// @session_start();
//     $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';

//     include($path ."components/favorites/model/DAOFavorites.php");
    
//         switch($_GET['op']){
            
//             case 'favorites':
//                 try{
//                     $arrArgument = array(
//                         'home'=>$_GET['id'],
//                         'email'=>$_GET['email']
//                     );
//                     // $DAOFavorites = new DAOFavorites();
//                     // $rdo = $DAOFavorites->insertFavorites($_GET['id'],$_GET['email']);//$_SESSION['mail]
//                     $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "insertFavorites", $arrArgument);
//                     // echo json_encode($arrValue);
//                     // exit;
//                 }catch(Exception $e) {echo json_encode($e+"error FAVORITES");}
//                 //restore_error_handler();
//                 if($arrValue){
//                     echo json_encode($arrValue);
//                 }else{
//                     echo json_encode($arrValue);
//                 }
//                 break;
            
//             case 'readfavorites':
//                 try{
//                     $user = $_SESSION['mail'];
            
//                     $arrValue = false;
//                     $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "readFavorites", $user);
//                     //echo json_encode($arrValue);
//                     // $DAOFavorites = new DAOFavorites();
//                     // $rdo = $DAOFavorites->readFavorites($_SESSION['mail']);
        
//                 }catch (Exception $e){
//                     echo json_encode("error");
//                     exit;
//                 }
//                 if(!$arrValue){
//                     echo json_encode("error");
//                     exit;
//                 }else{
//                     echo json_encode($arrValue);
//                     // $favor = array();///inicializamos el array
//                     // foreach ($rdo as $row) {
//                     //     array_push($favor, $row);//lo rellenamos con array_push
//                     // }
//                     // echo json_encode($favor);///lo pasamos a json
//                     exit;
//                 }
//                  break;
            
//             case 'favoritesDelete':

//                try{
//                     $user = $_SESSION['mail'];
//                     $name = $_GET['nombre'];
//                     $arrArgument = array(
//                         'user'=>$user,
//                         'home'=>$name
//                     );
//                     $arrValue = false;
//                     $arrValue = loadModel(MODEL_FAVORITES, "favorites_model", "deleteFavorites", $arrArgument);
//                     //    $DAOFavorites = new DAOFavorites();
//                     //    $rdo = $DAOFavorites->deleteFavorites($_GET['id'],$_GET['email']);
//                }catch (Exception $e){
//                    //echo ("conexion");
//                    $callback = 'index.php?page=503';
//                    die('<script>window.location.href="'.$callback .'";</script>');
//                }
//                if ($arrValue){
//                     $message = "Favorite delete";
//                 }else{
//                     $message = "Dont find favorite";
//                 }
//                 echo json_encode($message);
//                 break;
            
//             default:
//                 include("view/inc/error/error404.php");
//                 break;
//             }

?>