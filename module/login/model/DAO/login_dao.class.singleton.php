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
			
        $email=$data['mail'];
        $sql="SELECT * FROM users WHERE email ='$email' LIMIT 1";
        $stmt = $db->ejecutar($sql);
        return $stmt->fetch();//devuelve false si no existe registro,??
        // return $db->listar($stmt);
		// $statement = $conexion->prepare("SELECT * FROM users WHERE email ='$email' LIMIT 1");
		// $statement->execute();
		// $resultado = $statement->fetch();//devuelve false si no existe registro, 
		// connect::close($conexion);
		// return $resultado;
    }

    public function insert_user_DAO($db,$data){
			
        $nombre=$data['user'];
        $email=$data['mail'];
        $passw=$data['password'];
        $type="client";
		//$avatar="nada";
		$hashed_pass = password_hash($passw, PASSWORD_DEFAULT);
		$hashavatar= md5( strtolower( trim( $email ) ) );
		$avatar="https://www.gravatar.com/avatar/$hashavatar?s=40&d=identicon";
		
        $sql ="INSERT INTO `users`(`name`, `email`, `userpass`, `type`, `avatar`)
        VALUES ('$nombre','$email','$hashed_pass','$type', '$avatar')";
        
        return  $db->ejecutar($sql);
        
	}

    public function select_user_DAO($db, $data){
			
        $email=$data['mail'];
		$sql = "SELECT * FROM users WHERE email='$email'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}