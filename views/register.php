<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']; ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<?php 
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validate username
        if (strlen($username < 3)) {
            $usernameErr = "Username at least 3 charactet";
        }else{
            $checkUser = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($conn,$checkUser);
            if (mysqli_num_rows($result) > 0) {
                $usernameErr = "This $username has been register!!!";
            }else{
                $usernameSecured = trim(htmlentities($username));
            }
        }

        // validate password
        if (strlen($password) < 3) {
            $passwordErr = "Password at least 3 character";
        }else{
            $passwordSec = trim(htmlentities($password));
            $passwordSecured = password_hash($passwordSec, PASSWORD_DEFAULT);
        }

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid Format Email";
        }else {
            $checkEmail = "SELECT email FROM users WHERE email='$email'";
            $result = mysqli_query($conn,$checkEmail);
            if (mysqli_num_rows($result) > 0) {
                $emailErr = "The $email has been register!!!";
            }else {
                $emailSecured =trim(htmlentities($email)) ;
            }
        }

        // validate agaian for all
        if (isset($usernameSecured) && isset($emailSecured) && isset($passwordSecured)) {
            // insert to database
            $query = "INSERT INTO users(username,password,email) VALUES ('$usernameSecured','$passwordSecured','$emailSecured')";
            mysqli_query($conn,$query);
            header("location: index.php?url=login&success=You Have Successfully Registered");
        }else {
            $error = "Failed to Register";
        }


    }
?>
<body>
    <div class="form">
        <form action="" method="post">
            <div class="form-group">
                <small class="success <?=(isset($error)) ? 'err':'';?>">
                    <?php 
                        if (isset($error)) {
                            echo $error;
                        }
                    ?>
                </small>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
                <small class="err">
                    <?php 
                        if(isset($usernameErr)){echo $usernameErr;}
                    ?>
                </small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <small class="err">
                    <?php 
                        if(isset($emailErr)){echo $emailErr;}
                    ?>
                </small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="err">
                    <?php 
                        if(isset($passwordErr)){echo $passwordErr;}
                    ?>
                </small>
            </div>
            <div class="form-group">
                <button type="submit" name="register" class="letter-spacing">Register</button>
            </div>
        </form>
    </div>
</body>
</html>