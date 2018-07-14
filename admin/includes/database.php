<?php
// requiring constants from new_config file
require_once("new_config.php");

class Database {
    // public property undefined at this point
    public $connect;
    // function to set up database connection from constants defined in new_config file
    public function open_db() {
        $this -> connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if($this -> connect -> connect_errno) {
            die($this -> connect -> connect_error);
        } return $this->connect;
    }
    // function that will actually make the connection to the db when a new object is instantiated
    function __construct() {
        $this->db = $this -> open_db();
    }
    // function to make queries to the db
    public function query($sql) {
        $result = $this ->db->query($sql);
        $this -> confirm($result);
        return $result;
    }

    private function confirm($result) {
        if(!$result) {
            die($this ->db->error);
        }
    }

    public function escape($string) {
        return $this ->db->real_escape_string($string);
    }

    public function the_insert_id() {
        return mysqli_insert_id($this ->db);
    }
}

$db = new Database();

?>