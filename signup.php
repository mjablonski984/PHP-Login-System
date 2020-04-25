<?php 
require "header.php";
?>

<main class="container mt-auto mx-auto text-center">
    <div class="card card-body col-9 col-md-6 p-3 p-md-4 m-auto bg-light">
    <h3 class="text-primary mb-4">Sign Up</h3>   
    <?php 
    //check for errors in url (passed in param from signup.inc.php)
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {echo "<p class=\"text-center text-warning\">Please fill in all fields</p>";}
            if ($_GET['error'] == "invalidmailuid") {echo "<p class=\"text-center text-warning\">Invalid username and email</p>";}
            if ($_GET['error'] == "invalidmail") {echo "<p class=\"text-center text-warning\">Ivalid email</p>";}
            if ($_GET['error'] == "invaliduid") {echo "<p class=\"text-center text-warning\">Invalid username</p>";}
            if ($_GET['error'] == "passwordcheck") {echo "<p class=\"text-center text-warning\">Passwords do not match</p>";}
            if ($_GET['error'] == "usertaken") {echo "<p class=\"text-center text-warning\">Username is already taken</p>";}
        } elseif (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {echo "<p class=\"text-center text-success\">User successfuly created</p>";}
        }        
    ?>

        <form action="includes/signup.inc.php" method="post">
            <input class="form-control mb-3" type="text" name="uid" placeholder="Username" value="<?php echo htmlspecialchars($_GET['uid'] ?? '');?>">
            <input class="form-control mb-3" type="text" name="mail" placeholder="E-mail" value="<?php echo htmlspecialchars($_GET['mail'] ?? '');?>">
            <input class="form-control mb-3" type="password" name="pwd" placeholder="Password" >
            <input class="form-control mb-3" type="password" name="pwd-repeat" placeholder="Repeat password" >
            <input class="btn btn-primary btn-block mb-3" type="submit" name="signup-submit" placeholder="Signup" >
        </form>
        
        <?php if (isset($_GET['newpwd']) && $_GET['newpwd'] == "pwdupdated") {echo "<p class=\"text-center text-success\">Password updated !</p>";}?>
        <a href="reset-password.php" class="nav-link text-primary">Forgot your password ?</a>
    </div>
</main>

<?php 
require "footer.php";
?>