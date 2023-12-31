<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Nunito+Sans:ital,opsz,wght@1,6..12,700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: lightblue;
            font-family: 'Comfortaa', sans-serif;
            font-family: 'Nunito Sans', sans-serif;
        }

        table .table .table-striped .border .rounded-3 {
            /* border: 3px solid black  ;  */
            border-radius: 10px;
        }

        .table td:last-child {
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            margin-bottom: 24px;
        }

        .btn-primary a{
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body style="background-color: lightblue; ">
    <main>
        <section class="table__header container p-1 text-center">
            <h1>List User</h1>
        </section>
        <section class="container">
            <button class='btn btn-primary'> <a href="create.php">Thêm tài khoản</a> </button>
            <table class="table table-striped  border rounded-3">
                <thead>
                    <tr>
                        <th> UserName </th>
                        <th> UserID </th>
                        <th> Email </th>
                        <th> Name </th>
                        <th> Birthday </th>
                        <th> Job </th>
                        <th> Location </th>
                        <th> Hobby </th>
                        <th> Create_at </th>
                        <th> Update_at </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Kết nối Database
                    include "connect.php";

                    $sql = "SELECT * FROM  users";

                    $result = mysqLi_query($conn, $sql);

                    if (mysqLi_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            // echo $row['username'] . " | " . $row['email'] . " | " . $row['NAME'];
                            // echo '<br>';
                            echo "<tr>
                                    <td>" . $row["username"] . "</td>
                                    <td>" . $row["user_id"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["NAME"] . "</td>
                                    <td>" . $row["birthday"] . "</td>
                                    <td>" . $row["job"] . "</td>
                                    <td>" . $row["location"] . "</td>
                                    <td>" . $row["hobby"] . "</td>
                                    <td>" . $row["create_at"] . "</td>
                                    <td>" . $row["update_at"] . "</td>
                                    <td> <a href='delete.php?this_id=" . $row["user_id"] . "'> 
                                        <button class='btn btn-danger'> Delete </button>
                                    </a> </td> 
                                    <td>
                                        
                                            <a href='update.php?user_id=<?php echo " . $row["user_id"] . " ?> class='btn btn-success'> 
                                                Sửa 
                                            </a>
                                        
                                    </td>

                                    
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            
        </section>
    </main>
</body>

</html>