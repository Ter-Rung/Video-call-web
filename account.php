<?php
require_once('header.php');

if(!isLogin()) {
    redirect('index.php');
}

$token = getSession('loginToken');
$sql = "select username from logintoken where loginToken ='$token'; ";
$kq = select_user($sql);
$username = $kq['username'];
$sql1 = "select name,birthday,job,location,hobby,src_avt,gender from users where username = '$username';";
$kq1 = select_user($sql1);
extract($kq1);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="asset/account.css">
    <link rel="stylesheet" href="asset/themify-icons/themify-icons.css">
</head>

<body>
    <div class="infomation">
        <div class = "top">
            <a href="index.php" class ="ti-arrow-left"></a>
            <a href="edit.php" class="ti-pencil"></a>
            <img class="avatar" src="<?php echo $src_avt ?>" />
            <div class="name"><?php echo $name; ?></div>
        </div>
        <div class = "bottom">
            <div class="info">
                <span class="span1">Ngày sinh: </span>
                <span class="span2"><?php echo $birthday; ?></span>
            </div>
            <div class="info">
            <span class="span1">Giới tính: </span>
                <span class="span2"><?php echo $gender; ?></span>
            </div>
            <div class="info">
                <span class="span1">Nghề nghiệp: </span>
                <span class="span2"><?php echo $job; ?></span>
            </div>
            <div class="info">
                <span class="span1">Nơi ở: </span>
                <span class="span2"><?php echo $location; ?></span>
            </div>
            <div class="info">
                <span class="span1">Sở Thích:</span>
                <span class="span2"><?php echo $hobby; ?></span>
            </div>

        </div>

            
    </div>


</body>


</html>