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
            
        $sql="SELECT IDuser,password,activate,token FROM users2 WHERE IDuser ='$data'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);  
    }

    public function insert_user_DAO($db,$data){
        
        $nombre=$data['user'];
        $email=$data['email'];
        $passw=$data['passwd'];
        $type="client";
        $token=md5(uniqid(rand(),true));
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
        $token=md5(uniqid(rand(),true));

        $sql ="INSERT INTO `users2`(`IDuser`, `user`, `email`, `type`, `avatar`, `activate`, `token`)
        VALUES ('$id','$nombre','$email','$type', '$avatar',1,'$token')";
        $stmt =$db->ejecutar($sql);
        return $token;

    }
    public function select_user_DAO($db, $data){
        
		$sql = "SELECT * FROM users2 WHERE token ='$data'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}