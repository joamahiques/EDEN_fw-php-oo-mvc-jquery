<?php
// echo json_encode("shop_dao.class.singleton.php");
// exit;

class shopDAO {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_pagination_DAO($db, $data){
        $start = $data['start'];
        $records_per_page = $data['records'];
        $sql = "SELECT * from casas ORDER BY provincia ASC LIMIT $start, $records_per_page";
        
        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }

    public function count_DAO($db) {
        $sql = "SELECT count(*) as totalcasas FROM casas";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        
    }
    public function selectProvi_DAO($db, $data){
        $provi=$data['provi'];
        $start = $data['start'];
        $records_per_page = $data['records'];
        
        $sql = "SELECT * FROM casas WHERE provincia='$provi' ORDER BY localidad ASC,capacidad ASC LIMIT $start, $records_per_page";
        
        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
    public function selectProviYLoca_DAO($db, $data){
        $provi=$data['provi'];
        $local=$data['local'];
        $start = $data['start'];
        $records_per_page = $data['records'];

        $sql = "SELECT * FROM casas WHERE provincia='$provi' AND localidad='$local' ORDER BY capacidad ASC LIMIT $start, $records_per_page";

        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
    public function alldrops_DAO($db, $data){ //$provi,$local,$val
        $provi=$data['provi'];
        $local=$data['local'];
        $val=$data['val'];
        $start = $data['start'];
        $records_per_page = $data['records'];
        $sql = "SELECT * FROM casas WHERE provincia='$provi' AND localidad='$local' AND nombre LIKE '".$val. "%' LIMIT $start, $records_per_page";

        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }

    public function search_DAO($db,$data){
        $val=$data['val'];
        $start = $data['start'];
        $records_per_page = $data['records'];
        $sql = "SELECT * FROM casas WHERE nombre LIKE '".$val. "%' ORDER BY provincia ASC, localidad ASC, capacidad ASC LIMIT $start, $records_per_page";

        $stmp = $db->ejecutar($sql);
        return $db->listar($stmp);
    }
}