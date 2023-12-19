<?php

//Kiểm tra phương thức Get
function isGet() {
    if($_SERVER['REQUEST_METHOD'] =='GET') {
        return true;
    } else {
        return false;
    }
}

//Kiểm tra phương thức post
function isPost() {
    if($_SERVER['REQUEST_METHOD'] =='POST') {
        return true;
    } else {
        return false;
    }
}

//hàm xử lý dữ liệu input
function filter() {
    $filterArr = [];
    if(isGet()) {
        if(!empty($_GET)) {
            foreach($_GET as $key => $value) {
                $key = strip_tags($key) ;
                if(is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }
                else {
                    $filterArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);

                }
            }
        }
    }

    if(isPost()) {
        if(!empty($_POST)) {
            foreach($_POST as $key => $value) {
                $key = strip_tags($key) ;
                if(is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }
                else {
                    $filterArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);

                }
            }
        }
    }
    return $filterArr;
}

//hàm thông báo
function getMsg ($msg,$type='') {
echo '<div  class ="alert alert-'.$type.'">';
echo ($msg);
//print_r($type);
echo '</div>';
}

//hàm chuyển hướng
function redirect ($path ='index.php') {
    header("Location: $path");
    exit;
}

//hàm thông báo lỗi

function form_error ($fileName, $before_html ='',$after_html ='',$error) {
    return (!empty($error[$fileName])) ? $before_html.reset($error[$fileName]).$after_html : null;

}

//hàm hiển thị dữ liệu cũ
function old ($fileName,$oldData, $default = null) {
    return (!empty($oldData($fileName))) ? $oldData($fileName) : $default;
}

//hàm kiểm tra trạng thái đăng nhập
function isLogin() {
    $checkLogin = false;
if(getSession('loginToken')) {
    $tokenLogin = getSession('loginToken');

    //Kiểm tra với loginToken trong database
    $queryToken = select_user("select username from loginToken where loginToken ='".$tokenLogin."'");

    if(!empty($queryToken)) {
        $checkLogin = true;
    } 
    else {
        deleteSession('loginToken');
    }

}
return $checkLogin;
}



