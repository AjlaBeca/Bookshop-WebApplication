<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'rest/routes/book_routes.php';
require 'rest/routes/author_routes.php';
require 'rest/routes/publisher_routes.php';
require 'rest/routes/user_routes.php';

Flight::route('/', function(){

});

Flight::start();