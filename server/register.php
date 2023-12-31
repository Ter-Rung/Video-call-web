<?php
require_once('server.php');

if(isPost()) {
     $filterAll = filter();
     $error = []; //mảng chứa các lỗi
     $result = [
        'message'=> "",
        'success'=> false
     ];
    

    //validate username: bắt buộc phải nhập, không được trùng tk có sẵn
        if(empty($filterAll['username'])) 
        {
        $error['username']['require'] = 'Bắt buộc nhập username';
        $result['message'] = 'Bắt buộc nhập username ';
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
        $result['message'] .= 'Username đã tồn tại';

            } else 
                if($kq1) 
                {
                    $error['username']['report'] = 'Username đã bị ban khỏi hệ thống vui lòng đặt username khác';
        $result['message'] .= 'Username đã bị ban khỏi hệ thống vui lòng đặt username khác';

                }

        }

    //validate password: bắt buộc phải nhập, lớn hơn 8 kí tự
    if(empty($filterAll['password'])) {
        $error['password']['require'] = 'Bắt buộc nhập password';
        $result['message']= 'Bắt buộc nhập password';

    } else {
        if (strlen($filterAll['password']) <8 ) {
        $error['password']['min'] = 'Password phải lớn hơn hoặc bằng 8 kí tự';
        $result['message'] = 'Password phải lớn hơn hoặc bằng 8 kí tự';
        }
    }

    //validate re_password: bắt buộc phải nhập và giống password
    if(empty($filterAll['re-password'])) {
        $error['re-password']['require'] = 'Bắt buộc nhập lại password';
        $result['message'] = 'Bắt buộc nhập lại password';

    } else {
        if ($filterAll['re-password'] != $filterAll['password'] ) {
        $error['re-password']['match'] = 'Mật khẩu bạn nhập lại không đúng';
        $result['message'] = 'Mật khẩu bạn nhập lại không đúng';


        }
    }

    //validate name: bắt buộc phải nhập tên
    if(empty($filterAll['name'])) {
        $error['name']['require'] = 'Bắt buộc nhập tên ';
        $result['message'] = 'Bắt buộc nhập tên';

    }

    //validate email: bắt buộc nhập email, không được trùng email
    if(empty($filterAll['email'])) {
        $error['email']['require'] = 'Bắt buộc nhập email';
        $result['message']= 'Bắt buộc nhập email';

    } else {
        $email = $filterAll['email'];
        $sql = 'Select email from users where email = "'.$email.'"';
        $kq= select_user($sql);
        if($kq) {
            $error['email']['unique'] ='Email đã tồn tại';
        $result['message']= 'Email đã tồn tại';

        } 
    }
    if(isset($filterAll['hobby']) && is_array($filterAll['hobby'])) {
        $filterAll['hobby'] = implode(",",$filterAll['hobby']);
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
            $result['message'] = 'Đăng kí thành công';
            $result['success'] = true;
            
          }


    } 

    echo(json_encode($result));


 }

?>  
