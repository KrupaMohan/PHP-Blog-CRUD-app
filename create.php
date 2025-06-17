<?php
/**
 * Create New Blog Post
 * Form to add a new blog post to the database
 */

require_once 'db.php';

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $author = trim($_POST['author'] ?? '');
    
    // Validate input
    if (empty($title) || empty($content) || empty($author)) {
        $message = 'All fields are required!';
        $messageType = 'danger';
    } else {
        try {
            // Prepare and execute the insert statement
            $stmt = $pdo->prepare("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)");
            $stmt->execute([$title, $content, $author]);
            
            $message = 'Post created successfully!';
            $messageType = 'success';
            
            // Clear form data after successful submission
            $title = $content = $author = '';
            
        } catch(PDOException $e) {
            $message = 'Error creating post: ' . $e->getMessage();
            $messageType = 'danger';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post - My Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-blog me-2"></i>My Blog
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home me-1"></i>Home
                </a>
                <a class="nav-link active" href="create.php">
                    <i class="fas fa-plus me-1"></i>New Post
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col">
                        <h1 class="display-5">
                            <i class="fas fa-plus-circle me-2"></i>Create New Post
                        </h1>
                        <p class="lead">Share your thoughts with the world</p>
                    </div>
                </div>

                <!-- Alert Messages -->
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                        <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
                        <?php echo htmlspecialchars($message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Create Post Form -->
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading me-1"></i>Title
                                </label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?php echo htmlspecialchars($title ?? ''); ?>" 
                                       placeholder="Enter post title" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="author" class="form-label">
                                    <i class="fas fa-user me-1"></i>Author
                                </label>
                                <input type="text" class="form-control" id="author" name="author" 
                                       value="<?php echo htmlspecialchars($author ?? ''); ?>" 
                                       placeholder="Enter your name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="content" class="form-label">
                                    <i class="fas fa-edit me-1"></i>Content
                                </label>
                                <textarea class="form-control" id="content" name="content" rows="10" 
                                          placeholder="Write your blog post content here..." required><?php echo htmlspecialchars($content ?? ''); ?></textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Home
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Create Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light mt-5 py-4">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; 2025 My Blog. Built with PHP, MySQL, and Bootstrap.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 