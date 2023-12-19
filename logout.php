<?php
require_once('header.php');

if(isLogin()) 
{
    $token = getSession('loginToken');
    delete('logintoken',"loginToken='$token'");
    deleteSession('loginToken');
    redirect('index.php');
}
?>
