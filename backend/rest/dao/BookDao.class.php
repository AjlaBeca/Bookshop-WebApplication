<?php

require_once __DIR__ . "/BaseDao.class.php";

class BookDao extends BaseDao {
    public function __construct(){
        parent::__construct("book");
    }

    public function fetchAll() {
        return $this->getAll();
    }

}
?>
