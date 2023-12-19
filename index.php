<?php
require_once('header.php');

//Kiểm tra trạng thái đăng nhập
if(!isLogin()) {
    redirect('login.php');
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Đây là dashboard</h1>
    <button><a href="logout.php">Đăng xuất</a></button>
    <button><a href="account.php">Hiển thị thông tin </a></button>
    <button><a href="edit.php">Chỉnh sửa thông tin</a></button>
    <button><a href="reset.php">Đổi mật khẩu</a></button>


</body>
</html>