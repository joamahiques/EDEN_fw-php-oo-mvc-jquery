<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/';
   
    include($path ."module/home/model/DAOhome.php");
    @session_start();
    $path_model = $_SERVER['DOCUMENT_ROOT'] . '/www/EDEN/module/home/model/model/';
    include ($path . "/utils/common.inc.php");
       
    switch($_GET['op']){
            case 'lis':
                $totalResults = loadModel($path_model, "home_model", "count");/// to count the total of houses
                if( isset( $_POST['p'] ) ){
                    $page					=	intval( $_POST['p'] );
                    $current_page			=	$page - 1;
                    $records_per_page		=	6; // records to show per page
                    $start					=	$current_page * $records_per_page;
                    $arrArgument = array(
                        'start'=>$start,
                        'records'=>$records_per_page
                    );
                    $arrValue = loadModel($path_model, "home_model", "select_scroll", $arrArgument);
                    $result= array('totalcount'=>$totalResults,'results' => $arrValue);
                    echo json_encode($result);
                }
            break;
            // case 'list':
            //     if(isset($_POST['provinciaini'])){
            //         $proini = $_POST["provinciaini"];
            //         try{
            //             $DAOhome = new DAOhome();
            //             $rdo = $DAOhome->select_all_homes_and_order($proini);
            //          }catch (Exception $e){
            //             $callback = 'index.php?page=503';
            //             die('<script>window.location.href="'.$callback .'";</script>');
            //         }
            //     }else{
            //         try{
            //             $DAOhome = new DAOhome();
            //             $rdo = $DAOhome->select_all_homes();
            //         }catch (Exception $e){
            //             $callback = 'index.php?page=503';
            //             die('<script>window.location.href="'.$callback .'";</script>');
            //         }
            //     }
            //     if(!$rdo){
            //         $callback = 'index.php?page=503';
            //         die('<script>window.location.href="'.$callback .'";</script>');
            //     }else{
            //         include("module/home/view/home.php");
            //     }
            //     break;
           
            
                
            default:
                include("view/inc/error/error404.php");
                break;
        }
        

?>
            