<?php
require 'dbh.inc.php';

if (isset($_GET['id'])) {
    $postId = mysqli_real_escape_string($conn,$_GET['id']);
    
    $sql = "SELECT * FROM posts WHERE idPosts=?;";
    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ./index.php?error=sqlerror");
        exit(); 
    } else {
    mysqli_stmt_bind_param($stmt,"s",$postId); 
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    }
     
    mysqli_close($conn);
}else {
    header('Location: ./index.php');
 }