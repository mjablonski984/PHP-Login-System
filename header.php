<?php 
    session_start(); // place session in header to start session on every page where it's included
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/sandstone/bootstrap.min.css" rel="stylesheet" integrity="sha384-ABdnjefqVzESm+f9z9hcqx2cvwvDNjfrwfW5Le9138qHCMGlNmWawyn/tt4jR4ba" crossorigin="anonymous">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">PHP Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse text-center" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <?php if (isset($_SESSION['userId'])) : ?>
                    <li class="nav-item"><a href="add-post.php" class="nav-link">Add post</a></li>     
                    <?php endif ?>   
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    </ul>


                <?php if (isset($_SESSION['userId'])) : ?>       
                    <form class="d-flex flex-column flex-md-row justify-content-md-end my-1" action="includes/logout.inc.php" method="post" >
                    <button class="btn btn-primary btn-sm" type="submit" name="logout-submit">Logout</button>
                    </form>

                <?php else : ?>

                <div class="d-flex flex-column flex-md-row justify-content-md-end my-1">              
                    <form  class="d-flex flex-column flex-md-row justify-content-md-around" action="includes/login.inc.php" method="post">
                    <input class="form-control form-control-sm mx-md-1 mb-2 mb-md-0" type="text" name="mailuid" placeholder="Username or email...">
                    <input class="form-control form-control-sm mx-md-1 mb-2 mb-md-0" type="password" name="pwd" placeholder="Password...">
                    <button class="btn btn-primary btn-sm mx-md-1 mb-2 mb-md-0" type="submit" name="login-submit">Login</button>
                    </form>
                    <a href="signup.php" class="btn btn-primary btn-sm mx-md-1 mb-2 mb-md-0">Signup</a>
                </div>
                
                <?php endif ?>

    
            </div>
        </nav>
    </header>