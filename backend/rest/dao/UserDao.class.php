<?php
require_once __DIR__ . "/BaseDao.class.php";

class UserDao extends BaseDao {
    public function __construct(){
        parent::__construct("user");
    }

    public function fetchAll() {
        // You can implement this method if needed
        return $this->getAll();
    }

    public function addUser($name, $surname, $email, $password) {
        $query = "INSERT INTO user (Name, Surname, Email, Password) VALUES (:name, :surname, :email, :password)";
        $params = [
            ":name" => $name,
            ":surname" => $surname,
            ":email" => $email,
            ":password" => $password
        ];
        $this->query($query, $params);
    }
}
?>
