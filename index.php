<?php 
require "header.php";
require "includes/public-posts.inc.php"; // get all posts
?>

<main class="container mt-auto mx-auto text-center px-4 px-md-5">

    <?php if (isset($_SESSION['userId'])) : 
         // get the users uid stored in session   
        $username = ucwords($_SESSION['userUid']);
    ?>  

        <?php if (isset($_GET['login']) && $_GET['login'] === 'success') : ?>
        <h2 class='mt-5 text-success'>Welcome <?php echo $username;?></span></h2>
        <?php else: ?>
        <h2 class='mt-5'>Hello <span class="text-success"><?php echo $username;?></span></h2>
        <?php endif?>
                    
        <div class="px-4 px-md-5 mt-5 mb-2"><a href="my-posts.php" class="btn btn-primary w-50">Go To My Posts</a></div>   
        <div class="px-4 px-md-5 mb-5"><a href="gallery.php" class="btn btn-secondary w-50">Go To My Gallery</a></div>   
 
    <?php else: ?>

        <h2 class="text-primary mt-5">Hello Guest</h2>
        
        <?php if (isset($_GET['error']) && $_GET['error'] === 'emptyfields'):?>
            <p class="text-center text-danger">To login enter your username and password</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'invalid'):?>
            <p class="text-center text-danger">Invalid  credentials. Please check your username and password</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'nouser'):?>
            <p class="text-center text-danger">Invalid  credentials. Please check your username and password</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'sqlerror'):?>
            <p class="text-center text-danger">SQL Error</p>    
        <?php endif ?>

    <?php endif ?>


        <h3 class="text-center my-4 text-primary">New Posts Created By Our Users:</h3>

        <?php foreach($allUsersPosts as $post): ?>
            <div class="card text-center mb-4 p-4 p-md-5">
                <h3><?php echo htmlspecialchars($post['titlePosts']); ?></h3>
                <small>Created on <?php echo $post['createdAtPosts']?> by <?php echo htmlspecialchars($post['createdByPosts']); ?>.</small>
                <p class="text-justify my-4"><?php echo htmlspecialchars(substr(($post['bodyPosts']),0,500)) ;?></p>
                <a href="<?php echo "./public-post.php?id={$post['idPosts']}";?>" class="btn btn-dark w-50 mx-auto">Read More</a>
            </div>
        <?php endforeach; ?>

        <h3 class="text-center my-4 text-primary">New Images Added By Our User:</h3>
        <div class="card-deck justify-content-around py-3">
        <?php 
            require_once 'includes/public-gallery.inc.php';
            foreach ($images as $img) : ?>
            <div class="card mx-1 mb-3 col-xs-10 col-sm-9 col-md-5 col-lg-4" style="min-width:13rem;">
            <a href="gallery/<?php echo $img['imgFullNameGallery'];?>" target="blank" >
            <img class="card-img-top pt-1" src="gallery/<?php echo $img['imgFullNameGallery'];?>" alt="<?php echo $img['titleGallery'];?>">
            </a> 
            <div class="card-body">
                <h5 class="card-title"><?php echo $img['titleGallery'];?></h5>
                <p class="card-text"><?php echo $img['descGallery'];?></p>
                <p class="card-text"><small class="text-muted">Created on: <?php echo $img['createdAtGallery'];?></small></p>
            </div>
            </div>
        <?php endforeach ?>
    </div>

        
        <?php if (!isset($_SESSION['userId'])) {echo '<h3 class="text-primary mb-5">Log in to see more</h3>';} ?>
          
</main>

<?php require "footer.php"; ?>