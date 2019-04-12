<?php

    class controller_contact {

        function __construct() {
            //include(UTILS . "mail.inc.php");
            $_SESSION['module'] = "contact";
        }
    
        function list_contact() {
            
            require_once(VIEW_PATH_INC . "top-page.php");
            require_once(VIEW_PATH_INC . "header.php");
            require_once(VIEW_PATH_INC . "menu.php");
            include(MODULE_VIEW_PATH . "contactus.html");
            require_once(VIEW_PATH_INC . "footer.php");
        }

        function send_form(){
			// $data_mail = array();
			// $data_mail = json_decode($_POST['fin_data'],true);
			$name =$_POST["name"];
        	$mail =$_POST["email"];
            $option = $_POST["opcontact"];
            $message = $_POST["mess"];
			$arrArgument = array(
				'type' => 'contact',
				'token' => '',
				'inputName' => $name,
				'inputEmail' => $mail,
				'inputSubject' => $option,
				'inputMessage' => $message
			);
			// print_r($arrArgument);
			// exit;
			//set_error_handler('ErrorHandler');
			try{
				//echo "<div class='alert alert-success'>".enviar_email($arrArgument)." </div>";
				enviar_email($arrArgument);
				echo json_encode('Mensaje enviado');
			} catch (Exception $e) {
				echo json_encode('Server error. Try later...');//"<div class='alert alert-error'>Server error. Try later...</div>";
			}
			//restore_error_handler();

			$arrArgument = array(
				'type' => 'admin',
				'token' => '',
				'inputName' => $name,
				'inputEmail' => $mail,
				'inputSubject' => $option,
				'inputMessage' => $message
			);
			try{
	            enviar_email($arrArgument);
			} catch (Exception $e) {
				echo json_encode('Server error. Try later...');
				//echo "<div class='alert alert-error'>Server error. Try later...</div>";
			}
		}
    }
?>  