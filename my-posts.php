<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center px-4 px-md-5">
    <?php if (isset($_SESSION['userId'])) : 
         // get the users uid stored in session   
        $username = ucwords($_SESSION['userUid']);
        require "includes/my-posts.inc.php"; // get user's posts

    ?>
        
        <h2 class='mt-5'>Hello <span class="text-success"><?php echo $username;?></span></h2>
         
        <h3 class="text-center my-4 text-primary">My Posts:</h3>
        <?php if (isset($_GET['addpost']) && $_GET['addpost'] === 'success'): ?>
            <p class="text-center text-success">Added new post!</p>
        <?php elseif (isset($_GET['deletepost']) && $_GET['deletepost'] === 'success'):?>
            <p class="text-center text-success">Post deleted!</p>    
        <?php elseif (isset($_GET['editpost']) && $_GET['editpost'] === 'success'):?>
            <p class="text-center text-success">Post updated!</p>    
        <?php endif?>

        <?php foreach($posts as $post): ?>
            <div class="card text-center mb-4 p-4 p-md-5">
                <h3><?php echo htmlspecialchars($post['titlePosts']); ?></h3>
                <small>Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</small>
                <p class="text-justify my-4"><?php echo htmlspecialchars(substr(($post['bodyPosts']),0,500)) ;?></p>
                <a href="<?php echo "./post.php?id={$post['idPosts']}";?>" class="btn btn-dark w-50 mx-auto">Read More</a>
            </div>
        <?php endforeach; ?>

    <?php else:
            header("Location: ./index.php");
            exit(); ?>
    <?php endif ?>

</main>

<?php 
require "footer.php";
?>