<?php require("init.php"); ?>
<?php

$user = new User();

if(isSet($_POST['image_name'])) {
    $user->ajax_image($_POST['image_name'], $_POST['user_id']);
}

?>