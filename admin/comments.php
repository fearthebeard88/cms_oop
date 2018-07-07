<?php include("includes/header.php"); ?>
<?php if(!$session -> is_signed_in()) {
        redirect('login.php');
      }
?>
<?php

$comments = Comment :: find_all();

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
            Comments
            <small><a class = "btn btn-primary" href = "add_user.php">Add Comment</a></small>
        </h1>
        
        <div class="col-md-12">
            <table class = "table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo_Id</th>
                        <th>Author</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                forEach($comments as $comment) : 
                ?>
                    <tr>
                        <td><?php echo $comment->id; ?></td>
                        <td><?php echo $comment->photo_id; ?>
                        </td>
                        <td><?php echo $comment->author; ?>
                            <div class="action_links">
                                <a href="includes/delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                            </div>
                        </td>
                        <td><?php echo $comment->body; ?></td>
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