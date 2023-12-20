<?php
require_once('header.php');

//Kiểm tra trạng thái đăng nhập
if(isLogin()) {
    redirect('index.php');
}
else 
{
    if(isPost()) {
        $filterAll = filter();
        if(!empty($filterAll['username']) && !empty($filterAll['password'])) {
            //xử lý
            $username = $filterAll['username'];
            $password = $filterAll['password'];
            //Lấy thông tin user
            $sql = 'select password,role from users where username ="'.$username.'"';
            $kq = select_user($sql);
            
            if(!empty($kq)) {
                $password_user = $kq['password'];
                $role = $kq['role'];
                print_r($role);
                if(password_verify($password,$password_user)) {
                    //Tạo token login
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $tokenLogin = sha1(uniqid().time());
                    $sql ="select loginToken from logintoken where username ='$username'; ";
                    $kq = select_user($sql);
                    if($kq) {
                        $dataUpdate = [
                            'loginToken' => $tokenLogin
                        ];
                        $condition = "username = '$username'; ";
                        $statusUpdate = update('logintoken',$dataUpdate,$condition);
                        if($statusUpdate) 
                        {   
                            setSession('loginToken',$tokenLogin);
                            if($role == 'User') {
                                redirect('index.php');
                            }else 
                            {
                                redirect('admin.php');
                            }
                        } 
                        else 
                        {
                            setFlashData('msg','Không thể đăng nhập');
                            setFlashData('msg_type','danger');
                        }
                    }
                    else 
                    {
                    //insert tokenlogin vào bảng logintoken
                    $dataInsert = [
                        'username' => $username,
                        'loginToken' => $tokenLogin,
                        'create_at' => date('Y-m-d H:i:s')
                    ];
                    $insertStatus = insert('logintoken',$dataInsert);
                    if($insertStatus) {
                        //Insert thành công
                        //lưu logintoken vào session
                        setSession('loginToken',$tokenLogin);
                        if($role == 'User') {
                            redirect('index.php');
                        }else 
                        {
                            redirect('admin.php');
                        }
                    } else {
                        setFlashData('msg','Không thể đăng nhập');
                        setFlashData('msg_type','danger');
                    }
                    }

                } 
                else {
                    setFlashData('msg','Username/Password không đúng');
                    setFlashData('msg_type','danger');
                }
            } 
            else {
                setFlashData('msg','Username không tồn tại hoặc đã bị ban khỏi hệ thống');
                setFlashData('msg_type','danger');
                
            }
        } 
        else {
            setFlashData('msg','Vui lòng kiểm tra username/password');
            setFlashData('msg_type','danger');
            
        }
        redirect('login.php');
    }
}





$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');


?>



<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Merriweather:wght@400;700&family=Montserrat:ital,wght@1,200&display=swap"
        rel="stylesheet">
    <title>Login</title>
    <link rel="stylesheet" href="asset/base.css">
    <link rel="stylesheet" href="asset/login.css">
</head>

<body>
    <form action="#" method="post">
        <div class="frame login-form">
            <div class="login-form__header">
                <h3 class="login-form_heading">Login</h3>
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
                    <input type="password" name="password" class="login-form__input" placeholder="Password">
                    </div>

                    <div class="login-form__group">
                    <input type="submit" name="submit_login" value="Login" class="btn btn-login">
                    </div>
                </div>
    </form>
        <div class="login-form__forgot-password">
                <p class="login-form__text-forgot">I forgot my password. <a href="forgot.php"
                        class="login-form__link-forgot">Click
                        here to reset</a>
                </p>
        </div>

        <div class="login-form__register">
                <a href="register.php" class="btn btn-register">Register New Account</a>
        </div>
        </div>

    </div>
   
</body>

</html>