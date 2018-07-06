<?php require_once('init.php'); ?>
<?php if(!$session->is_signed_in()) {redirect('../login.php');} ?>
<?php

if(empty($_GET['id'])) {
    redirect('../comments.php');
}

$comment = Comment::find_id($_GET['id']);

if($comment) {
    $comment->delete();
    redirect("../comments.php");
} else {
    die("Failed to delete the comment, this program shall terminate now.  Goodbye...*fizzle sound*");
}

?>