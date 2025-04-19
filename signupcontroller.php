<?php 

    include "db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);


        $hashpassword = password_hash($password , PASSWORD_DEFAULT);

        $sql = "insert into users (username,email,password) values ('$name','$email','$hashpassword')";


        if(mysqli_query($conn , $sql)){
            header("Location: login.php");
            exit();
        }
 
        else{
            echo "error: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);

    }

?>