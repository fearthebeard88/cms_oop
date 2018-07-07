<?php require_once('init.php'); ?>
<?php if(!$session->is_signed_in()) {redirect('../login.php');} ?>
<?php

if(empty($_GET['id'])) {
    redirect('../comments.php');
}

$comment = Comment::find_id($_GET['id']);

if(!empty($_GET['comment'])) {
    $comment->delete();
    redirect("../photos.php");
} else {
    $comment->delete();
    redirect("../comments.php");
}

?>