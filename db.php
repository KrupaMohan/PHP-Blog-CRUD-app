<?php
/**
 * Database Connection Configuration
 * Handles MySQL database connection for the blog application
 */

// Database configuration
$host = 'localhost';
$dbname = 'blog_db';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}

/**
 * Function to create the posts table if it doesn't exist
 */
function createPostsTable($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        author VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    try {
        $pdo->exec($sql);
    } catch(PDOException $e) {
        die("Error creating table: " . $e->getMessage());
    }
}

// Create table if it doesn't exist
createPostsTable($pdo);
?> 