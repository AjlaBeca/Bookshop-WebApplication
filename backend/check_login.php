<?php
// Include the UserDao class
require_once __DIR__ . "/rest/dao/UserDao.class.php";

// Check if both email and password are provided
if (isset($_POST['email'], $_POST['password'])) {
    // Retrieve email and password from POST parameters
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate the UserDao class
    $userDao = new UserDao();

    // Check login credentials
    $isLoggedIn = $userDao->checkLogin($email, $password);

    // Return JSON response indicating login status
    echo json_encode(["success" => $isLoggedIn, "message" => ""]);
} else {
    // Return error response if email or password is missing
    echo json_encode(["success" => false, "message" => "Email and password are required"]);
}
?>
 