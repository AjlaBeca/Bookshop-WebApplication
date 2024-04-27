<?php
// Include the UserService class
require_once __DIR__ . "/rest/services/UserService.class.php";

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
    echo json_encode($response);
} else {
    // Return error response if any required parameter is missing
    echo json_encode(["success" => false, "message" => "Missing required parameters"]);
}
?>
