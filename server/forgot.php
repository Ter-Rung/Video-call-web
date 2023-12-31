<?php
require_once('server.php');
if(isPost()) {
    $filterAll = filter();
    $error = [];
    if(empty($filterAll['username']))
    {
        $error['require'] = 'Vui lòng nhập username';
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
                    //redirect('reset.php');    
                    //chuyển hướng đến trang reset password             
                }

            } else 
            {
                //thông báo email không đúng
            }
        }
        else 
        {
            //thông báo không tìm thấy user
        }
        
    }
}




?>