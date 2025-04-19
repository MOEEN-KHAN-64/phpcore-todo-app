<?php 

// Clear the "user" cookie
setcookie("user", "", time() - 3600, "/");

// Redirect to login page
header("Location: login.php");
exit();

?>