<?php include("init.php"); ?>
<?php if(!$session -> is_signed_in()) {
        redirect('login.php');
      }
?>
<?php

if(empty($_GET['id'])) {
    redirect('../users.php');
}

$user = User :: find_id($_GET['id']);

if($user) {
    $user->delete_photo();
    $session->message("{$user->username}, has been removed.");
    redirect('../users.php');
} else {
    $session->message("User has not been removed.");
    redirect('../users.php');
}

?>