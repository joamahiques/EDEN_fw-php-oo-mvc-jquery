<?php
//echo json_encode("products model class");
//exit;



$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
define('SITE_ROOT', $path);
require(SITE_ROOT . "module/profile/model/BLL/profile_BLL.class.singleton.php");

class profile_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = profile_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function select_user($user) {
        return $this->bll->select_user_BLL($user);
    }
    public function update_user($arrArgument) {
        return $this->bll->update_user_BLL($arrArgument);
    }

    // public function obtain_countries($url){
    //     return $this->bll->obtain_countries_BLL($url);
    // }

    // public function obtain_provinces(){
    //     return $this->bll->obtain_provinces_BLL();
    // }

    // public Function obtain_cities($arrArgument){
    //     return $this->bll->obtain_cities_BLL($arrArgument);
    // }

}
