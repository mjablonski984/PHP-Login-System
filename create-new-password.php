<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center">
    <div class="card card-body col-9 col-md-6 p-3 p-md-4 m-auto bg-light">

        <?php 
            //get the tokens from url
            $selector = $_GET["selector"] ?? '';
            $validator = $_GET["validator"] ?? '';
            
            if (empty($selector) || empty($validator)) {
                echo '<p class="text-danger">The request could not be validated</p>';
            } else {
                // check if received tokens has proper hexadecimal format
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
        ?>
            <form action="includes/reset-password.inc.php" method="post">
                <h2 class="text-primary mb-4">Create new password</h2>
                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                <input type="hidden" name="validator" value="<?php echo $validator; ?>">

                <input class="form-control mb-3" type="password" name="pwd" placeholder="Enter a new password" >
                <input class="form-control mb-3" type="password" name="pwd-repeat" placeholder="Confirm a new password" >
                
                <input class="btn btn-primary btn-block mb-3" type="submit" name="reset-password-submit" placeholder="Reset password" >
            </form>
        
        
        <?php
                } else {
                    echo '<p class="text-danger">Invalid tokens</p>';
                    echo '<a href="reset-password.php" class="btn btn-primary btn-sm">Reset your password</a>' ;
                }
            }
        ?>
    </div>
</main>

<?php 
require "footer.php";
?>
