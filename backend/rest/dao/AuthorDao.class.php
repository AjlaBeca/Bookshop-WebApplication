<?php
require_once __DIR__ . "/BaseDao.class.php";

class AuthorDao extends BaseDao {
    public function __construct(){
        parent::__construct("author");
    }

      
    public function getAuthors() {
        // Query to fetch all authors from the database
        $query = "SELECT DISTINCT a.*
                  FROM author a";

        // Execute the query and return the result
        return $this->query($query, []);
    }
}
?>
