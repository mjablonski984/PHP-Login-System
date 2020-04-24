<?php 
require "header.php";
require 'includes/post.inc.php'; // require after header !(start session in header)
?>

<main class="container mt-auto mx-auto bg-light p-5">
        <h1 class="text-center mb-2"><?php echo htmlspecialchars($post['titlePosts']); ?></h1>
        <p class="text-center mb-4">Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</p>
        <p class="text-justify"><?php echo htmlspecialchars($post['bodyPosts']);?></p>
        <hr>

        <div class="row display-flex justify-content-between px-4">
            <!-- Back to index-->
            <a href="<?php echo './my-posts.php';?>" class="btn btn-dark text-center ">Back</a>
            <!-- Edit -->
            <a href="<?php echo './edit-post.php?id='.$post["idPosts"]; ?>" class="btn btn-primary">
            Edit Post</a>
            <!-- Delete -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                <input type="hidden" name="delete_id" value="<?php echo $post['idPosts']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        </div>
</main>

<?php 
require "footer.php";
?>
