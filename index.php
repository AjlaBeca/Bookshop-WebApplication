<?php
if (getenv('ENVIRONMENT') === "local") {
    // If the application is running in a local environment, include '/webprogramming/index.html'
    header("Location: /webprogramming_bookshop/index.html");
} else {
    // If the application is running in a deployed environment, include '/index.html'
    header("Location: /index.html");
}

die();