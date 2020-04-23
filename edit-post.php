<?php 
require "header.php";

require "./includes/get-post.inc.php" // load post with id from url
?>

<main class="container card bg-light mt-auto mx-auto p-4">

    <h2 class="text-center my-3">Edit Post</h2>

    <?php if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {echo "<p class=\"text-center text-warning\">Please fill in all fields</p>";} 
            if ($_GET['error'] == "sqlerror") {echo "<p class=\"text-center text-warning\">SQL Error</p>";}     
    } ?>

    <form action="<?php echo './includes/edit-post.inc.php'; ?>" method="POST">
         <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $post['titlePosts'] ;?>" id="title">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="author" value="<?php echo $post['createdByPosts'] ;?>" id="author">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" rows="12" id="body" ><?php echo $post['bodyPosts'] ;?></textarea>
        </div>
        <!-- Hidden input with post id used for update -->
        <input type="hidden" name="edit_id" value="<?php echo $post['idPosts'];?>">
        <input type="submit" name="edit-post" value="Submit" class="btn btn-primary">
    </form>    


</main>

<?php 
require "footer.php";
?>    