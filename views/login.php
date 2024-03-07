<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title'];?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<?php 
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password =trim(htmlentities($_POST['password']));
        
         // validate username
         $query = "SELECT * FROM users WHERE username='$username'";
         $result = mysqli_query($conn,$query);
         if(mysqli_num_rows($result)>0) { 
             $user = mysqli_fetch_assoc($result);
             if(password_verify($password,$user['password'])) {
                
                 session_start();
                 $_SESSION['user'] = $user['username'];
                 $_SESSION['status'] = $user['status'];
                 if(isset($_SESSION['user']) && $_SESSION['status'] == 1) {
                    header("location: index.php?url=admin");
                    exit();   
                 }
                 if(isset($_SESSION['user']) && $_SESSION['status'] == 2) {
                    header("location: index.php?url=dashboard");
                    exit();   
                 }
                 
                header("location: index.php?url=login&status=Anda Harus Register Dahulu!!!");
                exit();
        
                 
             }else{
                $err = "Username or Password is Wrong";
             }
         }else{
             $err = "Username or Password is Wrong";
         }
    }

    // signup
    if (isset($_POST['signup'])) {
        header("location: index.php?url=register");
    }
?>
<body>
    <div class="form">
        <form action="" method="post">
            <div class="form-group">
            <small class="success <?=(isset($_GET['success'])) ? 'good':'err';?>">
                    <?php 
                        if (isset($_GET['success'])) {
                            echo $_GET['success'];
                        }
                        if(isset($err)){
                            echo $err;
                        }
                    ?>
                </small>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group d-flex justify-content-space-between mt-3">
                <button type="submit" name="login" class="letter-spacing">Login</button>
                <button type="submit" name="signup" class="letter-spacing">Register</button>
            </div>
            <div class="form-group text-center">
                <small class="err">
                    <?php 
                    if (isset($_GET['status'])) {
                        echo $_GET['status'];
                    }
                    ?>
                </small>
            </div>
        </form>
    </div>
</body>
</html>