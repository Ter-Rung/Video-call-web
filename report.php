<?php 
require_once('header.php');

// if(!isLogin()) {
//     redirect('login.php');
// }

if(isPost()) {
    $filterAll = filter();
    $lydo = [];
    $error = [];
    if(!empty($filterAll['other'])) 
    {
        if(empty($filterAll['report_other'])) {
            $error['report_other']['require'] = 'Vui lòng nhập lí do';
        }
    }

    if(empty($error))
    {
        foreach($filterAll as $key => $value) {
            if(empty($value) || $key == 'submit_report' || $key == 'other' ){
                continue;
            }
            $lydo[$key] = $value;    
        }

        //tiến hành tăng biến count và kiểm tra xem đủ lần bị rp chưa 

        //khi match 2 user sẽ có 2 username
        //lấy username của user bị ban ta có username
        //gán username vào $username;
        //$username = ??? ;
        //lấy trường count từ user đó sau đó tăng count lên 1
        //$sql = "select count from users where username = '$username';"
        //$kq = select_user($sql);
        //kết quả $kq trả về sau khi select là 1 mảng có key là count 
        // $count = $kq['count'];
        //$count = $count +1;
        //kiểm tra xem nếu $count >= 3 thì ta sẽ delete user khỏi bản users và thêm vào bảng ban
        //if($count >= 3) 
        // {
        //      $condition = "username = $username";
        //      delete('users',$condition);
        // thêm vào bảng ban
        //  $dataBan = [
        //    'username' => $username,
        //    'create_at' =>msg date('Y-m-d H:i:s')
        //];
        //  $kq = insert('users',$dataBan);
        //  thông báo nếu rp thành công
        //  if($kq) {
        //  setFlashData('msg','Báo cáo thành công');
        //  setFlashData('msg_type', 'success');
        //}
        // } 
    }


    
setFlashData('error',$error);

}
//$msg = getFlashData('msg');
//$msg_type = getFlashData('msg_type');
$error =getFlashData('error');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="asset/report.css">
    <link rel="stylesheet" href="asset/font/themify-icons/themify-icons.css">
</head>

<body>
    <div class="report">
        <div class="report1">Report</div>
        <div class="report_line"></div>
        <div class="report_form" >
        <form action="#" method="post" >
        <?php 
            //    if(!empty($msg)) {
            //        getMsg($msg,$msg_type);
            //    }
        ?> 
            <div class="div_report">
            <label class="report_label" for="noidung18">Nội dung 18+ </label><br>
            <input type="checkbox" name="noidung18" id="noidung18" value="Nội dung 18+" class="report_input">
            </div>
            <div class="div_report">
            <label for="noituc" class="report_label">Lời nói thô tục</label><br>
            <input type="checkbox" name="noituc" id="noituc" value="Lời nói thô tục" class="report_input">
            </div>
            <div class="div_report">
            <label for="other" class="report_label">Khác:</label>
            <input type="checkbox" name="other" id="other" value="Khác" class="report_input">
            <input type="textarea" class="report_other" name="report_other" placeholder="">
            <?php 
                    echo form_error('report_other','<span class = "error">','</span>',$error) ;
                ?>
            </div>
            <input type="submit" name = 'submit_report' class="report_submit" value="Enter">
        </form>
        </div>
      
    </div>
</body>

</html>