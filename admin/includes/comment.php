<?php

class Comment extends DB_Object {
    protected static $db_table = 'comments';
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body', 'comment_count');
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $comment_count;

    public static function create_comment($photo_id, $author, $body, $comment_count) {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = (string)$body;
            $comment->comment_count = (int)$comment_count + 1;

            return $comment;
        } else {
            return false;
        }
    }

    public static function find_comments($photo_id = 0) {
        global $db;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE photo_id = " . $db->escape($photo_id);
        $sql .= " ORDER BY photo_id ASC";

        return self::find_query($sql);
    }

}

?>