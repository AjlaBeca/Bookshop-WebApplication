<?php
require_once __DIR__ . "/rest/services/UserService.class.php";

$userService = new UserService();
$users = $userService->fetchAll();

header('Content-Type: application/json');
echo json_encode($users);
?>
