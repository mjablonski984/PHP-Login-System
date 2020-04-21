<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center">
    <?php 
        if (isset($_SESSION['userId']))        
        echo "<h2 class=\"text-success\">You are logged in!</h2>";
        else {
        echo "<h2 class=\"text-primary\">You are logged out!</h2>";
        }

    ?>
</main>

<?php 
require "footer.php";
?>