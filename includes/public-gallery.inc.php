<?php
require 'dbh.inc.php';

// Limit number of posts seen by  users that aren't logged in.
if (isset($_SESSION['userId']))  {
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM gallery ORDER BY createdAtGallery DESC;";
} else {
    $sql = "SELECT * FROM gallery ORDER BY createdAtGallery DESC LIMIT 5;";
}

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ./index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $images = mysqli_fetch_all($result,MYSQLI_ASSOC);

        mysqli_free_result($result);
        mysqli_close($conn);
    }