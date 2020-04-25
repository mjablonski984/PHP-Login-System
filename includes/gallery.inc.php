<?php
session_start();
if (isset($_SESSION['userId']))  { 
    $userId = $_SESSION['userId'];
    
    if(isset($_POST['gallery-submit'])){
        // if user did'n select a filename add default name
        $newFileName = $_POST['filename'];
        if (empty($_POST['filename'])){
            $newFileName = "gallery";
        } else {
            $newFileName = strtolower(str_replace(" ","-",$newFileName)); 
        } 
        
        $imageTitle = $_POST['filetitle'];
        $imageDesc = $_POST['filedesc'];
        
        $file = $_FILES['file'];
        //get the info about uploded file from the superglobal FILES
        $fileName = $file['name']; 
        $fileType = $file['type']; 
        $fileTempName = $file['tmp_name']; 
        $fileError = $file['error']; 
        $fileSize = $file['size'];

        // get the extension
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = ['jpg','jpeg','png'];

        // check for errors: file-type, file-size, internal file errors, and empty title & desc fields
        if (!in_array($fileActualExt,$allowed)) {
            header("Location: ../gallery.php?error=filetype");
            exit();
        } elseif ($fileError !== 0) {
            header("Location: ../gallery.php?error=file");
            exit();
        } elseif ($fileSize > 2000000) {
            header("Location: ../gallery.php?error=filesize");
            exit();
        } elseif (empty($imageTitle) || empty($imageDesc)) {
            header("Location: ../gallery.php?error=emptyfields");
            exit();
        } else {
            
            // create unique full name for image by adding uniqid (true allows more the default 13 chars)
            $imageFullName = $newFileName . "." . uniqid("",true) . "." . $fileActualExt;
                    
            $fileDestination = "../gallery/" . $imageFullName;
            
            include_once "dbh.inc.php";

            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, idUsers) VALUES (?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../gallery.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $imageTitle,$imageDesc,$imageFullName,$userId);
                // upload all information about image to bd 
                mysqli_stmt_execute($stmt);  
                // upload the file to the server
                move_uploaded_file($fileTempName, $fileDestination);
                header("Location: ../gallery.php?upload=success");
                exit();
            }                   
        }
    }


    if(isset($_POST['gallery-delete'])){
        include_once "dbh.inc.php";

        $delete_id = mysqli_real_escape_string($conn,$_POST['gallery-delete-id']);

        $sql = "SELECT imgFullNameGallery FROM gallery WHERE idGallery=? AND idUsers=?;";
        $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../gallery.php?error=sqlerror");
                exit();
        } else {
            mysqli_stmt_bind_param($stmt,"ss",$delete_id,$userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $fileName = mysqli_fetch_assoc($result);
            $filePath = "../gallery/{$fileName['imgFullNameGallery']}";

            $sql = "DELETE FROM gallery WHERE idGallery=? AND idUsers=?";
            $stmt = mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../gallery.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt,"ss",$delete_id,$userId);
                mysqli_stmt_execute($stmt); // delete file data from db
                unlink($filePath); // delete file from its directory

                header("Location: ../gallery.php?deleteimg=success");
        
                mysqli_free_result($result);
            }            
        }
    }

} else {
    header('Location: ../index.php');
}
