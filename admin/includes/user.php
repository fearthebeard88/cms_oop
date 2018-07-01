
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
        return empty($this -> user_image) ? $this -> image_placeholder : $this -> upload_directory . DS . $this -> user_image;
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

public function set_image($file) {
    if(empty($file) || !$file || !is_array($file)) {
        $this -> errors[] = "File upload failure";
        return false;
    } else if ($file['error'] != 0) {
        $this -> errors[] = $this -> upload_errors[$file['error']];
        return false;
    } else {
        $this -> user_image = basename($file['name']);
        $this -> tmp_path = $file['tmp_name'];
        $this -> type = $file['type'];
        $this -> size = $file['size'];
        return true;
    }
}

public function save_photo() {
    
        if(!empty($this -> errors)) {
            print_r($this -> errors);
            return false;
        }

        if(empty($this -> user_image) || empty($this -> tmp_path)) {
            $this -> errors[] = "File not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this -> upload_directory . DS . $this -> user_image;

        if(file_exists($target_path)) {
            $this -> errors[] = "The file {$this -> user_image} already exists";
            return false;
        }
        
        if(move_uploaded_file($this ->tmp_path, $target_path)) {
                unset($this -> tmp_path);
                $this -> save();
                return true;
        } else {
            echo $target_path;
            print_r($_FILES);
            $this -> errors[] = "The folder probably has issues with it's permissions";
            return false;
        }
    }
}



?>