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
                    <span class = "span_gender">Gender:</span>
                    <div class="div_gender">
                        <input type="radio" name="gender" id="male" value ="Male" class="gender_input">
                        <label class ="label_gender" for="male">Male</label>
                    </div>
                    <div class="div_gender">
                        <input type="radio" name="gender" id="female" value ="Female" class="gender_input">
                        <label class ="label_gender" for="female">Female</label>
                    </div>
                </div>
                <div class="div_input">
                <label for="job" class = "label_input">Select Job:</label>
                <select name="job" class ="info_input select_input" id="job" >
                    <option value="Nghiên cứu">Nghiên cứu</option>
                    <option value="Kinh doanh">Kinh doanh</option>
                    <option value="Văn phòng">Văn phòng</option>
                    <option value="Sáng tạo">Sáng tạo</option>
                </select>
                </div>
                <div class="div_input">
                <label for="location" class = "label_input">Select Location:</label>
                <select name="location" class ="info_input select_input" id="location" value = "<?php echo $location ?>" >
                    <option value="HCM">HCM</option>
                    <option value="HN">HN</option>
                    <option value="DN">DN</option>
                    <option value="CT">CT</option>
                </select>
                </div>
                <div class="div_input">
                     <span class = "span_gender span_hobby">Hobby:</span>
                     <div class="div_checkbox">
                        <input type="checkbox" name="hobby[]" id="bongda" class="checkbox_input" value ="Bóng đá" >
                        <label for="bongda" class= "label_checkbox">Bóng đá</label>
                     </div>
                     <div class="div_checkbox">
                        <input type="checkbox" name="hobby[]" id="bongro" class="checkbox_input" value ="Bóng rổ" >
                        <label for="bongro" class= "label_checkbox">Bóng rổ</label>
                     </div>
                     <div class="div_checkbox">
                        <input type="checkbox" name="hobby[]" id="bongchuyen" class="checkbox_input" value ="Bóng chuyền" >
                        <label for="bongchuyen" class= "label_checkbox">Bóng chuyền</label>
                     </div>
                     <div class="div_checkbox">
                        <input type="checkbox" name="hobby[]" id="caulong" class="checkbox_input" value ="Cầu lông" >
                        <label for="caulong" class= "label_checkbox">Cầu lông</label>
                     </div>
                     <div class="div_checkbox">
                        <input type="checkbox" name="hobby[]" id="boiloi" class="checkbox_input" value ="Bơi lội" >
                        <label for="boiloi" class= "label_checkbox">Bơi lội</label>
                     </div>

                </div>
                <div class="div_input">
                    <input type="submit" name="submit" value="Enter" class="submit info_input"> 
                </div>

            </form>

        </div>
    </div>
</body>

</html>