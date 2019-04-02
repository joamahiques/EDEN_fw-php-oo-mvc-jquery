<?php
// echo json_encode("home model class");
// exit;



$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
// define('SITE_ROOT', $path);
require(SITE_ROOT . "module/home/model/BLL/home_BLL.class.singleton.php");

class home_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = home_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function select_scroll($data) {
        return $this->bll->select_scroll_BLL($data);
    }
    public function count() {
        return $this->bll->count_BLL();
    }
}