<?php 
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0'; // Checkbox value: 1 if checked, 0 if unchecked

    $sql = "UPDATE todos SET status = '$status' WHERE id = $id AND user_id = $_COOKIE[user]";
    $result = mysqli_query($conn, $sql);    
    if ($result) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: todo.php"); // Redirect to the main page after updating
    exit;
    
}
?>