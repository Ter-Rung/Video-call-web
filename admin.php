<?php
if(!isLogin()) {
    redirect('login.php');
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dashboard admin</h1>

    <button><a href="logout.php">Đăng xuất</a></button>
</body>
</html>