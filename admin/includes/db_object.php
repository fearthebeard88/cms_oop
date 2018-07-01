
<?php

class DB_Object {
    public $errors = array();
    public $upload_errors = array(
        UPLOAD_ERR_OK => "There is no error, go us!",
    UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_file_size",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
    UPLOAD_ERR_PARTIAL => "The file was only partially uploaded",
    UPLOAD_ERR_NO_FILE => "Nothing was uploaded",
    UPLOAD_ERR_NO_TMP_DIR => "Missing the temp folder",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
    UPLOAD_ERR_EXTENSION => "A php extension is blocking the file upload"
    );

// static function calling the find_query method which uses the query method from $db which escapes the query, and makes sure there are no errors, and puts it into an array and then stuffing it into an object with the User class
public static function find_all() {
    global $db;
    return static :: find_query("SELECT * FROM " . static :: $db_table . " ");
}

// static method that runs the find_query method to make a query to $db to find a specific user
public static function find_id($id) {
    global $db;
$results = static :: find_query("SELECT * FROM " . static :: $db_table . " WHERE id = {$id} LIMIT 1 ");
return !empty($results) ? array_shift($results) : false;

}
// method that runs the query method from $db to escape and catch errors, then turns the results into an instantiated object with User class
public static function find_query($sql) {
    global $db;
    $result_set = $db -> query($sql);
    $object_array = array();
    while($row = mysqli_fetch_array($result_set)) {
        $object_array[] = static :: instantiate($row);
    }
    return $object_array;
}

// makes a new object with User class, but assigning the property values with values from the $db or whatever its called on
public static function instantiate($found_data) {
    $calling_class = get_called_class();
    $user_object = new $calling_class;

    forEach($found_data as $prop => $value) {
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
    forEach(static :: $db_table_fields as $db_field) {
        if(property_exists($this, $db_field)) {
            $properties[$db_field] = $this -> $db_field;
        }
    } return $properties;
}

protected function clean_properties() {
    global $db;

    $clean = array();
    forEach($this -> properties() as $key => $value) {
        $clean[$key] = $db -> escape($value);
    } return $clean;
}

public function save() {
    return isSet($this -> id) ? $this -> update() : $this -> create();
}

public function create() {
    global $db;

    $properties = $this -> clean_properties();

    $sql = "INSERT INTO " . static::$db_table . " (" . implode(",",array_keys($properties)) . ") ";
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

    $properties = $this -> clean_properties();
    $pairs = array();

    forEach($properties as $key => $value) {
        $pairs[] = "{$key} = '{$value}'";
    }

    $sql = "UPDATE " . static :: $db_table . " SET ";
    $sql .= implode(", ", $pairs);
    $sql .= "WHERE id = " . $this -> id;

    $db -> query($sql);

    return mysqli_affected_rows($db -> connect) == 1 ? true : false;

}

public function delete() {
    global $db;

    $sql = "DELETE FROM " . static :: $db_table . " WHERE id = " . $db -> escape($this -> id);
    $sql .= " LIMIT 1 ";
    $db -> query($sql);

    return mysqli_affected_rows($db -> connect) == 1 ? true : false;
}

}

?>