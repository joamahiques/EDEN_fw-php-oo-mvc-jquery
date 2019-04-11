<?php

class login_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = login_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function validate($data) {
        return $this->bll->validate_BLL($data);
    }
    public function insert_user() {
        return $this->bll->insert_user_BLL();
    }
    public function select_user() {
        return $this->bll->select_user_BLL();
    }
}