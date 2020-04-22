<?php 

if (isset($_POST['reset-request-submit'])) {

    // selector token (will be send to bd) - select user 
    $selector = bin2hex(random_bytes(8));
    // second token - will be used to validate user
    $token = random_bytes(32);

    // Change this url to match a file structure of your website
    $url = "http://localhost/tuts/login/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    // expires in 1 h
    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

    // reset previous existing from the user
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "There was an error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "There was an error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);


    // email setup
    
    $to = $userEmail;

    $subject = 'Reset your password';

    $message = "<p>We received a password reset request. To reset you password click in a link bellow: </p><br />";
    $message .= '<a href="'.$url.'">'.$url.'</a>';

    $headers = "From: admin <admin@adminmail.com>\r\n";
    $headers .= "Reply-To: mjtest84@gmail.com\r\n"; // reply from user will be sent to this address
    $headers .= "Content-type: text/html\r\n"; //add this line to make HTML layout work in the email

    // send email
    mail($to, $subject, $message, $headers);

    //redirect back to reset page with success msg
    header("Location: ../reset-password.php?reset=success");
}else {
    header("Location: ../index.php");
}