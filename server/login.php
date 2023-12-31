<?php
require_once('server.php');


//Kiểm tra trạng thái đăng nhập


{
    if(isPost()) {
        $filterAll = filter();
        $result = [
            'message' => "",
            'success' => false
        ];
        if(!empty($filterAll['username']) && !empty($filterAll['password'])) {
            //xử lý
            $username = $filterAll['username'];
            $password = $filterAll['password'];
            //Lấy thông tin user
            $sql = 'select password from users where username ="'.$username.'"';
            $kq = select_user($sql);
            if(!empty($kq)) {
                $password_user = $kq['password'];
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
                            $result = [
                                'message' => "Đăng nhập thành công",
                                'success' => true,
                                'token' => $tokenLogin
                            ];
                            
                            
                        } 
                        else 
                        {
                            $result['message'] = "Đăng nhập thất bại";
                            
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
                        $result = [
                            'message' => "Đăng nhập thành công",
                            'success' => true,
                            'token' => $tokenLogin
                        ];
                        
                        
                    } else {
                        $result['message'] = "Không thể đăng nhập";
                        
                    }
                    }

                } 
                else {
                    $result['message'] = "Password không đúng";
                    
                }
            } 
            else {
                $result['message'] = "User không tồn tại hoặc đã bị ban";
                
                
            }
        } 
        else {
            $result['message'] = "Vui lòng kiểm tra lại username/password";
            
        }
        echo(json_encode($result));
        
    }
}


?>

