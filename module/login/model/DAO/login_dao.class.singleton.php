<?php
class login_dao {

    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function validate_DAO($db,$data){
        $newtok=$this->update_token_DAO($db,$data);//crear un token por que lo borramos en el logout
        $db->ejecutar($newtok);
        $sql="SELECT IDuser,password,activate,token FROM users2 WHERE IDuser ='$data'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);  
    }

    public function insert_user_DAO($db,$data){
        
        $nombre=$data['user'];
        $email=$data['email'];
        $passw=$data['passwd'];
        $type="client";
        $token= generate_JWK($nombre);
		$hashed_pass = password_hash($passw, PASSWORD_DEFAULT);
		$hashavatar= md5( strtolower( trim( $email ) ) );
		$avatar="https://www.gravatar.com/avatar/$hashavatar?s=40&d=identicon";
        
        $sql ="INSERT INTO `users2`(`IDuser`, `user`, `email`, `password`, `type`, `avatar`, `activate`, `token`)
        VALUES ('$nombre','$nombre','$email','$hashed_pass','$type', '$avatar',0,'$token')";
        $stmt =$db->ejecutar($sql);
        return $token;
        
	}
    public function social_DAO($db, $data){
        $id=$data['id_user'];
        $nombre=$data['user'];
        $email=$data['email'];
        $avatar=$data['avatar'];
        $type="client_rs";
        $token= generate_JWK($nombre);

        $sql ="INSERT INTO `users2`(`IDuser`, `user`, `email`, `type`, `avatar`, `activate`, `token`)
        VALUES ('$id','$nombre','$email','$type', '$avatar',1,'$token')";
        $stmt =$db->ejecutar($sql);
        return $token;

    }
    public function select_user_DAO($db, $data){
        ///$data = old token
        $sql = "SELECT * FROM users2 WHERE token ='$data'";
        $stmt = $db->ejecutar($sql);
        $res= $db->listar($stmt);
        
        $newtok=$this->update_token_DAO($db,$res[0]['user']);
        return array ($res, $newtok);        
        
        //return $db->listar($stmt);
        
        // echo json_encode($res[0]['user']);
        // exit;
    }

    public function update_token_DAO($db,$nombre){
       
        $token= generate_JWK($nombre);
        $sql = "UPDATE users2 set token ='$token' WHERE IDuser='$nombre'";

        $stmt = $db->ejecutar($sql);
        return $token;
        //return $db->listar($stmt);
    }
    public function delete_token_DAO($db,$data){
        $sql = "UPDATE users2 set token ='' WHERE token='$data'";
        return $db->ejecutar($sql);
    }
}