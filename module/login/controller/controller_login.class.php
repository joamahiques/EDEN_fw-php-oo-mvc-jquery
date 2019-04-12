<?php
    
    class controller_login {

		function __construct() {
				include(FUNCTIONS_MODULE . "utils.inc.php");
				$_SESSION['module'] = "login";
		}
		
   
    function register() {
				$user=$_POST['user'];
				$valide = validateregister($user); 
				// echo($valide);
				// exit;
				if(!$valide){

								$arrArgument = array(
									'user'=>$_POST['user'],
									'email'=>$_POST['mail'],
									'passwd'=> $_POST['password']
							);
							
									try {
											$rlt['token']= loadModel(MODEL_MODULE,'login_model','insert_user',$arrArgument);//return token
										
									} catch (Exception $e) {
												echo json_encode("Error");
												exit;
									}
									
									if(!$rlt){
													echo json_encode("Error");
													exit;
									}else{
										$rlt['type']='alta';
										$rlt['inputEmail']=$arrArgument['email'];
										$rlt['inputMessage']='Para activar tu cuenta en EDEN pulse el siguiente enlace:';

										enviar_email($rlt);
									}

									echo("ok");
							 exit;
				}else{
					echo "ERROR: Este usuario ya está registrado";
					exit;
				}
	}
	function login() {
				try {
					// $daologin = new DAOlogin();
					// $rlt = $daologin->select_user($_POST['mail']);
						$data=$_POST['mail'];
						$arrValue = loadModel(MODEL_MODULE, "login_model", "select_user", $data);
				} catch (Exception $e) {
						echo "error";
						exit();
				}
				if(!$arrValue){
						echo "El usuario no existe";
						exit();
				}else{
						$value = get_object_vars($arrValue);
						if (password_verify($_POST['password'],$value['userpass'])) {
							
								$_SESSION['type'] = $value['type'];
								$_SESSION['avatar'] = $value['avatar'];
								$_SESSION['mail'] = $value['email'];
								$_SESSION['tiempo'] = time();
								//echo 'ok';
								echo json_encode($value);
								exit();
					}else {
								echo "No coinciden los datos";
								exit();
					}
				}			
	}	
	function logout() {

					error_reporting(0);
					session_unset($_SESSION['type']);
					//session_unset($_SESSION['user']);
					session_unset($_SESSION['avatar']);
					session_unset($_SESSION['mail']);
					session_unset($_SESSION['tiempo']);
					session_destroy();
					echo "home";
	}
}//end class
	
  //   switch($_GET['op']){
  //   ////////////LIST   
  //       case 'view':
  //           include("module/login/view/login.html");
            
  //       break;

  //       case 'register':

  //               $valide = validateregister();
               
  //               if(!$valide){
	// 				try {
	// 					$daologin = new DAOlogin();
  //                        $rlt = $daologin->insert_user($_POST['user'], $_POST['mail'], $_POST['password']);
	// 				} catch (Exception $e) {
	// 					echo "Error al registrarse1";
	// 					exit();
	// 				}
	// 				if(!$rlt){
  //                       echo "Error al registrarse";
  //                       echo ($_POST['user']);
	// 					exit();
	// 				}else{
	// 					if (isset($_SESSION['purchase']) && $_SESSION['purchase'] === 'on'){
	// 						echo 'okay';
	// 						exit();
	// 					}else{
							
	// 						echo 'ok';
	// 						exit();
							
	// 					}
	// 				}	
	// 			}else{
	// 				echo "ERROR: Este email ya está registrado";
	// 				exit();
	// 			}
	// 	break;
			
	// 	case 'autologin':
	// 			try {
	// 				$daologin = new DAOlogin();
	// 				$rlt = $daologin->select_user($_POST['mail']);
	// 			} catch (Exception $e) {
	// 				echo "error";
	// 				exit();
	// 			}
	// 			if(!$rlt){
	// 				echo "Error al registrarse";
	// 				echo ($_POST['user']);
	// 				exit();
	// 			}else{

	// 				$value = get_object_vars($rlt);
	// 				$_SESSION['type'] = $value['type'];
	// 				//$_SESSION['user'] = $value['name'];
	// 				$_SESSION['avatar'] = $value['avatar'];
	// 				$_SESSION['mail'] = $value['email'];
	// 				$_SESSION['tiempo'] = time();
	// 				echo json_encode($value);
	// 				//echo 'ok';
	// 				exit();
	// 			}
	// 			break;

  //       case 'login':
	// 			try {
	// 				$daologin = new DAOlogin();
	// 				$rlt = $daologin->select_user($_POST['mail']);
	// 			} catch (Exception $e) {
	// 				echo "error";
	// 				exit();
	// 			}
	// 			if(!$rlt){
	// 				echo "El usuario no existe";
	// 				exit();
	// 			}else{
	// 				$value = get_object_vars($rlt);
	// 				if (password_verify($_POST['password'],$value['userpass'])) {
	// 					if (isset($_SESSION['purchase']) && $_SESSION['purchase'] === 'on')
	// 						echo 'okay';
	// 					else
							
	// 					$_SESSION['type'] = $value['type'];
	// 					//$_SESSION['user'] = $value['name'];
	// 					$_SESSION['avatar'] = $value['avatar'];
	// 					$_SESSION['mail'] = $value['email'];
	// 					$_SESSION['tiempo'] = time();
	// 					//echo 'ok';
	// 					echo json_encode($value);
	// 					exit();
	// 				}else {
	// 					echo "No coinciden los datos";
	// 					exit();
	// 				}
	// 			}	
	// 			break;

			
	// 		case 'logout':
	// 				error_reporting(0);
	// 				session_unset($_SESSION['type']);
	// 				//session_unset($_SESSION['user']);
	// 				session_unset($_SESSION['avatar']);
	// 				session_unset($_SESSION['mail']);
	// 				session_unset($_SESSION['tiempo']);
	// 				session_destroy();
	// 				echo "home";
	// 				// if(session_destroy()) {
	// 				// 	echo "home";
	// 				// }
	// 		break;
				
	// 	case 'controluser':
	// 			if (!isset ($_SESSION['type'])||($_SESSION['type'])!='admin'){
			
	// 				if(isset ($_SESSION['type'])&&($_SESSION['type'])!='admin'){
	// 					echo 'okay';
	// 					exit();
	// 				}
	// 				echo 'ok';
	// 				exit();
		
	// 				// http://localhost/www/EDEN/index.php?page=controller_homes&op=list
	// 			}
				
	// 		break;
	// 	case 'actividad':
	// 				if (!isset($_SESSION["tiempo"])) {  
	// 					echo "activo";
	// 				} else {  
	// 					if((time() - $_SESSION["tiempo"]) >= 60000) {  
	// 						echo "inactivo"; 
	// 						exit();
	// 					}else{
	// 						echo "activo";
	// 						exit();
	// 					}
	// 				}
	// 		break;
  //       default:
	// 			include("view/include/error/error404.php");
	// 	break;
	// }
    

?>
            