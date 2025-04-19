<?php 
    include "db.php";

    $sql = "SELECT * FROM todos WHERE user_id = $_COOKIE[user]";
    $result = mysqli_query($conn, $sql);
    $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

?>