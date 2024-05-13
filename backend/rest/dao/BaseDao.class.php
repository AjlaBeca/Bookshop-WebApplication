
<?php

require_once __DIR__ ."/../config.php";

class BaseDao {
    protected $connection;
    private $table;

    public function __construct($table) {
        $this->table = $table;
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT,
                DB_USER,
                DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e){
            throw $e;
        }
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
    
    public function getAuthors() {
        // Query to fetch all authors from the database
        $query = "SELECT DISTINCT a.*
                  FROM author a";

        // Execute the query and return the result
        return $this->query($query, []);
    }

    public function getPublishers() {
        // Query to fetch all publishers from the database
        $query = "SELECT DISTINCT p.*
                  FROM publisher p";

        // Execute the query and return the result
        return $this->query($query, []);
    }

    public function getUsers() {
        // Query to fetch all publishers from the database
        $query = "SELECT DISTINCT u.*
                  FROM user u";

        // Execute the query and return the result
        return $this->query($query, []);
    }


    protected function query($query, $params) {
        //echo "SQL Query: $query"; // Log the SQL query
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } 

}
