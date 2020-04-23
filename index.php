<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center px-4 px-md-5">
    <?php if (isset($_SESSION['userId'])) : 
         // get the users uid stored in session   
        $username = ucwords($_SESSION['userUid']);
        require "includes/all-posts.inc.php"; // get user's posts
    ?>  

        <?php if (isset($_GET['login']) && $_GET['login'] === 'success') : ?>
        <h2 class='mt-3 text-success'>Welcome <?php echo $username;?></span></h2>
        <?php else: ?>
        <h2 class='mt-3'>Hello <span class="text-success"><?php echo $username;?></span></h2>
        <?php endif?>
            

        <?php if (isset($_GET['addpost']) && $_GET['addpost'] === 'success'): ?>
            <p class="text-center text-success">Added new post!</p>
        <?php elseif (isset($_GET['deletepost']) && $_GET['deletepost'] === 'success'):?>
            <p class="text-center text-success">Post deleted!</p>    
        <?php elseif (isset($_GET['editpost']) && $_GET['editpost'] === 'success'):?>
            <p class="text-center text-success">Post updated!</p>    
        <?php endif?>
        
        <h2 class="text-center my-3">Posts</h2>
        <?php foreach($posts as $post): ?>
            <div class="card text-center mb-4 p-4 p-md-5">
                <h3><?php echo htmlspecialchars($post['titlePosts']); ?></h3>
                <small>Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</small>
                <p class="text-justify my-4"><?php echo htmlspecialchars(substr(($post['bodyPosts']),0,500)) ;?></p>
                <a href="<?php echo 'http://localhost/tuts/login/';?>post.php?id=<?php echo $post['idPosts'];?>" class="btn btn-dark w-50 mx-auto">Read More</a>
            </div>
        <?php endforeach; ?>

    <?php else: ?>

        <h2 class="text-primary">Hello Guest !</h2>
        <h2 class="text-primary">You are logged out</h2>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'emptyfields'):?>
            <p class="text-center text-danger">To login enter your username and password</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'invalid'):?>
            <p class="text-center text-danger">Invalid  credentials. Please check your username and password</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'sqlerror'):?>
            <p class="text-center text-danger">SQL Error</p>    
        <?php endif ?>
    
    <?php endif ?>
    

</main>

<?php 
require "footer.php";
?>