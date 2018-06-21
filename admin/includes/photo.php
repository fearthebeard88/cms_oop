<?php

class Photo extends DB_Object {
    protected static $db_table = "photo";
    protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'type', 'size');
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_directory = "images";
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

    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)) {
            $this -> error[] = "File upload failure";
            return false;
        } else if ($file['error'] != 0) {
            $this -> upload_errors[$file['error']];
            return false;
        } else {
            $this -> filename = basename(($file['name']));
            $this -> tmp_path = $file['tmp_name'];
            $this -> type = $file['type'];
            $this -> size = $file['size'];
        }
    }

    public function save_db() {
        if($this -> photo_id) {
            $this -> update();
        } else {
            if(!empty($this -> errors)) {
                return false;
            }

            if(empty($this -> filename) || empty($this -> tmp_path)) {
                $this -> error[] = "File not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this -> upload_directory . DS . $filename;

            $this -> create();
        }
    }

}

?>