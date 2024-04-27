<?php
require_once __DIR__ . "/rest/services/AuthorService.class.php";

$authorService = new AuthorService();
$authors = $authorService->fetchAll();

header('Content-Type: application/json');
echo json_encode($authors);
?>
