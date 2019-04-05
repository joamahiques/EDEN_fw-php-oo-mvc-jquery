<?php
//echo json_encode("home_dao.class.singleton.php");
//exit;

class favorites_dao {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function insertFavorites_DAO($db,$data){
        $home= $data['home'];
        $email=$data['email'];
        $sql="INSERT INTO `favoritos1`(`user_id`, `home_id`) VALUES ((SELECT id FROM users  WHERE email='$email'), (SELECT id FROM casas  WHERE nombre='$home'))";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
         
     }
     function readFavorites_DAO(&db,$email){
         
         $sql = "SELECT nombre FROM casas, favoritos1 WHERE ID =home_id and user_id = ( SELECT id FROM users WHERE email='$email')";
         $stmt = $db->ejecutar($sql);
         return $db->listar($stmt);
      }

      function deleteFavorites_DAO($db,$data){
        $home= $data['home'];
        $email=$data['email'];
        $sql="DELETE FROM `favoritos1` WHERE user_id=(SELECT id FROM users WHERE email='$email') and home_id=(SELECT ID FROM casas WHERE nombre='$home')";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        
      }
}