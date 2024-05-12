<?php
require_once __DIR__ . "/../dao/UserDao.class.php";

class UserService {
    private $user_dao;

    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function fetchAll() {
        // You can implement this method if needed
        return $this->user_dao->getUsers();
    }

public function addUser($name, $surname, $email, $password) {
    // Add validation or other logic here if needed
    return $this->user_dao->addUser($name, $surname, $email, $password);
}
}
?>
