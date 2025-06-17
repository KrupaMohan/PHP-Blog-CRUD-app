<?php
/**
 * Front Controller for the PHP Blog Application (MVC).
 * All requests are routed through this file.
 */

// 1. Configuration and Autoloading
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/models/PostModel.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/helpers/view_renderer.php';

// Initialize database connection
// $pdo is defined in db.php

// Create model and controller instances
$postModel = new PostModel($pdo);
$postController = new PostController($postModel);

// 2. Routing Logic
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$path = str_replace($basePath, '', $requestUri); // Get path relative to public/ directory

// Ensure path always starts with a leading slash
if (empty($path) || substr($path, 0, 1) !== '/') {
    $path = '/' . $path;
}

// Debug: Echo the calculated path
echo "Debug Path: " . $path . "<br>";

// Remove trailing slash for consistent routing, except for root
if ($path !== '/' && substr($path, -1) === '/') {
    $path = rtrim($path, '/');
}

// Simple routing
switch ($path) {
    case '/create':
        $postController->create();
        break;
    case '/view':
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            $postController->view($id);
        } else {
            header('Location: /'); // Redirect to home if ID is missing or invalid
            exit;
        }
        break;
    case '/edit':
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            $postController->edit($id);
        } else {
            header('Location: /');
            exit;
        }
        break;
    case '/delete':
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            $postController->delete($id);
        } else {
            header('Location: /');
            exit;
        }
        break;
    case '/':
    case '': // Handle empty path for root
        $postController->index();
        break;
    default:
        // Handle 404 Not Found
        http_response_code(404);
        echo "<h1>404 Not Found</h1><p>The requested page could not be found.</p>";
        // Optionally, render a 404 view
        // render('404.php', [], 'Page Not Found');
        break;
}

?> 