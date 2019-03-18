<?php
//echo json_encode("products_bll.class.singleton.php");
//exit;

$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
// define('SITE_ROOT', $path);
define('MODEL_PATH', SITE_ROOT . 'model/');

require(MODEL_PATH . "db.class.singleton.php");
require(SITE_ROOT . "module/profile/model/DAO/profile_DAO.class.singleton.php");

class profile_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = profileDAO::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function select_user_BLL($user){
      return $this->dao->select_user_DAO($this->db, $user);
    }
    public function update_user_BLL($arrArgument) {
        return $this->dao->update_user_DAO($this->db, $arrArgument);
    }
    // public function create_profile_BLL($arrArgument){
    //   return $this->dao->create_profile_DAO($this->db, $arrArgument);
    // }

    // public function obtain_countries_BLL($url){
    //   return $this->dao->obtain_countries_DAO($url);
    // }

    // public function obtain_provinces_BLL(){
    //   return $this->dao->obtain_provinces_DAO();
    // }

    // public function obtain_cities_BLL($arrArgument){
    //   return $this->dao->obtain_cities_DAO($arrArgument);
    // }
}
