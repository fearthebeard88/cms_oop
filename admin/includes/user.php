<?php

class User {
    // properties available to this class
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

// static function calling the find_query method which uses the query method from $db which escapes the query, and makes sure there are no errors, and puts it into an array and then stuffing it into an object with the User class
public static function find_all_users() {
    global $db;
    return self :: find_query("SELECT * FROM users ");
}

// static method that runs the find_query method to make a query to $db to find a specific user
public static function find_user($id) {
    global $db;
$results = self :: find_query("SELECT * FROM users WHERE id = {$id} LIMIT 1 ");
return !empty($results) ? array_shift($results) : false;


}
// method that runs the query method from $db to escape and catch errors, then turns the results into an instantiated object with User class
public static function find_query($sql) {
    global $db;
    $result_set = $db -> query($sql);
    $object_array = array();
    while($row = mysqli_fetch_array($result_set)) {
        $object_array[] = self :: instantiate($row);
    }
    return $object_array;
}

public static function verify_user($username, $password) {
    global $db;
    $username = $db -> escape($username);
    $password = $db -> escape($password);

    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username = '{$username}' AND password = '{$password}' LIMIT 1 ";

    $results = Self :: find_query($sql);
    return !empty($results) ? array_shift($results) : false;

}
// makes a new object with User class, but assigning the property values with values from the $db or whatever its called on
public static function instantiate($found_user) {
    $user_object = new self;

    forEach($found_user as $prop => $value) {
        if($user_object->has_the_attribute($prop)) {
            $user_object->$prop = $value;
        }
    }
    
    return $user_object;
}
// method that finds the key name to an array
private function has_the_attribute($prop) {
    $object_properties = get_object_vars($this);
    return array_key_exists($prop, $object_properties);
}

protected function properties() {
    $properties = array();
    forEach(Self :: $db_table_fields as $db_field) {
        if(property_exists($this, $db_field)) {
            $properties[$db_field] = $this -> $db_field;
        }
    } return $properties;
}

public function save() {
    return isSet($this -> id) ? $this -> update() : $this -> create();
}

public function create() {
    global $db;

    $properties = $this -> properties();

    $sql = "INSERT INTO " . self::$db_table . " (" . implode(",",array_keys($properties)) . ") ";
    $sql .= "VALUES ('" . implode("','",array_values($properties)) . "')";
    
    if($db -> query($sql)) {
        $this -> id = $db -> the_insert_id();
        return true;
    } else {
        return false;
    }

}

public function update() {
    global $db;

    $sql = "UPDATE " . self :: $db_table . " SET ";
    $sql .= "username = '" . $db -> escape($this -> username) . "', ";
    $sql .= "password = '" . $db -> escape($this -> password) . "', ";
    $sql .= "first_name = '" . $db -> escape($this -> first_name) . "', ";
    $sql .= "last_name = '" . $db -> escape($this -> last_name) . "' ";
    $sql .= "WHERE id = " . $db -> escape($this -> id);

    $db -> query($sql);

    return mysqli_affected_rows($db -> connect) == 1 ? true : false;

}

public function delete() {
    global $db;

    $sql = "DELETE FROM " . self :: $db_table . " WHERE id = " . $db -> escape($this -> id);
    $sql .= " LIMIT 1 ";
    $db -> query($sql);

    return mysqli_affected_rows($db -> connect) == 1 ? true : false;
}

}

?>