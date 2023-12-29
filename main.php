<?php
    //Kết nối Database
    include "connect.php";

    $sql = "SELECT * FROM  users";

    $result = mysqLi_query( $conn, $sql);

    if( mysqLi_num_rows($result) > 0 ) 
    {
        while ($row = mysqli_fetch_array($result)) 
        {
            echo $row['username'] . " | " . $row['email'] . " | " . $row['NAME'];
            echo '<br>';
        }
    }


    // $sql = " DELETE FROM users WHERE user_id='' ";

    // mysqLi_query( $conn, $sql );

    
?>