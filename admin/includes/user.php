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
    $object_array = array();
    while($row = mysqli_fetch_array($result_set)) {
        $object_array[] = self :: instantiate($row);
    }
    return $object_array;
}

public static function instantiate($found_user) {
    $user_object = new self;

    forEach($user_object as $prop => $value) {
        if($user_object->has_the_attribute($prop)) {
            $user_object->prop = $value;
        }
    }
    
    return $user_object;
}

private function has_the_attribute($prop) {
    $object_properties = get_object_vars($this);
    return array_key_exists($prop, $object_properties);
}

}

?>