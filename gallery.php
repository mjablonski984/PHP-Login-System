<?php 
require "header.php";
if (!isset($_SESSION['userId'])) {header("Location: ./index.php");}
?>

<main class="container mt-auto mx-auto text-center px-3">
    <h2 class='mt-5 mb-4'>Hello <span class="text-success"><?php echo  ucwords($_SESSION['userUid']);?></span></h2>
    
        <?php if (isset($_GET['upload']) && $_GET['upload'] === 'success'):?>
            <p class="text-center text-success">File uploaded</p>   
        <?php elseif (isset($_GET['deleteimg']) && $_GET['deleteimg'] === 'success'):?>
            <p class="text-center text-success">File deleted</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'emptyfields'):?>
            <p class="text-center text-danger">Image title and description are required</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'filesize'):?>
            <p class="text-center text-danger">Exceeded file size limit</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'file'):?>
            <p class="text-center text-danger">File error. Try again</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'filetype'):?>
            <p class="text-center text-danger">No file selected or invalid file type</p>    
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'sqlerror'):?>
            <p class="text-center text-danger">SQL statement failed</p>    
        <?php endif ?>
    
    <div class="card card-body col-9 col-md-6 p-3 p-md-4 m-auto bg-light">
        <h3 class="text-primary mb-4">Upload image</h3>
        <form action="includes/gallery.inc.php" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control mb-3" name="filename" placeholder="File name" >                
            <input type="text" class="form-control mb-3" name="filetitle" placeholder="Image title" value="<?php echo htmlspecialchars($_GET['filetitle'] ?? '')?>">                
            <input type="text" class="form-control mb-3" name="filedesc" placeholder="Image description" value="<?php echo htmlspecialchars($_GET['filedesc'] ?? '')?>">                
            <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="fileInput">
            <label class="custom-file-label">Choose file</label>
            </div>
            <input type="submit" class="form-control btn-primary mt-3" name="gallery-submit" value="submit">                
        </form>
    </div>

    <h3 class="text-center my-4 text-primary">My Gallery:</h3>
    <div class="card-deck justify-content-around py-3 my-4">

        <?php require_once 'includes/my-gallery.inc.php';
              foreach ($images as $img) : ?>
            <div class="card mx-1 mb-3 col-xs-10 col-sm-9 col-md-5 col-lg-4" style="min-width:13rem;">
                <a href="gallery/<?php echo $img['imgFullNameGallery'];?>" target="blank">
                <img class="card-img-top pt-1" src="gallery/<?php echo $img['imgFullNameGallery'];?>" alt="<?php echo $img['titleGallery'];?>">
                </a> 
                <div class="card-body">
                    <h5 class="card-title"><?php echo $img['titleGallery'];?></h5>
                    <p class="card-text"><?php echo $img['descGallery'];?></p>
                    <p class="card-text"><small class="text-muted">Created on: <?php echo $img['createdAtGallery'];?></small></p>
                    
                    <form action="<?php echo "./includes/gallery.inc.php"; ?>" method="POST" >
                        <input type="hidden" name="gallery-delete-id" value="<?php echo $img['idGallery']; ?>">
                        <input type="submit" name="gallery-delete" value="Delete" class="btn btn-sm btn-outline-danger">
                    </form>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</main>

<script> // script to display file name in Bootstrap style file input
document.querySelector('.custom-file-input').addEventListener('change',function(e){
  let fileName = document.getElementById("fileInput").files[0].name;
  e.target.nextElementSibling.innerText = fileName; 
})
</script>

<?php 
require "footer.php";
?>