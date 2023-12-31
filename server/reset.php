<?php 
require_once('server.php');



if(empty(getSession('forgotToken')) && !isLogin()){
    //chuyển hướng về trang forgot
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
            // setFlashData('msg','Vui lòng nhập password mới');
            // setFlashData('msg_type','danger');
            // redirect('reset.php');
            //hiện thông báo nhập password mới sau đó chuyển reset lại trang
        } 
        else 
        {
            if(strlen($filterAll['password']) <8 )
            {
                // setFlashData('msg','Vui lòng nhập password có lớn hơn hoặc bằng 8 kí tự');
                // setFlashData('msg_type','danger');
                // redirect('reset.php');
                //thông báo bắt buộc nhập password lớn hơn 8 kí tự
            }


        }

        //validate re-password: bắt buộc phải nhập, phải giống password
        if(empty($filterAll['re-password'])) 
        {
            // setFlashData('msg','Vui lòng nhập lại password mới');
            // setFlashData('msg_type','danger');
            // redirect('reset.php');
        }
        else
        {   
       
            if($filterAll['re-password'] != $filterAll['password'])
            {   
                // setFlashData('msg','Nhập lại password không đúng');
                // setFlashData('msg_type','danger');
                // //redirect('reset.php');
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
                        // deleteSession('forgotToken');
                        // redirect('login.php');
                        //update thành công xóa session forgotToken
                    } 
                    if(isLogin()){
                        // redirect('index.php');
                        // Đối với người dùng đã đăng nhập thì về trang dashboard
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