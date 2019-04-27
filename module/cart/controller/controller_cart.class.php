<?php

class controller_cart {

    function __construct() {
        $_SESSION['module'] = "cart";
    }

    function list_cart() {
        require_once(VIEW_PATH_INC . "top-page.php");
        require_once(VIEW_PATH_INC . "header-home.php");
        require_once(VIEW_PATH_INC . "menu.php");
        include(MODULE_VIEW_PATH . "cart.html");
        require_once(VIEW_PATH_INC . "footer.php");
    }
    function insert_cart() {
        $arrArgument = array(
            'cart'=>$_POST['cart'],
            'tok'=>$_POST['tok']
        );
        
        try {
            $arrValue = loadModel(MODEL_MODULE, "cart_model", "insert_cart", $arrArgument);
        } catch (Exception $e) {
            echo ("error");
            exit();
        }
        // echo json_encode($arrValue['res']);
        // exit;
        if($arrValue['res']==false){
            echo json_encode($arrValue);
            exit();
        }else{
            echo json_encode($arrValue);
        }
    }
    function read_cart() {
        try {
            $arrValue = loadModel(MODEL_MODULE, "cart_model", "read_cart", $_POST['tok']);
           // $rlt = $daocart->read_cart($_SESSION['mail']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit();
        }
        if(!$arrValue){
            echo json_encode($arrValue);
            exit();
        }else{
            echo json_encode($arrValue);
            exit;
        }

    }
    function confirm_purchase(){
        try {
            $arrValue = loadModel(MODEL_MODULE, "cart_model", "confirm_purchase", $_POST['tok']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit();
        }
        if(!$arrValue){
            echo json_encode($arrValue);
            exit();
        }else{
            echo json_encode($arrValue);
            exit;
        }

    }
}
    
    // $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/'; ///opt/lampp/htdocs
    // include($path . "module/cart/model/DAOcart.php");
    


    // switch($_GET['op']){
    //     ////////////LIST   
    //         case 'view';
    //             include("module/cart/view/cart.html");
    //         break;
    //         case 'insertcart';
    //             try {
    //                 $daocart = new DAOcart();
    //                 $rlt = $daocart->insert_cart($_POST['cart'],$_SESSION['mail']);
	// 			} catch (Exception $e) {
	// 				echo ("error");
	// 				exit();
    //             }
    //             if(!$rlt){
	// 				echo "error insert";
	// 				exit();
	// 			}else{
    //                 echo "insert";
    //             }
    //         break;

    //         case 'readcart';
    //             try {
    //                 $daocart = new DAOcart();
    //                 $rlt = $daocart->read_cart($_SESSION['mail']);
	// 			} catch (Exception $e) {
	// 				echo json_encode("error");
	// 				exit();
    //             }
    //             if(!$rlt){
	// 				echo json_encode($rlt);
	// 				exit();
	// 			}else{
    //                 $prod = array();///inicializamos el array
    //                 foreach ($rlt as $row) {
    //                     array_push($prod, $row);//lo rellenamos con array_push
    //                 }
    //                 echo json_encode($prod);///lo pasamos a json
    //                 exit;
    //             }
    //         break;
    //         case 'confirmpurchase';
    //         try {
    //             $daocart = new DAOcart();
    //             $rlt = $daocart->confirm_purchase($_SESSION['mail']);
    //         } catch (Exception $e) {
    //             echo json_encode("error");
    //             exit();
    //         }
    //         break;
    //         default;
    //             include("vista/include/error404.php");
    //         break;
    //}