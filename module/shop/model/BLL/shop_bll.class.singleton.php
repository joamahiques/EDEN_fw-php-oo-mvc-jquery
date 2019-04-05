<?php
// echo json_encode("shop_bll.class.singleton.php");
// exit;

// $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
// // define('SITE_ROOT', $path);
// define('MODEL_PATH', SITE_ROOT . 'model/');

// require(MODEL_PATH . "db.class.singleton.php");
// require(SITE_ROOT . "module/shop/model/DAO/shop_DAO.class.singleton.php");

class shop_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = shop_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // public function select_pagination_BLL($data){
    //   return $this->dao->select_pagination_DAO($this->db, $data);
    // }
    public function count_BLL($data){
        return $this->dao->count_DAO($this->db, $data);
    }
    // public function selectProvi_BLL($data){
    //     return $this->dao->selectProvi_DAO($this->db, $data);
    // }
    // public function selectProviYLoca_BLL($data){
    //     return $this->dao->selectProviYLoca_DAO($this->db, $data);
    // }
    public function alldrops_BLL($data){
        return $this->dao->alldrops_DAO($this->db, $data);
    }
    // public function search_BLL($data){
    //     return $this->dao->search_DAO($this->db, $data);
    // }  
}