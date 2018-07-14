<?php include("includes/header.php"); ?>
<?php if(!$session -> is_signed_in()) {
        redirect('login.php');
      }
?>
<?php

if(empty($_GET['photo_id'])) {
    redirect("photos.php");
}
$count = Comment::count_comments($_GET['photo_id']);
$comments = Comment::find_comments($_GET['photo_id']);

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
            Comments for Photo
            <small><?php echo $count; ?></small>
            </h1>
            <p class = "bg-success"><?php echo $session->message; ?></p>
        <div class="col-md-12">
            <table class = "table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Body</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                forEach($comments as $comment) : 
                ?>
                    <tr>
                        <td><?php echo $comment->id; ?></td>
                        <td><?php echo $comment->author; ?>
                        </td>
                        <td><?php echo $comment->body; ?>
                            <td><div class="action_links">
                                <a href="includes/delete_comment.php?id=<?php echo $comment->id; ?>&count=<?php echo $count; ?>">Delete</a>
                            </div></td>
                        </td>
                    </tr>
    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>