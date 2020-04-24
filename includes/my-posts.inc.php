<?php 
if (isset($_SESSION['userId']))  {

require 'dbh.inc.php';
$userId = $_SESSION['userId'];

$sql = "SELECT * FROM posts WHERE idUsers = $userId ORDER BY createdAtPosts DESC";
// get results and fetch as assc arr. 
$result = mysqli_query($conn,$sql);

$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

mysqli_close($conn);

} else {
header('Location: ../index.php');
}
