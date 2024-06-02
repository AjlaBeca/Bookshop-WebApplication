<?php

require_once __DIR__ . '/BaseDao.class.php';

class AuthDao extends BaseDao {
    public function __construct() {
        parent::__construct('user');
    }
    public function get_user_by_email($email) {
        $query = "SELECT *
                  FROM user
                  WHERE email = :email";
        return $this->query_unique($query, ['email' => $email]);
    }

    public function add_user($user) {
        try {
            return $this->query_unique("INSERT INTO user (name, surname, email, password) VALUES (:name, :surname, :email, :password)", $user);
        } catch (Exception $e) {
            Flight::halt(500, 'Error while registering the user (the email is probably already in use)')
            ;
        }
    }
}
