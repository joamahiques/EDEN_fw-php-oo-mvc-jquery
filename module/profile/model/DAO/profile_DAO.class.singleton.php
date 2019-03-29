<?php
//echo json_encode("profile_dao.class.singleton.php");
//exit;

class profileDAO {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_user_DAO($db, $user){
        $userMail = $user;
        $sql = "SELECT * FROM users WHERE email = '$userMail'";
        
        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
    public function select_user_fav_DAO($db, $user){
        $userMail = $user;
        $sql = "SELECT nombre,localidad,provincia,capacidad,entera FROM casas, favoritos1 WHERE ID =home_id and user_id = ( SELECT id FROM users WHERE email='$userMail')";
        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
    public function select_user_pur_DAO($db, $user){
        $userMail = $user;
        $sql = "SELECT codigo, (SELECT nombre from casas where compras.id_product = casas.ID) as nombre ,fecha, cantidad,precio,total 
                 FROM compras WHERE id_user =(SELECT id FROM users WHERE email='$userMail') ";
        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
      public function update_user_DAO($db, $arrArgument){
        $username = $arrArgument['name'];
        $useremail = $arrArgument['email'];
        $usertf = $arrArgument['tf'];
        $userprovince = $arrArgument['province'];
        $usercity = $arrArgument['city'];
        $useravatar = $arrArgument['prodpic'];
        $sql = $sql = " UPDATE users SET name='$username', tf='$usertf', province='$userprovince', city='$usercity', avatar='$useravatar'
                         WHERE email='$useremail'";;
        
        return $db->ejecutar($sql);
         
    }
    public function delete_favo_DAO($db, $arrArgument){
        $user = $arrArgument['user'];
        $home = $arrArgument['home'];
        $sql = $sql="DELETE FROM `favoritos1` WHERE user_id=(SELECT id FROM users WHERE email='$user') and home_id=(SELECT ID FROM casas WHERE nombre='$home')";
        
        return $db->ejecutar($sql);
         
    }

   
    
}//End DAO
