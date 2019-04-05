<?php
////////debug
    function debugPHP($array){
        echo "<pre>";
        print_r($array);
        echo "</pre><br>";
    }
    // function console_log( $data ){
    //     echo '<script>';
    //     echo 'console.log('. json_encode( $data ) .')';
    //     echo '</script>';
    //   };
    /////callback  
    function redirect($url){
        die('<script>top.location.href="'.$url.'";</script>');
    }
/////////pretty URL
    function amigable($url, $return = false) {
        
        $amigableson = URL_AMIGABLES;
        $link = "";
        // $find=array(' ','&','?');
        // $link=str_replace($find, "/", $url);
        // $url = "index.php" . $link;
        if ($amigableson) {
            $url = explode("&", str_replace("?", "", $url));
           
            foreach ($url as $key => $value) {
                $aux = explode("=", $value);
                $link .=  $aux[1]."/";
            }
        } else {
            $link = "index.php" . $url;
        }

        if ($return) {
            return SITE_PATH . $link;
        }
        // $url=SITE_PATH . "index.php/" .$link;
        $url=SITE_PATH .$link;
        echo $url;
        
        //echo $url;
        // echo SITE_PATH.'index.php/module=home/function=list_home';
        
    }
    