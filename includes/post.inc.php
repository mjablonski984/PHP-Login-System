<?php 
// if user is logged in (userId is present in the session)
if (isset($_SESSION['userId'])) {
require 'dbh.inc.php';

$userId = $_SESSION['userId'];

if (isset($_GET['id'])) {
    // escape special char in userid (SQLconnection, string )
    $postId = mysqli_real_escape_string($conn,$_GET['id']);
    // select post with given postId if it matches Id of a logged in user
    $sql = "SELECT * FROM posts WHERE idPosts=? AND idUsers=?";
    $stmt = mysqli_stmt_init($conn); // initialize a statement

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ./index.php?error=sqlerror");
        exit(); 
    } else {
    mysqli_stmt_bind_param($stmt,"ss",$postId,$userId); // bind the params to a statment from $sql
    mysqli_stmt_execute($stmt); // execute

    $result = mysqli_stmt_get_result($stmt); // get results
    $post = mysqli_fetch_assoc($result); // store in assoc. array
    mysqli_free_result($result);
    }
     
    mysqli_close($conn);

}


if(isset($_POST['delete'])){
    $delete_id = mysqli_real_escape_string($conn,$_POST['delete_id']);
  
    $sql = "DELETE FROM posts WHERE idPosts=? AND idUsers=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "There was an error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt,"ss",$delete_id,$userId);
        mysqli_stmt_execute($stmt);
        header("Location: ./index.php?deletepost=success");

        mysqli_free_result($result);
    }
        mysqli_close($conn);
 }

} else {
   header('Location: ./index.php');
}
