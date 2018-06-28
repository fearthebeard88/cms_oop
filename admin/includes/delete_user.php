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

if($user -> delete()) {
    redirect('../users.php');
} else {
    redirect('../users.php');
}

?>