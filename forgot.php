<?php 
require_once('header.php');


if(isPost()) {
    $filterAll = filter();
    $error = [];
    if(empty($filterAll['username']))
    {
        setFlashData('msg','Vui lòng nhập username/email');
        setFlashData('msg_type','danger');
    } 
    else 
    {
        $username = $filterAll['username'];
        $email = $filterAll['email'];
        $sql = 'Select username,email from users where username = "'.$username.'"';
        $kq= select_user($sql);
        if(!empty($kq))
        {
            $email_user = $kq['email'];
            if($email_user == $email) 
            {
                //tạo forgotToken
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $forgotToken = sha1(uniqid().time());
                $dataUpdate = [
                    'forgotToken' => $forgotToken
                ];
                //update forgotToken vào database
                $condition = 'username = "'.$username.'";';
                $updateStatus = update('users',$dataUpdate,$condition);
                if($updateStatus) 
                {
                    setSession('forgotToken',$forgotToken);
                    redirect('reset.php');                 
                }

            } else 
            {
                setFlashData('msg','Email không đúng');
                setFlashData('msg_type','danger');
            }
        }
        else 
        {
            setFlashData('msg','Không tìm thấy user');
            setFlashData('msg_type','danger');
        }
        
    }
}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Merriweather:wght@400;700&family=Montserrat:ital,wght@1,200&display=swap"
        rel="stylesheet">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="asset/base.css">
    <link rel="stylesheet" href="asset/login.css">
</head>
<body>
<form action="#" method="post">
    <div class="frame login-form">
        <div class="login-form__header">
            <h3 class="login-form_heading">Forgot Password</h3>
        </div>
         <?php 
               if(!empty($msg)) {
                   getMsg($msg,$msg_type);
               }
        ?> 

        <div class="login-form__wrapper">
            <div class="login-form__form">
                <div class="login-form__group">
                    <input type="text" name="username" class="login-form__input" placeholder="Username">
                </div>
                <div class="login-form__group">
                    <input type="email" name="email" class="login-form__input" placeholder="Email">
                </div>
                
                <div class="login-form__group">
                    <input type="submit" name="submit_login" value="Enter" class="btn btn-login">
                </div>
            </div>
    </form>
    <div class="login-form__forgot-password">
                <p class="login-form__text-forgot"> <a href="login.php"
                        class="login-form__link-forgot">Click here to Login
                    </a>
                </p>
        </div>

        <div class="login-form__register">
                <a href="register.php" class="btn btn-register">Register New Account</a>
        </div>
</body>
</html>