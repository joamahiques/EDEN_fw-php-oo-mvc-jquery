<?php
    function debugPHP($array){
        echo "<pre>";
        print_r($array);
        echo "</pre><br>";
    }
    /////callback   window.href de js
    function redirect($url){
        die('<script>top.location.href="'.$url.'";</script>');
    }