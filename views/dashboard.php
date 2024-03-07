<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']; ?></title>
</head>
<body>
    <h1>LOGIN SUKSES USER<h1>
    <h4>selamat datang <?=$_SESSION['user']; ?></h4>
    <p><a href="index.php?url=logout">Logout</a></p>
</body>
</html>