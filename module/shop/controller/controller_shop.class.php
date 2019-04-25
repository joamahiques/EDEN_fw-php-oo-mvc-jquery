<?php
class controller_shop{

    function __construct() {
        // include(FUNCTIONS_HOME . "utils.inc.php");
        $_SESSION['module'] = "shop";
    }
    function list_shop() {
        // echo json_encode("yeess list home");
        // exit;
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(MODULE_VIEW_PATH . "shop.php");
        require_once(VIEW_PATH_INC . "footer.php");
        if (isset($_SESSION["tiempo"])) {  
            $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
        }
    }

    function list_map() {
      
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(MODULE_VIEW_PATH . "ubication.html");
        require_once(VIEW_PATH_INC . "footer.php");
    }

    function products(){
        $search= json_decode($_POST['search'],true);
        if( isset($search['page_num']) ){

            //set_error_handler('ErrorHandler');
            try{
            $page					=	intval($search['page_num']);//number of page
            $current_page			=	$page - 1;
            $records_per_page		=	6; // records to show per page
            $start					=	$current_page * $records_per_page;//first limit to search
            $val                    =   ($search['val']);
            $provi                  =   ($search['provi']);
            $local                  =   ($search['local']);
            $arrArgument = array(
                'start'=>$start,
                'records'=>$records_per_page,
                'val'=>$val,
                'provi'=>$provi,
                'local'=>$local
            );
            
            $totalResults = loadModel(MODEL_MODULE, "shop_model", "count", $arrArgument);/// to count the total of houses
            $arrValue = loadModel(MODEL_MODULE, "shop_model", "alldrops", $arrArgument);
            $result= array('totalcount'=>$totalResults,'results' => $arrValue);
            
         }catch(Exception $e) {echo json_encode($e+"error shop");}
            restore_error_handler();
            if(($totalResults)&&($arrValue)){
                echo json_encode($result);
            }else{
                echo json_encode($result);
            }
           
        }
    }
    
    function ubication(){
        $direccion = $_POST['muni'].','.$_POST['ubi'].',ESPAÑA';
       
        // Obtener los resultados JSON de la peticion.
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key='.apikeymap.'&address='.urlencode($direccion));
        // Convertir el JSON en array.
        $geo = json_decode($geo, true);
        
        // Si todo esta bien
        if ($geo['status'] = 'OK') {
            // Obtener los valores
            $latitud = $geo['results'][0]['geometry']['location']['lat'];
            $longitud = $geo['results'][0]['geometry']['location']['lng'];
            $arrArgument = array(
                'lat'=>$latitud,
                'long'=>$longitud
            );
            echo json_encode($arrArgument);
        }
        
    }
    function productsmap(){
        $search= json_decode($_POST['searchmap'],true);
        // echo json_encode($search);
        // exit;
            $val                    =   ($search['val']);
            $provi                  =   ($search['provi']);
            $local                  =   ($search['local']);
            $arrArgument = array(
                'val'=>$val,
                'provi'=>$provi,
                'local'=>$local
            );
            $arrValue = loadModel(MODEL_MODULE, "shop_model", "productsmap", $arrArgument);
            echo json_encode($arrValue);
    }
}
     ?>
            