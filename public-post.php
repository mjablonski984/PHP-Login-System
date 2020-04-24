<?php 
require "header.php";
require 'includes/public-post.inc.php'; 
?>

<main class="container mt-auto mx-auto bg-light p-5">
        <h1 class="text-center mb-2"><?php echo htmlspecialchars($post['titlePosts']); ?></h1>
        <p class="text-center mb-4">Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</p>
        <p class="text-justify"><?php echo htmlspecialchars($post['bodyPosts']);?></p>
        <hr>

        <div class="row display-flex justify-content-center px-4">
            <!-- Back to index-->
            <a href="<?php echo './index.php';?>" class="btn btn-dark text-center ">Back</a>
        </div>
</main>

<?php 
require "footer.php";
?>