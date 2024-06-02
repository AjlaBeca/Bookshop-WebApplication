<?php
require_once __DIR__ . "/../dao/AuthorDao.class.php";

class AuthorService {
    private $author_dao;

    public function __construct() {
        $this->author_dao = new AuthorDao();
    }

    public function fetchAll() {
        return $this->author_dao->getAuthors();
    }
}
?>
