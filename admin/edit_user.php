<?php include("includes/header.php"); ?>
<?php if(!$session -> is_signed_in()) {
        redirect('login.php');
      }
?>
<?php
    if(empty($_GET['id'])) {
        redirect('users.php');
    }

    $user = User :: find_id($_GET['id']);
    
    if(isSet($_POST['update'])) {
        if($user) {
            $user -> username = $_POST['username'];
            $user -> first_name = $_POST['first_name'];
            $user -> last_name = $_POST['last_name'];
            $user -> password = $_POST['password'];

            if(empty($_FILES['user_image'])) {
                $user -> save();
                redirect("edit_user.php?id={$user->id}");
            } else {
                $user -> set_image($_FILES['user_image']);
                $user -> save_photo();
                $user -> save();
                redirect("edit_user.php?id={$user->id}");
            }
        }
    }

    if(isSet($_POST['delete'])) {
        $user -> delete();
        redirect("users.php");
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
        <h1 class="page-header">
            Edit User
            <small><?php echo $user -> username; ?></small>
        </h1>
<?php include("includes/photo_library_modal.php"); ?>
    <div class="col-md-6">
        <a href="#" data-toggle="modal" data-target="#photo-library"><img class = "img-responsive" src = "<?php echo $user -> user_picture(); ?>" alt = "user picture"></a>
    </div>

        <form action = "" method = "post" enctype = "multipart/form-data">
            <div class="col-md-6">
                <input type = "file" name = "user_image">
                <div class="form-group">
                    <label for = "username"> Username</label>
                        <input type="text" name = "username" class = "form-control" value = "<?php echo $user -> username; ?>">
                </div>
                <div class="form-group">
                        <label for = "first_name"> First Name</label>
                        <input type="text" name = "first_name" class = "form-control" value = "<?php echo $user -> first_name; ?>">
                </div>
                <div class="form-group">
                        <label for "last_name"> Last Name</label>
                        <input type="text" name = "last_name" class = "form-control" value = "<?php echo $user -> last_name; ?>">
                </div>
                <div class="form-group">
                        <label for "password"> Password</label>
                        <input type="password" name = "password" class = "form-control" value = "<?php echo $user -> password; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name = "update" class = "btn btn-primary" value = "Update">
                </div>
                <div class="form-group">
                    <input type="submit" name = "delete" class = "btn btn-danger" value = "Delete">
                </div>
            </div>
        </form>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>