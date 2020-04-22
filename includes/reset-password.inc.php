<?php 

    if (isset($_POST['reset-password-submit'])) {
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["pwd-repeat"];

        if (empty($password) || empty($passwordRepeat)) {
            header("Location: ../reset-password.php?newpwd=empty");
            exit();
        } elseif ($password !== $passwordRepeat) {
            header("Location: ../reset-password.php?newpwd=pwdnotmatch");
            exit();
        }

        $currentDate = date("U");

        require "dbh.inc.php";

        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "There was an error";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            // if no rows with matching selector token in db...
            if (!$row = mysqli_fetch_assoc($result)){
                echo "You need to re-submit your request";
                exit();
            } else {
                
                $tokenBin = hex2bin($validator);
                // compared validator converted to binary with with the validator fetched from db
                $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
            
                if ($tokenCheck == false) {
                    echo "You need to re-submit your request";
                    exit();
                } elseif ($tokenCheck == true) {
                    $tokenEmail = $row['pwdResetEmail'];
                    // prepare statment
                    $sql = "SELECT * FROM users WHERE emailUsers=?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "There was an error";
                        exit();
                    } else {
                        // if user with given email exists in db..
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (!$row = mysqli_fetch_assoc($result)){
                        echo "There was an error";
                        exit();
                        } else {
                        // prepeare statement to update users password
                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?;"; 
                        $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                echo "There was an error";
                                exit();
                            } else {
                                // hash new password 
                                $newPwdhash = password_hash($password, PASSWORD_DEFAULT);
                                // update password($newPwdhash) of a user with matching email($tokenEmail) 
                                mysqli_stmt_bind_param($stmt, "ss", $newPwdhash, $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                
                                // delete users tokens
                                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt,$sql)) {
                                    echo "There was an error";
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    header("Location: ../signup.php?newpwd=pwdupdated");
                                }
                            }    

                        }
                    }
                }

            }
        }
    

    } else {
        header("Location: ../index.php");
    }

?>