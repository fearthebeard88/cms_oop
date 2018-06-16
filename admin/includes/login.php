<?php require_once("init.php"); ?>
<?php

if($session -> is_signed_in()) {
    redirect('index.php');
}

if(isSet($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim(['password']);

    if($user_found) {
        $session -> login($user_found);
        redirect('index.php');
    } else {
        $username = '';
        $password = '';
        echo "You shall not pass.";
    }
}

?>