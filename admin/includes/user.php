
<?php

class User extends DB_Object {
    // properties available to this class
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

public static function verify_user($username, $password) {
    global $db;
    $username = $db -> escape($username);
    $password = $db -> escape($password);

    $sql = "SELECT * FROM " . self :: $db_table . " WHERE ";
    $sql .= "username = '{$username}' AND password = '{$password}' LIMIT 1 ";

    $results = Self :: find_query($sql);
    return !empty($results) ? array_shift($results) : false;
}

}

?>