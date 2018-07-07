<?php include("includes/header.php"); ?>
<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$photo_limit = 4;
$photo_total = Photo::count_all();

$paginate = new Paginate($page,$photo_limit,$photo_total);
$sql="SELECT * FROM photo LIMIT {$photo_limit} ";
$sql .= "OFFSET {$paginate->offset()} ";
$photos = Photo::find_query($sql);

?>
<div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php forEach($photos as $photo): ?>
                <div class="col-xs-6 col-md-3">
                    <a class = "thumbnail" href="photo_page.php?id=<?php echo $photo->id; ?>">
                        <img class="home_picture" src = "admin/<?php echo $photo->image_path(); ?>" alt="">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    <!-- Blog Sidebar Widgets Column -->
    <!-- <div class="col-md-4"> -->

<?php // include("includes/sidebar.php"); ?>

<!-- </div> -->
<!-- /.row -->

<?php include("includes/footer.php"); ?>
