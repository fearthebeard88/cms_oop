<?php

class User {

    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

public static function find_all_users() {
    global $db;
    return self :: find_query("SELECT * FROM users ");
}

public static function find_user($id) {
    global $db;
$results = self :: find_query("SELECT * FROM users WHERE id = {$id} LIMIT 1 ");
$found_user = mysqli_fetch_array($results);

return $found_user;
}

public static function find_query($sql) {
    global $db;
    $result_set = $db -> query($sql);
    return $result_set;
}

}

?>