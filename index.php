<?php 
    if(isset($_GET['url'])) {
        $url = $_GET['url'];
        $path = "views/".$url.".php";
        switch ($url) {
            case '':
                include "views/login.php";
                break;
            case "register":
                require_once 'connect.php';
                $data = ['title'=>'R E G I S T E R'];
                include $path;
                break;
            case "login":
                require_once 'connect.php';
                $data = ['title'=>'L O G I N'];
                include $path;
                break;
            case "dashboard":
                require_once 'connect.php';
                $data = ['title'=>'D A S H B O A R D'];
                include $path;
                break;
            default:
                echo "404 Page is not found";
        }
    }
?>