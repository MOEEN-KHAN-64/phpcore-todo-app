<?php 
    include "db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $id = $_POST["id"];

        $sql = "UPDATE todos SET title='$title', description='$description' WHERE id=$id";

        if(mysqli_query($conn, $sql)){
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: todo.php");
        exit();
    }

?>