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
            //  var_dump($user);
             if(password_verify($password,$user['password'])) {
                // echo "sukses login";
                 // Redirect to login page
                 header("location: index.php?url=dashboard");
             }else{
                echo "gagal";
             }
         }else{
             echo "Username  is wrong";
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
        </form>
    </div>
</body>
</html>