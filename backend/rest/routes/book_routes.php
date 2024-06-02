<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Import necessary classes
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . "/../services/BookService.class.php";

/**
 * @OA\Get(
 *     path="/books",
 *     tags={"books"},
 *     summary="Get list of books",
 * security={{"ApiKey": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Array of all books",
 *     ),
 *  @OA\Response(
 *        response=401,
 *        description="Unauthorized"
 *   )
 * )
 */

Flight::route('GET /books', function(){
    // Instantiate the BookService class
    $bookService = new BookService();

    $books = $bookService->fetchAll();
    if (!is_array($books)) {
        $books = array($books);
    }

    // Return the books as JSON
    Flight::json($books);
    //echo '}]';
    if (getenv('ENVIRONMENT') === 'local') {
        echo '}]';
    }
    
});

?>
