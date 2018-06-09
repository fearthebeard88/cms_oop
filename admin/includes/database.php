<?php

require_once("new_config.php");

class Database {

    public $connect;

    public function open_db() {
        $this -> connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!$connect) {
        die(mysqli_error($connect));
        }
    }

    function __construct() {
        $this -> open_db();
    }

}

$db = new Database();

?>