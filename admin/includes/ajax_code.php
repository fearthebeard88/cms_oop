<?php require("init.php"); ?>
<?php

$user = new User();

if(isSet($_POST['image_name'])) {
    $user->ajax_image($_POST['image_name'], $_POST['user_id']);
}



if(isSet($_POST['photo_id'])) {
    Photo::sidebar_data($_POST['photo_id']);
}

?>