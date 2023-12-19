<?php
    require_once('header.php');
if(isLogin()) 
{
    $token = getSession('loginToken');
    $sql = "select username from logintoken where loginToken ='$token'; ";
    $kq = select_user($sql);
    $username = $kq['username'];
    $sql1 = "select name,email,birthday,job,location,hobby,src_avt,gender from users where username = '$username';";
    $kq1 = select_user($sql1);
    extract($kq1);
    setFlashData('username',$username);
}

else {
    redirect('login.php');
}

$username = getFlashData('username');

if(isPost()) 
{
    
    $filterAll = filter();
    $error = []; //mảng chứa các lỗi

    //validate name: bắt buộc phải nhập tên
    if(empty($filterAll['name'])) {
        $error['name']['require'] = 'Bắt buộc nhập tên ';
    }

    //validate email: bắt buộc nhập email, không được trùng email
    if(empty($filterAll['email'])) {
        $error['email']['require'] = 'Bắt buộc nhập email';
    } else {
        $email = $filterAll['email'];
        $sql = 'Select username from users where email = "'.$email.'"';
        $kq= select_user($sql);
        if($kq) {
            if($kq['username'] != $username ) {
                $error['email']['unique'] ='Email đã tồn tại, vui lòng nhập email khác';
            } 
        }

    }

    // Xử lý avt
    $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];        
        $file_name = $_FILES['avt']['name'];
        if(!empty($file_name)) {
            //print_r($_FILES);
            $file_size = $_FILES['avt']['size'];
            $file_tmp_name = $_FILES['avt']['tmp_name'];  
            $generated_file_name = 'avt-'.$username;          
            $destination_path = "uploads/${generated_file_name}";
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));
            if(in_array($file_extension, $permitted_extensions)) {
                if($file_size <= 1000000) {
                    //ok, move from temp folder to /uploads
                    //original file name and uploaded file name 
                    move_uploaded_file($file_tmp_name, $destination_path);
                    
                } else {
                    $error['avt']['size'] ='Ảnh có kích thước quá lớn';                  
                }
            } else {
                $error['avt']['type'] ='Vui lòng chọn file có đuôi (.png,.jpg,...)';                  
                
            }
        } 
    if(empty($error)) {
        //xử lý update
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if(!empty($file_name)) {
            $data = [
                'update_at' => date('Y-m-d H:i:s'),
                'src_avt' => $destination_path
            ];
        }else
        {
            $data = [
                'update_at' => date('Y-m-d H:i:s'),
                
            ];
        }
       
        foreach ($filterAll as $key => $value) {
            if($key == 'submit') {
                continue;
            }
            $data[$key] =$value;
           }
           //print_r($data);
           $condition = "username = '$username'; ";
          $kq = update('users',$data,$condition);
          if($kq) {
            setFlashData('msg','Update thành công <br>');
            setFlashData('msg_type','success');
            redirect('edit.php');
          }


    } else {
        setFlashData('msg','Vui lòng kiểm tra dữ liệu');
        setFlashData('msg_type','danger');
        setFlashData('error',$error);
       // redirect('edit.php');

    }

}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$error = getFlashData('error');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="asset/edit.css">
    <link rel="stylesheet" href="asset/themify-icons/themify-icons.css">
</head>

<body>
    <div class="container">
        <div class="register">
            <a href="account.php" class ="ti-arrow-left"></a>
            <p class="register_1">Setting User</p>
        </div>
        <div class="line"></div>
        
        <div class="form">
            <form action="#" class="form-data" method ="post" enctype ="multipart/form-data">
            <?php 
                if(!empty($msg)) {
                    getMsg($msg,$msg_type);
                }
            ?>  
                <div class= "avt">
                    <img class ="avatar" src="<?php echo $src_avt; ?>" >
                    <input type="file" name="avt" id="avt" class ="avt_input">
                    <?php 
                    echo form_error('avt','<span class = "error_avt">','</span>',$error) ;
                ?>
                </div>
               
                
                <div class="div_input">
                    <input type="text" name="name" id="name" placeholder="Name" class="info_input" value = "<?php echo $name ?>">
                    <?php 
                    echo form_error('name','<span class = "error">','</span>',$error) ;
                ?>

                </div>
                <div class="div_input">
                    <input type="email" name="email" id="email" placeholder="Email" class="info_input" value = "<?php echo $email ?>"> 
                    <?php 
                    echo form_error('email','<span class = "error">','</span>',$error) ;
                ?>

                </div>
                <div class="div_input">
                    <input type="date" name="birthday" id="birthday" placeholder="Birthday" class="info_input" value = "<?php echo $birthday ?>">

                </div>
                <div class="div_input">
                    <input type="text" name="job" id="job" placeholder="Job" class="info_input" value = "<?php echo $job ?>">
                </div>
                <div class="div_input">
                    <input type="text" name="gender" id="gender" placeholder="Gender(Female/Male)" class="info_input" value = "<?php echo $gender ?>">

                </div>
                <div class="div_input">
                    <input type="text" name="location" id="location" placeholder="Location" class="info_input" value = "<?php echo $location ?>">
                </div>
                <div class="div_input">
                     <input type="text" name="hobby" id="hobby" placeholder="Hobby" class="info_input" value = "<?php echo $hobby ?>">
                </div>
                <div class="div_input">
                    <input type="submit" name="submit" value="Enter" class="submit info_input"> 
                </div>

            </form>

        </div>
    </div>
</body>

</html>