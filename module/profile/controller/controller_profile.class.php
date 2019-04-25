<?php
   
    class controller_profile {

		function __construct() {
				include(FUNCTIONS_MODULE . "utils.inc.php");
				$_SESSION['module'] = "profile";
		}
        function view() {
            // echo json_encode("yeess list home");
            // exit;
            require_once(VIEW_PATH_INC . "top-page.php");
            require_once(VIEW_PATH_INC . "header-home.php");
            require_once(VIEW_PATH_INC . "menu.php");
            include(MODULE_VIEW_PATH . "profile.html");
            require_once(VIEW_PATH_INC . "footer.php");
        }
   
    function update_profile() {
        if ((empty($_SESSION['result_prodpic']))&&(empty($_SESSION['avatar']))){
            $hashavatar= md5( strtolower( trim( $email ) ) );
            $avatar="https://www.gravatar.com/avatar/$hashavatar?s=40&d=identicon";
            $_SESSION['result_prodpic'] = array('result' => true, 'error' => "", "data" => $avatar);
            $result_prodpic = $_SESSION['result_prodpic'];
            $result_prodpic = $result_prodpic['data'];
        };
        if(($_SESSION['avatar']) && (empty($_SESSION['result_prodpic']))){
            $result_prodpic['data'] = $_SESSION['avatar'];
        }
        if($_SESSION['result_prodpic']){
            $result_prodpic['data'] = $_SESSION['result_prodpic'];
        }
        // echo json_encode($result_prodpic['data']);
        // exit;
        $result=validate_profile();
        
       if ($result[0]=='ok'){
           
                //echo ($result);
                //$result_prodpic = $_SESSION['result_prodpic'];
                $nombre =$_POST["user"];
                $mail =$_POST["mail"];
                $tf = $_POST["tf"];
                $province = $_POST["selprovince"];
                $city = $_POST["selcity"];
                $arrArgument = array(
                    'name' => $nombre,
                    'email'=>$mail,
                    'tf'=>$tf,
                    'province'=>$province,
                    'city'=>$city,
                    'prodpic' => $result_prodpic['data'],
                    'tok'=>$result[1]
                    
                );
                $arrValue = false;
                $arrValue = loadModel(MODEL_MODULE, "profile_model", "update_user", $arrArgument);
                
                if ($arrValue){
                    echo json_encode($arrValue);
                }else{
                    $message = "Dont updated";
                    echo json_encode($message);
                }
                
        }else if ($result[0]!='ok'){
            $message2 = array(
                '0' => 'bad',
                '1'=>$result[1] 
            );
            echo json_encode($message2);
            exit;
        }
    }

    function load_data_user(){

            $user = $_POST['tok'];
            $arrValue = false;
            $arrValue = loadModel(MODEL_MODULE, "profile_model", "select_user", $user);
            
        echo json_encode($arrValue);
    }
    function load_data_favorites(){
            $user = $_POST['tok'];
            $arrValue = false;
            $arrValue = loadModel(MODEL_MODULE, "profile_model", "select_user_fav", $user);
            echo json_encode($arrValue);
    }
    function load_data_purchases(){
        $user = $_POST['tok'];
        $arrValue = false;
        $arrValue = loadModel(MODEL_MODULE, "profile_model", "select_user_pur", $user);
        echo json_encode($arrValue);
    }
    function delete_favorites(){
        $user = $_POST['tok'];
        $name = $_POST['nombre'];
                    $arrArgument = array(
                        'tok'=>$user,
                        'home'=>$name
                    );
                $arrValue = false;
                $arrValue = loadModel(MODEL_MODULE, "profile_model", "delete_favo", $arrArgument);
                if ($arrValue){
                    $message = "Favorite delete";
                }else{
                    $message = "Dont find favorite";
                }
            
            echo json_encode($message);
    }
    function uploadimg(){
        $result_prodpic = upload_files();
        $_SESSION['result_prodpic'] = $result_prodpic;
        echo json_encode($result_prodpic);
    }

    function delete(){
        $_SESSION['result_prodpic'] = array();
        $result = remove_files();
        if($result === true){
          echo json_encode(array("res" => true));
        }else{
            echo json_encode(array("res" => false));
        }
            echo json_decode($result);
    }
}
//     switch($_GET['op']){

//         case 'update_profile':

