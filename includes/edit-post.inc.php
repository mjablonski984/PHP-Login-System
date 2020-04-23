<?php 
session_start();

if (isset($_SESSION['userId'])) {
    
    $userId = $_SESSION['userId'];
    
    if(isset($_POST['edit-post'])){
        // requie msqli connection settings
        require 'dbh.inc.php';
        
    $editId = mysqli_real_escape_string($conn,$_POST['edit_id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $body = mysqli_real_escape_string($conn,$_POST['body']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);

    if (empty($_POST['title']) || empty($_POST['body']) || empty($_POST['author'])){
        header("Location: ../edit-post.php?id=$editId&error=emptyfields");
        exit();
        }

        $sql = "UPDATE posts SET titlePosts=?, bodyPosts=?, createdByPosts=? WHERE idPosts =? AND idUsers =?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../edit-post.php?id=$editId&error=sqlerror");
            exit(); 
        } else {
            mysqli_stmt_bind_param($stmt,"sssss",$title,$body,$author,$editId,$userId);
            mysqli_stmt_execute($stmt);
            header('Location: ../index.php?editpost=success');
        }
        mysqli_stmt_close($conn);

    }

}else {
    header('Location: ../index.php');
}