<?php
require_once __DIR__ . "/BaseDao.class.php";

class PublisherDao extends BaseDao {
    public function __construct(){
        parent::__construct("publisher");
    }

    public function getPublishers() {
        // Query to fetch all publishers from the database
        $query = "SELECT DISTINCT p.*
                  FROM publisher p";

        // Execute the query and return the result
        return $this->query($query, []);
    }
}
?>
