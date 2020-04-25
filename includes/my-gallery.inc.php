<?php

if (isset($_SESSION['userId']))  {
    $userId = $_SESSION['userId'];

    require 'dbh.inc.php';

    $sql = "SELECT * FROM gallery WHERE idUsers=$userId ORDER BY createdAtGallery DESC;";
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
} else {
    header('Location: ./index.php');
}
    