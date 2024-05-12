<?php
require_once __DIR__ . "/../dao/PublisherDao.class.php";

class PublisherService {
    private $publisher_dao;

    public function __construct() {
        $this->publisher_dao = new PublisherDao();
    }

    public function fetchAll() {
        return $this->publisher_dao->getPublishers();
    }
}
?>
