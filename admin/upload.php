<?php include("includes/header.php"); ?>
<?php if(!$session -> is_signed_in()) {
        redirect('login.php');
      }
?>

<?php
$message = '';
if(isSet($_POST['submit'])) {
    $photo = new Photo();
    $photo -> title = $_POST['title'];
    $photo->caption=$_POST['caption'];
    $photo->description=$_POST['description'];
    $photo->alternate_text=$_POST['alt'];
    $photo -> set_file($_FILES['file_upload']);

    if($photo -> save_db()) {
        $message = "Photo uploaded.  Hoozah!" . "<br/>" . $photo -> size;
    } else {
        $message = join("<br/>", $photo -> errors);
    }
}

if(isSet($_FILES['file'])) {
    $photo = new Photo();
    $photo->set_file($_FILES['file']);
    if($photo->save_db()) {
        $message = "Photos uploaded successfully.";
    }
}

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php include("includes/top_nav.php"); ?>


<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>
<!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

<!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Upload
                    <small>Upload a Photo!</small>
                </h1>
                <div class="row">
                    <div class="col-md-6">
                        <p class = "bg-success"><?php echo $message; ?></p>
                        <form action = "upload.php" method = "post" enctype = "multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title </label>
                                <input type="text" name = "title" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="caption">Caption </label>
                                <input type="text" name="caption" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alt">Alternate Text </label>
                                <input type="text" name="alt" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description </label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="file" name = "file_upload">
                            </div>
                            <input type="submit" name = "submit">
                        </form>
                    </div>
                </div> <!-- end of row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="upload.php" class = "dropzone">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- /.row -->

        </div>
<!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>