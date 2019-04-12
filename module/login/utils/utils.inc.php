<?php
   
   function validateregister($user){
       $error='';
        try{
            $check =check_user($user);
        }catch (Exception $e){
            echo json_encode("Error de conexión");
			exit();
        }
        // if ($check != false){ ///si es true
        //     $error='ERROR: Este email ya está registrado';
        // }
        return $check;
   }
        
   function check_user($user){
       return loadmodel(MODEL_MODULE,'login_model','validate',$user);

   }