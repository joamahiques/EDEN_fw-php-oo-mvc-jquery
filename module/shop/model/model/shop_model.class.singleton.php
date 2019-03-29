<?php
// echo json_encode("home model class");
// exit;



$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
define('SITE_ROOT', $path);
require(SITE_ROOT . "module/shop/model/BLL/shop_BLL.class.singleton.php");

class shop_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = shop_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // public function select_pagination($data) {
    //     return $this->bll->select_pagination_BLL($data);
    // }
    public function count($data) {
        return $this->bll->count_BLL($data);
    }

    // public function selectProvi($data){
    //     return $this->bll->selectProvi_BLL($data);
    // }
    // public function selectProviYLoca($data){
    //     return $this->bll->selectProviYLoca_BLL($data);
    // }
    public function alldrops($data){
        return $this->bll->alldrops_BLL($data);
    }
    // public function search($data){
    //     return $this->bll->search_BLL($data);
    // }
}