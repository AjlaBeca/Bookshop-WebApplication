<?php
require_once __DIR__ . "/BaseDao.class.php";

class PublisherDao extends BaseDao {
    public function __construct(){
        parent::__construct("publisher");
    }

    public function fetchAll() {
        return $this->getPublishers();
    }
}
?>
