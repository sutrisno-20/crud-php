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
                session_start();
                require_once 'connect.php';
                $data = ['title'=>'L O G I N'];
                include $path;
                break; 
            case "dashboard":
                session_start();
                require_once 'connect.php';
                $userSession = $_SESSION['user'];
                $query = "SELECT username,status FROM users WHERE username='$userSession'";
                $result = mysqli_query($conn,$query);
                if (mysqli_num_rows($result) === 1) {
                    $data = ['title'=>'D A S H B O A R D'];
                    include $path;
                }else {
                    header("location: index.php?url=login&status=Anda Harus Login Terlebih Dahulu!");
                }
                break;
            case "admin":
                session_start();
                require_once 'connect.php';
                $userSession = $_SESSION['user'];
                $query = "SELECT username,status FROM users WHERE username='$userSession'";
                $result = mysqli_query($conn,$query);
                if (mysqli_num_rows($result)>0) {
                    $data = ['title'=>'A D M I N'];
                    include $path;
                }else {
                    header("location: index.php?url=login&status=Anda Harus Login Sebagai Admin!");
                }
                break;
            case "logout":
                require_once 'connect.php';
                include $path;
                header("location: index.php?url=login&logout=Anda Berhasil Logout");
                break;
            default:
                echo "404 Page is not found";
        }
    }
?>