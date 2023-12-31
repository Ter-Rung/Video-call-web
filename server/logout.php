<?php
require_once('server.php');
if(isLogin()) 
{
    $token = getSession('loginToken');
    delete('logintoken',"loginToken='$token'");
    deleteSession('loginToken');
    redirect('index.php');
}

?>