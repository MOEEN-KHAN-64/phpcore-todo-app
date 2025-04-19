<?php
// Check if the "user" cookie is set
if (!isset($_COOKIE['user'])) {
    // Redirect to login page if the cookie is not set
    header("Location: login.php");
    exit();
}
?>