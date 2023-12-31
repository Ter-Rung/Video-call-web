<?php
    include "connect.php";
    
    $this_id = $_GET['this_id'];

    echo $this_id;
    $sql = " DELETE FROM users WHERE user_id = '$this_id' ";

    mysqLi_query( $conn, $sql );

    header('location: table.php');
?>