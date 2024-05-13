<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . "/../services/AuthorService.class.php";

// Route to handle GET request for /authors
Flight::route('GET /authors', function(){
    // Instantiate the AuthorService class
    $authorService = new AuthorService();

    // Fetch all authors from the database
    $authors = $authorService->fetchAll();

    // Return the authors as JSON
    Flight::json($authors);
});
?>
