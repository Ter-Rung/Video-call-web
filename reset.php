<?php 
require_once('header.php');



if(empty(getSession('forgotToken')) && !isLogin()){
    redirect('forgot.php');
}
if(!empty(getSession('forgotToken'))) {
    $forgotToken = getSession('forgotToken');
    $sql = 'select username from users where forgotToken ="'.$forgotToken.'";';
} 
if(isLogin()) {
    $loginToken = getSession('loginToken');
    $sql = "select username from logintoken where loginToken = '$loginToken';";   
}
    $kq = select_user($sql);
    if(!empty($kq)) 
    {
        $username = $kq['username'];
        if(isPost()) 
    {
        $filterAll = filter();
        //validate password: bắt buộc phải nhập, lớn hơn bằng 8 kí tự
        if(empty($filterAll['password'])) 
        {
            setFlashData('msg','Vui lòng nhập password mới');
            setFlashData('msg_type','danger');
            redirect('reset.php');
        } 
        else 
        {
            if(strlen($filterAll['password']) <8 )
            {
                setFlashData('msg','Vui lòng nhập password có lớn hơn hoặc bằng 8 kí tự');
                setFlashData('msg_type','danger');
                redirect('reset.php');
            }
        }

        //validate re-password: bắt buộc phải nhập, phải giống password
        if(empty($filterAll['re-password'])) 
        {
            setFlashData('msg','Vui lòng nhập lại password mới');
            setFlashData('msg_type','danger');
            redirect('reset.php');
        }
        else
        {   
       
            if($filterAll['re-password'] != $filterAll['password'])
            {   
                setFlashData('msg','Nhập lại password không đúng');
                setFlashData('msg_type','danger');
                //redirect('reset.php');
            }
            else 
            {
                $password = $filterAll['password'];
                $password = password_hash($password,PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $password,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $condition = 'username ="'.$username.'";';
                $statusUpdate = update('users',$dataUpdate,$condition);
                if($statusUpdate)
                {
                    if(!empty(getSession('forgotToken'))) {
                        deleteSession('forgotToken');
                        redirect('login.php');
                    } 
                    if(isLogin()){
                        redirect('index.php');
                    }
                
                }
            }
        }
    }
} 
else 
{
    redirect('forgot.php');
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="asset/base.css">
    <link rel="stylesheet" href="asset/reset.css">
</head>
<body>
<form action="#" method="post">
    <div class="frame login-form">
        <div class="login-form__header">
            <h3 class="login-form_heading">Reset Password</h3>
        </div>
         <?php 
               if(!empty($msg)) {
                   getMsg($msg,$msg_type);
               }
        ?> 

        <div class="login-form__wrapper">
            <div class="login-form__form">
             
                <div class="login-form__group">
                    <input type="password" name="password" class="login-form__input" placeholder="New password">
                </div>
                <div class="login-form__group">
                    <input type="password" name="re-password" class="login-form__input" placeholder="Re-password">
                </div>
                
                <div class="login-form__group">
                    <input type="submit" name="submit_login" value="Enter" class="btn btn-login">
                </div>
            </div>
    </form>
</body>
</html>