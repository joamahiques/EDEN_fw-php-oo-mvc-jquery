<?php

class login_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = login_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function validate_BLL($data){
        return $this->dao->validate_DAO($this->db, $data);
      }
    public function insert_user_BLL(){
        return $this->dao->insert_user_DAO($this->db);
    }
    public function select_user_BLL(){
        return $this->dao->select_user_DAO($this->db);
    }
}