
<?php

class User extends DB_Object {
    // properties available to this class
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://via.placeholder.com/200x200&text=image";

    public function user_picture() {
        return empty($this -> user_image) ? $this -> image_placeholder : "includes" . DS . $this -> upload_directory . DS . $this -> user_image;
    }

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