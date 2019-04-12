<?php
    function enviar_email($arr) {
        $html = '';
        $subject = '';
        $body = '';
        $ruta = '';
        $return = '';
        
        switch ($arr['type']) {
            case 'alta':////mail para enviar el token y darse de alta
                $subject = 'Tu Alta en EDEN';
                $ruta = "<a href='" . amigable("?module=home&function=active_user&param=" . $arr['token'], true) . "'>aqu&iacute;</a>";
                $body = 'Gracias por unirte a nuestra aplicaci&oacute;n<br> Para finalizar el registro, pulsa ' . $ruta;
                break;
    
            case 'changepass':///para cambiarse la contraseña
                $subject = 'Tu Nuevo Password en EDEN<br>';
                $ruta = '<a href="' . amigable("?module=login&function=changepass&aux=" . $arr['token'], true) . '">aqu&iacute;</a>';
                $body = 'Para recordar tu password pulsa ' . $ruta;
                break;
                
            case 'contact':///el form del contact
                $subject = 'Tus comentarios a EDEN han sido enviados<br>';
                $ruta = '<a href=' . 'http://localhost/www/EDEN/home/list_home/'. '>aqu&iacute;</a>';
                $body = 'Para visitar nuestra web, pulsa ' . $ruta;
                break;
    
            case 'admin':///para enviar logs al admin
                $subject = $arr['inputSubject'];
                $body = 'inputName: ' . $arr['inputName']. '<br>' .
                'inputEmail: ' . $arr['inputEmail']. '<br>' .
                'inputSubject: ' . $arr['inputSubject']. '<br>' .
                'inputMessage: ' . $arr['inputMessage'];
                break;
        }
        ///cuerpo del mensaje
        $html .= "<html>";
        $html .= "<body>";
            $html .= "Asunto:";
            $html .= "<br><br>";
	       $html .= "<h4>". $subject ."</h4>";
           $html .= "<br><br>";
           $html .= "Mensaje:";
           $html .= "<br><br>";
           $html .= $arr['inputMessage'];
           $html .= "<br><br>";
	       $html .= $body;
	       $html .= "<br><br>";
	       $html .= "<p>Sent by EDEN</p>";
		$html .= "</body>";
		$html .= "</html>";

        //set_error_handler('ErrorHandler');
        try{
            if ($arr['type'] === 'admin')
                $address = 'joamahiques@gmail.com';
            else
                $address = $arr['inputEmail'];
            $result = send_mailgun('joamahiques@gmail.com', $address, $subject, $html);    
        } catch (Exception $e) {
			$return = 0;
		}
		//restore_error_handler();
        return $result;
    }

function send_mailgun($from, $email, $subject, $html){
    $config = array();
    $config['api_key'] = "bc5805ea5df1fe1751896a341d702f39-6140bac2-de5253c0"; //API Key
    $config['api_url'] = "https://api.mailgun.net/v3/sandboxb20b48a4b8d2462abf42247fc9e7536c.mailgun.org/messages"; //API Base URL

   $message = array();
   $message['from'] = $from;
   $message['to'] =  $email;
   $message['h:Reply-To'] = "joamahiques@gmail.com";
   $message['subject'] = $subject;
   $message['html'] = $html;

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $config['api_url']);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
 }