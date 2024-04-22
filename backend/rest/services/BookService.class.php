<?php
require_once __DIR__ . "/../dao/BookDao.class.php";

class BookService {
    private $book_dao;

    public function __construct() {
        $this->book_dao = new BookDao();
    }

    public function fetchAll() {
        return $this->book_dao->fetchAll();
    }
}
?>
