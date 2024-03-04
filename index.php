<?php 
    if(isset($_GET['url'])) {
        $url = $_GET['url'];
        $path = "views/".$url.".php";
        switch ($url) {
            case '':
                include "views/home.php";
                break;
            case "home":
                include $path;
                break;
            case "register":
                require_once 'connect.php';
                include $path;
                break;
            default:
                echo "404 Page is not found";
        }
    }
?>