<?php 
session_start();

if (isset($_SESSION['userId'])) {
if(isset($_POST['add-post'])){
    
    if (empty($_POST['title']) || empty($_POST['body']) || empty($_POST['author'])){
        header("Location: ../add-post.php?title={$_POST['title']}&body={$_POST['body']}&author={$_POST['author']}&error=emptyfields");
        exit();
    }

    require 'dbh.inc.php';

    $userId = mysqli_real_escape_string($conn,$_SESSION['userId']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $body = mysqli_real_escape_string($conn,$_POST['body']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    
    $sql = "INSERT INTO posts (titlePosts, bodyPosts, createdByPosts, idUsers) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../add-post.php?error=sqlerror");
        exit(); 
    } else {
        mysqli_stmt_bind_param($stmt,"ssss",$title,$body,$author,$userId);
        mysqli_stmt_execute($stmt);
        header('Location: ../my-posts.php?addpost=success');
    }
    mysqli_stmt_close($conn);

 }

}else {
    header('Location: ../index.php');
}