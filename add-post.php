<?php 
require "header.php";
//redirect to index.php if user isn't logged in
if (!isset($_SESSION['userId'])) {header('Location: ./index.php');}
?>

<main class="container card bg-light mt-auto mx-auto p-4">

    <h2 class="text-center my-2">Add Post</h2>

    <?php if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {echo "<p class=\"text-center text-warning\">Please fill in all fields</p>";} 
            if ($_GET['error'] == "sqlerror") {echo "<p class=\"text-center text-warning\">SQL Error</p>";}     
    } ?>

    <form action="<?php echo './includes/add-post.inc.php' ?>" method="POST">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author">
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control" id="body" rows="12"></textarea>
    </div>
    <input type="submit" name="add-post" value="Submit" class="btn btn-primary">
    </form>

</main>

<?php 
require "footer.php";
?>