<?php
//hàm gán session
function setSession ($key,$value) {
    return $_SESSION[$key] = $value;
}

//hàm đọc session
function getSession ($key ='') {
    // if(empty($_SESSION[$key])) {
    //     return null;
    // }
    // else {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
   // }
}

//hàm xóa session 
function deleteSession ($key ='') {
    if(empty($key)) {
        session_destroy();
        return true;
    }
    else {
        if(isset($_SESSION[$key])) {
           unset($_SESSION[$key]);
            return true;
        }
    }
}

// hàm flashdata
function setFlashData ($key,$value) {
    $key = 'flash_'.$key;
    return setSession($key,$value);
}

function getFlashData ($key) {
    $key = 'flash_'.$key;
    $data = getSession($key);
    deleteSession($key);
    return $data;

}

?>