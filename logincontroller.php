<?php

    include "db.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);


        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){ 
               setcookie("user",$row['id'], time() + 86400, "/"); // 86400 = 1 day
                header("Location: welcome.php");
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with this email";
        }

        mysqli_close($conn);
    }
        


?>