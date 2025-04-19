<?php 
    include "db.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);

        $sql = "INSERT INTO todos (title, description , user_id) VALUES ('$title', '$description','$_COOKIE[user]')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        mysqli_close($conn);
        header("Location: todo.php"); // Redirect to the main page after creating a todo
        exit();

    }

?>