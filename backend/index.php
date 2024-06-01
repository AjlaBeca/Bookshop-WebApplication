<?php

require 'vendor/autoload.php';
require 'rest/routes/middleware_routes.php';
require 'rest/routes/book_routes.php';
require 'rest/routes/author_routes.php';
require 'rest/routes/publisher_routes.php';
require 'rest/routes/auth_routes.php';

Flight::route('/', function(){

});

Flight::start();