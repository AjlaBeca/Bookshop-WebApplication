<?php
header("Access-Control-Allow-Origin: *");
// Include the BookService class
require_once __DIR__ . "/rest/services/BookService.class.php";

// Instantiate the BookService class
$bookService = new BookService();

// Fetch all books from the database
$books = $bookService->fetchAll();

// Return the books as JSON
header('Content-Type: application/json');
echo json_encode($books);
?>
