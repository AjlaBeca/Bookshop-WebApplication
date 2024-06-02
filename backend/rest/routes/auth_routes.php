<?php

require_once __DIR__ . '/../services/AuthService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * @OA\Post(
 *      path="/auth/login",
 *      tags={"authentification"},
 *      summary="Log in",
 *      @OA\Response(
 *          response=200,
 *          description="Log in the user and return the user data or 401 if the user does not exist",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Invalid username or password"
 *     ),
 *      @OA\RequestBody(
 *          description="User object that needs to log in",
 *          @OA\JsonContent(
 *              @OA\Property(property="email", type="email", example="ab@gmail.com", description="User email"),
 *              @OA\Property(property="password", type="string", example="123456", description="User password")
 *        )
 *      )
 * )
 */
    Flight::route('POST /auth/login', function(){
        $data = Flight::request()->data->getData();
        $authService = new AuthService();
        
    $user = $authService->get_user_by_email($data['email']);
        if(!$user || !password_verify($data['password'], $user['Password'])){
            Flight::halt(401, 'Invalid username or password');
        }
        
        unset($user['password']);
        
        $jwt_payload = [
            'user' => $user,
            'iat' => time(),
            'exp' => time() + (60*60*24),
        ];

        $token = JWT::encode($jwt_payload, Config::JWT_SECRET(), "HS256");

        Flight::json(
            array_merge($user, ['token' => $token])
        );
    });

    /**
 * @OA\Post(
 *      path="/auth/register",
 *      tags={"authentification"},
 *      summary="Register a new user",
 *      @OA\Response(
 *          response=200,
 *          description="User is registered",
 *      ),
 *      @OA\Response(
 *         response=500,
 *         description="Error while registering the user (the email is probably already in use)"
 *    ),
 *      @OA\Response(
 *        response=400,
 *          description="All fields are required"
 *   ),
 *      @OA\RequestBody(
 *          description="User object that needs to log in",
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="John", description="User name"),
 *              @OA\Property(property="surname", type="string", example="Doe", description="User surname"),
 *              @OA\Property(property="email", type="email", example="email@email.com", description="User email"),
 *              @OA\Property(property="password", type="string", example="password", description="User password")
 *        )
 *      )
 * )
 */

    Flight::route('POST /auth/register', function(){
        $authService = new AuthService();
        $name = Flight::request()->data->name;
        $surname = Flight::request()->data->surname;
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;

        if ($name == "" || $surname == "" || $email == "" || $password == "") {
            Flight::halt(400, 'All fields are required');
        }

        $data = [
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "password" => $password
        ];

        $reponse = $authService->add_user($data);

    });
