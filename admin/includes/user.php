<?php

class User {

public static function find_all_users() {
    global $db;
    $result_set = $db -> query("SELECT * FROM users");
    return $result_set;
}

public static function find_user($id) {
    global $db;
$results = $db -> query("SELECT * FROM users WHERE id = {$id} LIMIT 1");
$found_user = mysqli_fetch_array($results);

return $found_user;
}

}

?>