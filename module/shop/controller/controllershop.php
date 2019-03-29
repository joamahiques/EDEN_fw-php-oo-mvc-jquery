<?php
    @session_start();
	$path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/shop/model/model/';
    include($path . "module/shop/model/DAOShop.php");
    include($path . "/utils/common.inc.php");
	////tiempo para logout
    if (isset($_SESSION["tiempo"])) {  
	    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
	}
	
    switch ($_GET['op']) {
        case 'searchComplete':
           
             //$totalResults = loadModel($path_model, "shop_model", "count");/// to count the total of houses
            // echo json_encode($totalResults);
            // exit;
            
            if( isset($_GET['page_num']) ){
                $page					=	intval($_GET['page_num']);//number of page
                $current_page			=	$page - 1;
                $records_per_page		=	6; // records to show per page
                $start					=	$current_page * $records_per_page;//first limit to search
                $val                    =   ($_GET['val']);
                $provi                  =   ($_GET['provi']);
                $local                  =   ($_GET['local']);
                $arrArgument = array(
                    'start'=>$start,
                    'records'=>$records_per_page,
                    'val'=>$val,
                    'provi'=>$provi,
                    'local'=>$local
                );
                
                $totalResults = loadModel($path_model, "shop_model", "count", $arrArgument);/// to count the total of houses
                $arrValue = loadModel($path_model, "shop_model", "alldrops", $arrArgument);
                //$totalResults=count($arrValue);
                $result= array('totalcount'=>$totalResults,'results' => $arrValue);
                echo json_encode($result);
                // echo json_encode($arrValue);
            }
            
            break;
       
        // case 'view':
            
        //     include("module/shop/view/shop.php");
            
        //     break;
       
        // case 'list':
        
        //     try{
        //         $DAOshop = new DAOShop();
        //         $rdo = $DAOshop->select_all_homes();
        
        //         }catch (Exception $e){
        //             echo json_encode("error");
        //             exit;
        //         }
        //         if(!$rdo){
        //             echo json_encode("error");
        //             exit;
        //         }else{
        //             $favor = array();///inicializamos el array
        //             foreach ($rdo as $row) {
        //                 array_push($favor, $row);//lo rellenamos con array_push
        //             }
        //             echo json_encode($favor);///lo pasamos a json
        //             exit;
        //         }
        //         break;
			
    //    case 'searchProvince1':
                // $totalResults = loadModel($path_model, "shop_model", "count");/// to count the total of houses
                // echo json_encode($totalResults);
                // exit;
                
                // if( isset($_GET['page_num']) ){
                //     $page					=	intval($_GET['page_num']);//number of page
                //     $current_page			=	$page - 1;
                //     $records_per_page		=	6; // records to show per page
                //     $start					=	$current_page * $records_per_page;//first limit to search
                //     $provi                  =   ($_GET['provi']);
                //     $arrArgument = array(
                //         'start'=>$start,
                //         'records'=>$records_per_page,
                //         'provi'=>$provi,
                //     );
                    
                //     $arrValue = loadModel($path_model, "shop_model", "selectProvi", $arrArgument);
                //     $totalResults=count($arrValue);
                //     $result= array('totalcount'=>$totalResults,'results' => $arrValue);
                //     echo json_encode($result);
                // }
                 
                // try{
                //     $DAOshop = new DAOShop();
                //     $rdo = $DAOshop->select_all_homes_and_order($_GET['provi']);

                // }catch (Exception $e){
                //     echo json_encode("error");
                //     exit;
                // }
                // if(!$rdo){
                //     echo json_encode("error");
                //     exit;
                // }else{
                //     $favor = array();///inicializamos el array
                //     foreach ($rdo as $row) {
                //         array_push($favor, $row);//lo rellenamos con array_push
                //     }
                //     echo json_encode($favor);///lo pasamos a json
                //     exit;
                // }
                // break;
                
            
        // case 'searchPorYLoc':
            //$totalResults = loadModel($path_model, "shop_model", "count");/// to count the total of houses
            // echo json_encode($totalResults);
            // exit;
            
            // if( isset($_GET['page_num']) ){
            //     $page					=	intval($_GET['page_num']);//number of page
            //     $current_page			=	$page - 1;
            //     $records_per_page		=	6; // records to show per page
            //     $start					=	$current_page * $records_per_page;//first limit to search
            //     $provi                  =   ($_GET['provi']);
            //     $local                  =   ($_GET['local']);
            //     $arrArgument = array(
            //         'start'=>$start,
            //         'records'=>$records_per_page,
            //         'provi'=>$provi,
            //         'local'=>$local
            //     );
            //     $arrValue = loadModel($path_model, "shop_model", "selectProviYLoca", $arrArgument);
            //     $totalResults=count($arrValue);
            //     $result= array('totalcount'=>$totalResults,'results' => $arrValue);
            //     echo json_encode($result);
            // }
            
            // break;
            
        // case 'search':// solo po rlo escrito en el input de autocomplete
                //$totalResults = loadModel($path_model, "shop_model", "count");/// to count the total of houses
                // echo json_encode($totalResults);
                // exit;
                
        //         if( isset($_GET['page_num']) ){
        //             $page					=	intval($_GET['page_num']);//number of page
        //             $current_page			=	$page - 1;
        //             $records_per_page		=	6; // records to show per page
        //             $start					=	$current_page * $records_per_page;//first limit to search
        //             $val                    =   ($_GET['val']);
        //             $arrArgument = array(
        //                 'start'=>$start,
        //                 'records'=>$records_per_page,
        //                 'val'=>$val
        //             );
        //             $arrValue = loadModel($path_model, "shop_model", "search", $arrArgument);
        //             $totalResults=count($arrValue);
        //             $result= array('totalcount'=>$totalResults,'results' => $arrValue);
        //             echo json_encode($result);
        //         }
            
        // break;
        // case 'lis':
        
        //         $totalResults = loadModel($path_model, "shop_model", "count");/// to count the total of houses
        //         // echo json_encode($totalResults);
        //         // exit;
                
        //         if( isset($_GET['page_num']) ){
        //             $page					=	intval($_GET['page_num']);//number of page
        //             $current_page			=	$page - 1;
        //             $records_per_page		=	6; // records to show per page
        //             $start					=	$current_page * $records_per_page;//first limit to search
        //             $arrArgument = array(
        //                 'start'=>$start,
        //                 'records'=>$records_per_page
        //             );
        //             $arrValue = loadModel($path_model, "shop_model", "select_pagination", $arrArgument);
        //             // echo json_encode(count($arrValue));
        //             // exit;
        //             $result= array('totalcount'=>$totalResults,'results' => $arrValue);
        //             echo json_encode($result);
        //         }
        //     break;
           
		default:
			include($path ."view/inc/error/error404.php");
			break;
	}
    

?>
            