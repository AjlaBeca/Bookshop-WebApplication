<?php
// Include Flight PHP and autoload.php
require_once __DIR__ . '/../../vendor/autoload.php';

// Include the PublisherService class
require_once __DIR__ . "/../services/PublisherService.class.php";

/**
 * @OA\Get(
 *     path="/publishers",
 *     tags={"publishers"},
 *     summary="Get all publishers",
 *      security={{"ApiKey": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Array of all publishers",
 *     ),
 *  @OA\Response(
 *        response=401,
 *        description="Unauthorized"
 *   )
 * )
 */
// Route to handle GET request for /publishers
Flight::route('GET /publishers', function(){
    // Instantiate the PublisherService class
    $publisherService = new PublisherService();

    // Fetch all publishers from the database
    $publishers = $publisherService->fetchAll();

    // Return the publishers as JSON
    Flight::json($publishers);
});
?>
