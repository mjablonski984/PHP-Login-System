<?php 

require 'dbh.inc.php';

// Limit number of posts seen by  users that aren't logged in.
if (isset($_SESSION['userId']))  { 
    $sql = "SELECT * FROM posts ORDER BY createdAtPosts DESC;";
} else {
    $sql = "SELECT * FROM posts ORDER BY createdAtPosts DESC LIMIT 10;";
}
// Get results and fetch as assoc. array 
$result = mysqli_query($conn,$sql);

$allUsersPosts = mysqli_fetch_all($result,MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);
// Close Connection
mysqli_close($conn);
