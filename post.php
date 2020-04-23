<?php 
require "header.php";
require 'includes/post.inc.php'; // require after header !(start session in header)
?>

<main class="container mt-auto mx-auto">
    <!-- <div> -->
        <a href="<?php echo './index.php';?>" class="btn btn-primary my-3">Back</a>
        <h1><?php echo htmlspecialchars($post['titlePosts']); ?></h1>
        <small>Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</small>
        <p><?php echo htmlspecialchars($post['bodyPosts']);?></p>
        <hr>
        <!-- Delete -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="float-right">
            <input type="hidden" name="delete_id" value="<?php echo $post['idPosts']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </form>
        <!-- Edit -->
        <a href="<?php echo './edit-post.php?id='.$post["idPosts"]; ?>" class="btn btn-primary">
        Edit Post</a>
    <!-- </div> -->
</main>

<?php 
require "footer.php";
?>
