<?php
function validate_profile(){

    if(($_SESSION['mail'])) {
        $user = $_SESSION['mail'];
        $arrValue = false;
        $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/profile/model/model/';
        $arrValue = loadModel($path_model, "profile_model", "select_user", $user);
        //echo json_encode($arrValue);
        if(!$arrValue){
            echo "El usuario no existe";
            exit();
        }else{
            // echo json_encode($arrValue);
            // echo json_encode($arrValue[0]['userpass']);
            if (password_verify($_POST['propassword'],$arrValue[0]['userpass'])) {
                return ('ok');
		    }else {
				return ("");
				
            }
        }
    }
}