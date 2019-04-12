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
            // echo json_encode($data);
            // exit;
        $sql="SELECT 'password','activate','token' FROM users2 WHERE IDuser ='$data'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);//devuelve false si no existe registro,??
        // $email=$data['mail'];
        // $sql="SELECT * FROM users WHERE email ='$email' LIMIT 1";
        // $stmt = $db->ejecutar($sql);
        // return $stmt->fetch();//devuelve false si no existe registro,??
        
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

    public function select_user_DAO($db, $data){
			
        $email=$data['mail'];
		$sql = "SELECT * FROM users WHERE email='$email'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}