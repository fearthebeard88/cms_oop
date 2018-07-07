<?php

class Paginate extends DB_Object {
    public $page;
    public $photo_limit;
    public $photo_total;

    public function __construct($page=1, $photo_limit=4, $photo_total=0) {
        $this->page=(int)$page;
        $this->photo_limit=(int)$photo_limit;
        $this->photo_total=(int)$photo_total;
    }

    public function next_page() {
        return $this->page + 1;
    }

    public function previous_page() {
        return $this->page - 1;
    }

    public function total_pages() {
        return ceil($this->photo_total/$this->photo_limit);
    }

    public function has_previous() {
        return $this->previous_page() >= 1 ? true : false;
    }

    public function has_next() {
        return $this->next_page() <= $this->total_pages() ? true:false;
    }

    public function offset() {
        return ($this->page - 1)*$this->photo_limit;
    }
}

?>