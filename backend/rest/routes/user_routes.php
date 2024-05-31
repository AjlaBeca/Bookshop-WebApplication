<?php
// Include Flight PHP and autoload.php
require_once __DIR__ . '/../../vendor/autoload.php';

// Include the UserService class
require_once __DIR__ . "/../services/UserService.class.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all users",
 *     ),
 * )
 */
// Route to handle GET request for fetching users
Flight::route('GET /users', function(){
    // Instantiate the UserDao class
    $userService = new UserService();

    // Fetch all users from the database
    $users = $userService->fetchAll();

    // Return the users as JSON
    Flight::json($users);
});

/**
 * @OA\Post(
 *     path="/users/add",
 *     tags={"users"},
 *     summary="Add a user",
 *     @OA\RequestBody(
 *         description="User to be added",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="name", type="string", example="John", required=true),
 *                 @OA\Property(property="surname", type="string", example="Doe", required=true),
 *                 @OA\Property(property="email", type="string", example="a@gmail.com", required=true),
 *                 @OA\Property(property="password", type="string", example="password", required=true)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Adding a user to the database",
 *     ),
 * )
 */

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

/**
 * @OA\Post(
 *     path="/users/login",
 *     tags={"users"},
 *     summary="User login",
 *     @OA\RequestBody(
 *         description="Login credentials",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="email", type="string", example="ajlabeca@gmail.com", required=true),
 *                 @OA\Property(property="password", type="string", example="password", required=true)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login status",
 *     ),
 * )
 */

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