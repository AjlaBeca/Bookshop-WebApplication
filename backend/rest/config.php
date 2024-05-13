<?php

// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// Database access credentials
define('DB_NAME', 'bookstore');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');

// JWT Secret
//define('JWT_SECRET', 'hgY=&*54#T+kTe,8zT=7L-3z4tV/&9');