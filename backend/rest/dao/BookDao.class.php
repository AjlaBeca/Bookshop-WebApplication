<?php

require_once __DIR__ . "/BaseDao.class.php";

class BookDao extends BaseDao {
    public function __construct(){
        parent::__construct("book");
    }

    public function getAll() {
        // Query to fetch all records from the specified table
        $query = "SELECT b.*, GROUP_CONCAT(t.Name) AS Tags, a.Name AS Author
          FROM book b
          LEFT JOIN BookTag bt ON b.BookID = bt.BookID
          LEFT JOIN tag t ON bt.TagID = t.TagID
          LEFT JOIN Author a ON b.AuthorID = a.AuthorID
          LEFT JOIN Publisher p ON b.PublisherID = p.PublisherID
          LEFT JOIN Genre g ON b.GenreID = g.GenreID
          GROUP BY b.BookID";

    
        // Execute the query and return the result
        return $this->query($query, []);
    }  

}
?>
