<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center">
    <div class="card card-body col-9 col-md-6 p-3 p-md-4 m-auto bg-light">
  
        <h2 class="text-primary mb-4">Reset password</h2>
        <p>An e-mail will be send to you with instruction how to reset a password</p>
        <form action="includes/reset-request.inc.php" method="post">
            <input class="form-control mb-3" type="text" name="email" placeholder="Enter your e-mail address" >
            <input class="btn btn-primary btn-block mb-3" type="submit" name="reset-request-submit" placeholder="Get new password" >
        </form>
        <?php 
            if (isset($_GET["reset"])) {
                if ($_GET["reset"] == "success") {
                    echo '<p class="text-success">Check your e-mail</p>';
                }
            }
        ?>
    </div>
</main>

<?php 
require "footer.php";
?>

