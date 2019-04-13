<?php
//echo json_encode("products_bll.class.singleton.php");
//exit;

// $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
// define('SITE_ROOT', $path);
// define('MODEL_PATH', SITE_ROOT . 'model/');

// require(MODEL_PATH . "db.class.singleton.php");
// require(SITE_ROOT . "module/home/model/DAO/home_dao.class.singleton.php");

class home_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = home_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function select_scroll_BLL($data){
      return $this->dao->select_scroll_DAO($this->db, $data);
    }
    public function count_BLL(){
        return $this->dao->count_DAO($this->db);
      }
    public function active_user_BLL($data){
    return $this->dao->active_user_DAO($this->db, $data);
    }
}