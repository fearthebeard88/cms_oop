<?php
// requiring constants from new_config file
require_once("new_config.php");

class Database {
    // public property undefined at this point
    public $connect;
    // function to set up database connection from constants defined in new_config file
    public function open_db() {
        $this -> connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!$this -> connect) {
        die(mysqli_error($this -> connect));
        }
    }
    // function that will actually make the connection to the db when a new object is instantiated
    function __construct() {
        $this -> open_db();
    }
    // function to make queries to the db
    public function query($sql) {
        $result = mysqli_query($this -> connect, escape($sql));
        confirm($result);
        return $result;
    }
    // function to check to make sure the query to the db worked
    private function confirm($result) {
        if(!$result) {
            die(mysqli_error($this -> connect));
        }
    }
    // function that escapes the strings inserted to queries to avoid sql injection
    public function escape($string) {
        $escaped_query = mysqli_real_escape_string($this -> connect, $string);
        return $escaped_query;
    }

}

$db = new Database();

?>