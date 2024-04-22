<?php
require_once __DIR__ . "/rest/services/UserService.class.php";

// Assuming POST request with form data containing name, surname, email, and password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userService = new UserService();
    $userService->addUser($name, $surname, $email, $password);

    echo "User added successfully!";
} else {
    echo "Invalid request method!";
}
?>
