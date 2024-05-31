<?php
// Include Flight PHP and autoload.php
require_once __DIR__ . '/../../vendor/autoload.php';

// Include the UserService class
require_once __DIR__ . "/../services/UserService.class.php";

// Route to handle GET request for fetching users
Flight::route('GET /users', function(){
    // Instantiate the UserDao class
    $userService = new UserService();

    // Fetch all users from the database
    $users = $userService->fetchAll();

    // Return the users as JSON
    Flight::json($users);
});

// Route to handle POST request for adding a user
Flight::route('POST /users/add', function(){
    // Check if all required POST parameters are set
    if (isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'])) {
        // Retrieve POST parameters
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Instantiate the UserService class
        $userService = new UserService();

        // Add the user
        $response = $userService->addUser($name, $surname, $email, $password);

        // Return the response as JSON
        Flight::json($response);
    } else {
        // Return error response if any required parameter is missing
        Flight::json(["success" => false, "message" => "Missing required parameters"]);
    }
});

// Route to handle POST request for user login
Flight::route('POST /users/login', function(){
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
        Flight::json(["success" => $isLoggedIn, "message" => ""]);
    } else {
        // Return error response if email or password is missing
        Flight::json(["success" => false, "message" => "Email and password are required"]);
    }
});

// Route to handle POST request for user login
Flight::route('POST /users/login', function(){
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
        Flight::json(["success" => $isLoggedIn, "message" => ""]);
    } else {
        // Return error response if email or password is missing
        Flight::json(["success" => false, "message" => "Email and password are required"]);
    }
});

?>