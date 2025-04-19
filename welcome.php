<?php 
 include "checkcookie.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_COOKIE['user']); ?>!</h1>
    <a href="todo.php">Create Todo</a><br><br>
    <a href="logout.php">Logout</a>
</body>
</html>