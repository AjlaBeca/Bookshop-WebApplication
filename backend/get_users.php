<?php
// Include the UserService class
require_once __DIR__ . "/rest/services/UserService.class.php";

// Instantiate the UserService class
$userService = new UserService();

// Fetch all users
$users = $userService->fetchAll();

// Return users as JSON
header('Content-Type: application/json');
echo json_encode($users);
?> 
