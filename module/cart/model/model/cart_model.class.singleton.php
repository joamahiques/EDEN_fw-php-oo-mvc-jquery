<?php
// echo json_encode("home model class");
// exit;



// $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
// // define('SITE_ROOT', $path);

//require(SITE_ROOT . "module/home/model/BLL/home_BLL.class.singleton.php");

class cart_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = cart_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function insert_cart($data) {
        return $this->bll->insert_cart_BLL($data);
    }
    public function read_cart($data) {
        return $this->bll->read_cart_BLL($data);
    }
    public function confirm_purchase($data) {
        return $this->bll->confirm_purchase_BLL($data);
    }
}