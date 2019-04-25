<?php
   
   function validate_register($user){
       $error='';
        try{
            $check =check_user($user);
        }catch (Exception $e){
            echo json_encode("Error de conexión");
			exit();
        }
        return $check;
   }
   function validate_login($user){
       
    $error='';
            $check =check_user($user['user']);
            $data = $check[0];
            $act = $check[0]['activate'];
            $pass = $check[0]['password'];
            $_SESSION['avatar'] = $check[0]['avatar'];
            //$_SESSION['avatar'] = $value['avatar'];
        
        if(!$data){
            $error='El usuario no existe';
        }else if($act==="0"){
            $error='Tienes que verificar tu cuenta. Revisa el correo';
        }else if(!password_verify($user['pass'],$check[0]['password'])){
            $error='La contraseña no es correcta';
        };
     return $return= array('data'=>$data, 'error'=>$error);
}
        
   function check_user($user){
       return loadmodel(MODEL_MODULE,'login_model','validate',$user);

   }

   function send_mail_social($arrArgument){
    return loadmodel(MODEL_MODULE,'login_model','validate',$user);

}

