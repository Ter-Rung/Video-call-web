<?php
    include "connect.php";



    if(isset($_POST["Them"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $NAME = $_POST["NAME"];
        $birthday = $_POST["birthday"];
        $job = $_POST["job"];
        $location = $_POST["location"];
        $hobby = $_POST["hobby"];


        if($username != "" && $email != "" && $NAME != "" && $birthday != "" && $job != "" && $location != "" && $hobby != ""){
            $sql = "INSERT INTO users(username, email, NAME, birthday, job, location, hobby,)
                    VALUES ('$username', '$email', '$NAME', '$birthday', '$job', '$location', '$hobby')";
            $qr = mysqli_query($conn, $sql);
            header('location: table.php');
        }
    }
?>
<form action="" method="POST">
    <label for="">Username</label> <input type="text" name="username"><br><br>
    <label for="">Email</label> <input type="text" name="email"><br><br>
    <label for="">Name</label> <input type="text" name="NAME"><br><br>
    <label for="">Birthday</label> <input type="date" name="birthday"><br><br>
    <label for="">Job</label> <input type="text" name="job"><br><br>
    <label for="">Location</label> <input type="text" name="location"><br><br>
    <label for="">Hobby</label> <input type="text" name="hobby"><br><br>
    <input type="submit" name="Them" value="Them">
</form>
