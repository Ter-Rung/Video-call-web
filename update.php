<?php
    include "connect.php";

    if(isset($_GET["user_id"])){
        $id = $_GET["user_id"];
    }

    if(isset($_POST["sua"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $NAME = $_POST["NAME"];
        $birthday = $_POST["birthday"];
        $job = $_POST["job"];
        $location = $_POST["location"];
        $hobby = $_POST["hobby"];


        if($username != "" && $email != "" && $NAME != "" && $birthday != "" && $job != "" && $location != "" && $hobby != ""){
            $sql = "UPDATE users SET username = '$username', email = '$email', NAME = '$NAME',
            birthday = '$birthday', job = '$job', location = '$location', hobby = '$hobby'
            WHERE user_id = $user_id";
            $qr = mysqli_query($conn, $sql);
            header('location: table.php');
        }
    }

            $sql = "SELECT * FROM users WHERE user_id = $user_id";
            $qr = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_array($qr);
            // header('location: table.php');
?>
<form action="" method="POST">
    <label for="">Username</label> <input type="text" name="username" value="<?php echo $rows['username']; ?>"><br><br>
    <label for="">Email</label> <input type="text" name="email" value="<?php echo $rows['email']; ?>"><br><br>
    <label for="">Name</label> <input type="text" name="NAME" value="<?php echo $rows['NAME']; ?>"><br><br>
    <label for="">Birthday</label> <input type="date" name="birthday" value="<?php echo $rows['birthday']; ?>"><br><br>
    <label for="">Job</label> <input type="text" name="job" value="<?php echo $rows['job']; ?>"><br><br>
    <label for="">Location</label> <input type="text" name="location" value="<?php echo $rows['location']; ?>"><br><br>
    <label for="">Hobby</label> <input type="text" name="hobby" value="<?php echo $rows['hobby']; ?>"><br><br>
    <input type="submit" name="sua" value="sua">
</form>
