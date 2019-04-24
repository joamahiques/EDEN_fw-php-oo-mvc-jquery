<?php
function validate_profile(){

    
        $user = $_POST['tok'];
        $arrValue = false;
        $arrValue = loadModel(MODEL_MODULE, "profile_model", "select_user", $user);
        if(!$arrValue){
            echo "El usuario no existe";
            exit();
        }else{
             
            if (password_verify($_POST['propassword'],$arrValue[0][0]['password'])) {
                return array ('ok',$arrValue[1]);
		    }else {
				return array ('',$arrValue[1]);
				
            }
        }
    
}

// function generate_JWK($name){
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