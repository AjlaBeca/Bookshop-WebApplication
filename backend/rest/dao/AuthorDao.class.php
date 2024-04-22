<?php
require_once __DIR__ . "/BaseDao.class.php";

class AuthorDao extends BaseDao {
    public function __construct(){
        parent::__construct("author");
    }

    public function fetchAll() {
        return $this->getAuthors();
    }
}
?>