//             if ((empty($_SESSION['result_prodpic']))&&(empty($_SESSION['avatar']))){
//                 $hashavatar= md5( strtolower( trim( $email ) ) );
// 		        $avatar="https://www.gravatar.com/avatar/$hashavatar?s=40&d=identicon";
//                 $_SESSION['result_prodpic'] = array('result' => true, 'error' => "", "data" => $avatar);
//             }
//             $result=validate_profile();
//             //echo ($result);
    
//            if ($result=='ok'){
//                     //echo ($result);
//                     $result_prodpic = $_SESSION['result_prodpic'];
//                     $nombre =$_POST["user"];
//                     $mail =$_POST["mail"];
//                     $tf = $_POST["tf"];
//                     $province = $_POST["selprovince"];
//                     $city = $_POST["selcity"];
//                     $arrArgument = array(
//                         'name' => $nombre,
//                         'email'=>$mail,
//                         'tf'=>$tf,
//                         'province'=>$province,
//                         'city'=>$city,
//                         'prodpic' => $result_prodpic['data']
                        
//                     );
//                     $arrValue = false;
//                     $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
//                     $arrValue = loadModel($path_model, "profile_model", "update_user", $arrArgument);

//                     if ($arrValue){
//                         $message = "User updated";
//                     }else{
//                         $message = "Dont updated";
//                     }
//                     echo json_encode($message);
//             }else if ($result!='ok'){
//                 $message2="bad";
//                 echo($message2);
//             }
//         break;
//         case 'uploadimg':

//             $result_prodpic = upload_files();
//             $_SESSION['result_prodpic'] = $result_prodpic;
//             echo json_encode($result_prodpic);
            
//         break;
//         case 'delete':

//             $_SESSION['result_prodpic'] = array();
//             $result = remove_files();
//             if($result === true){
//             echo json_encode(array("res" => true));
//             }else{
//             echo json_encode(array("res" => false));
//             }
//             echo json_decode($result);
            
//         break;
//         case 'load_data_user':///////////////////datos del ususario desde bd
//                 //$jsondata = array();
//                 if(($_SESSION['mail'])) {
//                 $user = $_SESSION['mail'];
//                 // echo json_encode($user);
//                 // die;
//                 $arrValue = false;
//                 $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
//                 $arrValue = loadModel($path_model, "profile_model", "select_user", $user);
//                 //echo json_encode($arrValue);
//                 //die();
            
//             }
//             echo json_encode($arrValue);
//         break;
//         case 'load_data_favorites':///////////////////datos de favoritos del ususario desde bd
//                 //$jsondata = array();
//                 if(($_SESSION['mail'])) {
//                 $user = $_SESSION['mail'];
            
//                 $arrValue = false;
//                 $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
//                 $arrValue = loadModel($path_model, "profile_model", "select_user_fav", $user);
              
//             }
//             echo json_encode($arrValue);
//         break;
//         case 'load_data_purchases':///////////////////datos de compras del ususario desde bd
//                 //$jsondata = array();
//                 if(($_SESSION['mail'])) {
//                 $user = $_SESSION['mail'];
//                 $arrValue = false;
//                 $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
//                 $arrValue = loadModel($path_model, "profile_model", "select_user_pur", $user);
                
//             }
//             echo json_encode($arrValue);
//         break;
//         case 'delete_favorites':///////////////////borrar favorites
//                 //$jsondata = array();
//                 if(($_SESSION['mail'])) {
//                     $user = $_SESSION['mail'];
//                     $name = $_GET['nombre'];
//                     $arrArgument = array(
//                         'user'=>$user,
//                         'home'=>$name
//                     );
//                 $arrValue = false;
//                 $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
//                 $arrValue = loadModel($path_model, "profile_model", "delete_favo", $arrArgument);
//                 if ($arrValue){
//                     $message = "Favorite delete";
//                 }else{
//                     $message = "Dont find favorite";
//                 }
//             }
//             echo json_encode($message);
//         break;

//         case 'load_data'://////////para que si hay algun error no se vacie el formulario
//             // echo json_encode('controller');
//             // exit;
//             $jsondata = array();
        
//             if (isset($_SESSION['profile'])) {
//                 $jsondata["profile"] = $_SESSION['profile'];
//                 echo json_encode($jsondata);
//                 exit;
//             } else {
//                 $jsondata["profile"] = "";
//                 echo json_encode($jsondata);
//                 exit;
//             }
            
//         break;
//         default:
//         include($path ."view/include/error/error404.php");
//         break;
// }


?>