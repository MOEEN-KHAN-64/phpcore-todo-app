<?php 

    include "db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];

        $sql = "DELETE FROM todos WHERE id=$id";

        if(mysqli_query($conn, $sql)){
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);  
        header("Location: todo.php");
        exit(); 
    }

?>