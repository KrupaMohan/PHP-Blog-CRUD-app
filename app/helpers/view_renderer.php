<?php

/**
 * Helper function to render a view with a given layout.
 * @param string $viewPath The path to the view file (e.g., 'posts/index.php').
 * @param array $data An associative array of data to pass to the view.
 * @param string $pageTitle The title for the HTML page.
 * @param string $headContent Optional content to inject into the <head> section.
 */
function render($viewPath, $data = [], $pageTitle = 'My Blog', $headContent = '') {
    // Extract data variables so they can be accessed directly in the view files
    extract($data);

    // Start output buffering to capture the view content
    ob_start();
    require __DIR__ . '/../views/' . $viewPath;
    $content = ob_get_clean(); // Get the buffered content and clean the buffer

    // Include the main layout file, which will display the captured content
    require __DIR__ . '/../views/layout.php';
} 