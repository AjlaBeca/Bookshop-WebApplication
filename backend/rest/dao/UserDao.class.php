<?php
require_once __DIR__ . "/BaseDao.class.php";

class UserDao extends BaseDao {
    public function __construct(){
        parent::__construct("user");
    }

    public function fetchAll() {
        // You can implement this method if needed
        return $this->getUsers();
    }

public function addUser($name, $surname, $email, $password) {
    try {
        // Check if a user with the provided email already exists
        $query = "SELECT * FROM user WHERE Email = :email";
        $params = [":email" => $email];
        $result = $this->query($query, $params);
        if (!empty($result)) {
            // If a user with the provided email exists, return an error message
            return ["success" => false, "message" => "User already exists. Please login."];
        }
    
        // If no user with the provided email exists, proceed to add the user to the database
        $query = "INSERT INTO user (Name, Surname, Email, Password) VALUES (:name, :surname, :email, :password)";
        $params = [
            ":name" => $name,
            ":surname" => $surname,
            ":email" => $email,
            ":password" => $password
        ];
        $this->query($query, $params);
        return ["success" => true, "message" => "User added successfully"];
    } catch (Exception $e) {
        // Catch all exceptions
        return ["success" => false, "message" => "Error: " . $e->getMessage()];
    }
}   

    public function checkLogin($email, $password) {
        // Retrieve the user from the database based on the provided email
        $query = "SELECT * FROM user WHERE Email = :email";
        $params = [":email" => $email];
        $result = $this->query($query, $params);
    
        // If a user with the provided email exists
        if (!empty($result)) {
            // Retrieve the password from the database
            $storedPassword = $result[0]['Password'];
    
            // Compare the provided password with the stored password
            if ($password === $storedPassword) {
                return true; // Return true if the passwords match
            }
        }
    
        return false; // Return false if the user does not exist or the passwords do not match
    }
    
    
    
    

    public function getUsers() {
        // Query to fetch all users from the database
        $query = "SELECT * FROM user";
        return $this->query($query, []);
    }
}
?>
