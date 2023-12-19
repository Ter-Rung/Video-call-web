<?php
require_once('header.php');

if(isPost()) {
     $filterAll = filter();
     $error = []; //mảng chứa các lỗi

    //validate username: bắt buộc phải nhập, không được trùng tk có sẵn
        if(empty($filterAll['username'])) 
        {
        $error['username']['require'] = 'Bắt buộc nhập username';
        } else 
        {
            $username = $filterAll['username'];
            $sql = 'Select username from users where username = "'.$username.'"';
            $sql1 ='Select username from ban where username = "'.$username.'"';
            $kq= select_user($sql);
            $kq1 = select_user($sql1);
            if($kq) 
            {
                $error['username']['unique'] ='Username đã tồn tại';
            } else 
                if($kq1) 
                {
                    $error['username']['report'] = 'Username đã bị ban khỏi hệ thống vui lòng đặt username khác';
                }

        }

    //validate password: bắt buộc phải nhập, lớn hơn 8 kí tự
    if(empty($filterAll['password'])) {
        $error['password']['require'] = 'Bắt buộc nhập password';
    } else {
        if (strlen($filterAll['password']) <8 ) {
        $error['password']['min'] = 'Bắt buộc phải lớn hơn hoặc bằng 8 kí tự';
        }
    }

    //validate re_password: bắt buộc phải nhập và giống password
    if(empty($filterAll['re-password'])) {
        $error['re-password']['require'] = 'Bắt buộc nhập lại password';
    } else {
        if ($filterAll['re-password'] != $filterAll['password'] ) {
        $error['re-password']['match'] = 'Mật khẩu bạn nhập lại không đúng';
        }
    }

    //validate name: bắt buộc phải nhập tên
    if(empty($filterAll['name'])) {
        $error['name']['require'] = 'Bắt buộc nhập tên ';
    }

    //validate email: bắt buộc nhập email, không được trùng email
    if(empty($filterAll['email'])) {
        $error['email']['require'] = 'Bắt buộc nhập email';
    } else {
        $email = $filterAll['email'];
        $sql = 'Select email from users where email = "'.$email.'"';
        $kq= select_user($sql);
        if($kq) {
            $error['email']['unique'] ='Email đã tồn tại';
        } 
    }



    if(empty($error)) {
        //xử lý insert
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = [
            'create_at' => date('Y-m-d H:i:s')
        ];
        foreach ($filterAll as $key => $value) {
            if(empty($value) || $key =='submit' || $key == 're-password') {
                continue;
            }
            if($key =='password') {
                $value = password_hash($value,PASSWORD_DEFAULT);
            }
            $data[$key] =$value;
           }
           //print_r($data);
          $kq = insert('users',$data);
          if($kq) {
            setFlashData('msg','Đăng kí thành công <br> <a href ="login.php">Nhấp vào đây để di chuyển đến trang đăng nhập</a>');
            setFlashData('msg_type','success');
           // redirect('login.php');
          }


    } else {
        setFlashData('msg','Vui lòng kiểm tra dữ liệu');
        setFlashData('msg_type','danger');
        setFlashData('error',$error);
        //setFlashData('old',$filterAll);
        redirect('register.php');
    }


 }

 $msg = getFlashData('msg');
 $msg_type = getFlashData('msg_type');
 $error = getFlashData('error');
 $old = getFlashData('old');
?>  


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="asset/register.css">
</head>

<body>
    <div class="container">
        <div class="register">
            <p class="register_1">Register</p>
        </div>
        <div class="line"></div>
        
        <div class="form">
            <form action="#" class="form-data" method ="post">
            <?php 
                if(!empty($msg)) {
                    getMsg($msg,$msg_type);
                }
            ?>
               
                <div class="div_input">
                    <input type="text" name="username" id="username" placeholder="Username" class="info_input username">
                    <?php 
                    echo form_error('username','<span class = "error">','</span>',$error) ;
                ?>
                </div>
                <div class="div_input">
                    <input type="password" name="password" id="password" placeholder="Password" class="info_input">
                    <?php 
                    echo form_error('password','<span class = "error">','</span>',$error) ;
                 
                   
                ?>
                </div>
                <div class="div_input">
                    <input type="password" name="re-password" id="re-password" placeholder="Re-password" class="info_input">
                    <?php 
                    echo form_error('re-password','<span class = "error">','</span>',$error) ;
                     
                   
                ?>
                </div>
                <div class="div_input">
                    <input type="text" name="name" id="name" placeholder="Name" class="info_input">
                    <?php 
                    echo form_error('name','<span class = "error">','</span>',$error) ;
                ?>

                </div>
                <div class="div_input">
                    <input type="email" name="email" id="email" placeholder="Email" class="info_input">
                    <?php 
                    echo form_error('email','<span class = "error">','</span>',$error) ;
                ?>

                </div>
                <div class="div_input">
                    <input type="date" name="birthday" id="birthday" placeholder="Birthday" class="info_input">

                </div>
                <div class="div_input">
                    <input type="text" name="job" id="job" placeholder="Job" class="info_input">
                </div>
                <div class="div_input">
                    <input type="text" name="gender" id="gender" placeholder="Gender (Male/Female) " class="info_input">
                </div>
                <div class="div_input">
                    <input type="text" name="location" id="location" placeholder="Location" class="info_input">
                </div>
                <div class="div_input">
                     <input type="text" name="hobby" id="hobby" placeholder="Hobby" class="info_input">
                </div>
                <div class="div_input">
                    <input type="submit" name="submit" value="Enter" class="submit info_input"> 
                </div>

            </form>

        </div>
    </div>
</body>

</html>