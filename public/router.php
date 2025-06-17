<?php

// public/router.php
// This file acts as a simple router for the PHP built-in web server.
// It ensures all non-static file requests are handled by index.php.

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the request is for a static asset (e.g., /css/, /js/, /images/)
// You might need to expand this list based on your static asset directories
if (preg_match('/\.(?:css|js|jpg|jpeg|gif|png|ico)$/', $path)) {
    return false; // Serve the static file as-is
}

// Otherwise, route all requests through index.php
require_once __DIR__ . '/index.php';

?> 