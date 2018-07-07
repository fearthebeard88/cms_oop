<?php require_once('init.php'); ?>
<?php if(!$session->is_signed_in()) {redirect('../login.php');} ?>
<?php

if(empty($_GET['id'])) {
    redirect('../comments.php');
}

$comment = Comment::find_id($_GET['id']);

if($_GET['count'] >= 2 && $_GET['comments'] !== 'yes') {
    $comment->delete();
    redirect("../comment_photo.php?photo_id={$comment->photo_id}");
} else if($_GET['count'] <= 1 && $_GET['comments'] !== 'yes') {
    $comment->delete();
    redirect("../photos.php");
} else if($_GET['comments'] === 'yes') {
    $comment->delete();
    redirect("../comments.php");
}


// if($comment) {
//     $comment->delete();
//     redirect("../comment_photo.php?photo_id={$comment->photo_id}");
// }

// ill finish figuring out how to really stick it together later
// if(!empty($_GET['comment'])) {
//     $comment->delete();
//     redirect("../photos.php");
// } else {
//     $comment->delete();
//     redirect("../comments.php");
// }

?>