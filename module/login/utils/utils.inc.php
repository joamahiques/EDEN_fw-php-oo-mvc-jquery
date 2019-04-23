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

//    function generate_JWK($name){
//     require_once "classes/JWT.class.singleton.php";
//     $header = '{"typ":"JWT", "alg":"HS256"}';
//     $secret = 'ettelefonomicasa';
//     //$secret = rand(0, 1) ? 'maytheforcebewithyou' : 'ettelefonomicasa';
//     //iat: Tiempo que inició el token
//     //exp: Tiempo que expirará el token (+1 hora)
//     //name: info user
//     //echo json_encode($secret);
    
//     $payload = '{
//     "iat":time(), 
//     "exp":time() + (60*60),
//     "name":'.$name.'
//     }';

//     $JWT = new JWT;
//     $token = $JWT->encode($header, $payload, $secret);
//     $json = $JWT->decode($token, $secret);
//     // echo 'JWT sandomera: '.$token."\n\n"; echo '<br>';
//     // echo 'JWT Decoded sandomera: '.$json."\n\n"; echo '<br>'; echo '<br>';
//     // exit;
//     return $token;
// }