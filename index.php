<?php
/**
 * Main Blog Page - Display All Posts
 * Shows a list of all blog posts with options to view, edit, and delete
 */

require_once 'db.php';

// Handle success messages
$message = '';
$messageType = '';

if (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
    $message = 'Post deleted successfully!';
    $messageType = 'success';
}

// Fetch all posts from database
try {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $stmt->fetchAll();
} catch(PDOException $e) {
    die("Error fetching posts: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
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
                <a class="nav-link" href="create.php">
                    <i class="fas fa-plus me-1"></i>New Post
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Success Message -->
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4">Welcome to My Blog</h1>
                <p class="lead">Read, create, and manage your blog posts</p>
            </div>
        </div>

        <!-- Posts Section -->
        <?php if (empty($posts)): ?>
            <!-- No posts message -->
            <div class="row">
                <div class="col">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>No posts yet!</h4>
                        <p>Get started by creating your first blog post.</p>
                        <a href="create.php" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Create First Post
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Posts Grid -->
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php 
                                    $content = htmlspecialchars($post['content']);
                                    echo strlen($content) > 150 ? substr($content, 0, 150) . '...' : $content;
                                    ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($post['author']); ?>
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($post['created_at'])); ?>
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="btn-group w-100" role="group">
                                    <a href="view.php?id=<?php echo $post['id']; ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-outline-danger btn-sm" 
                                       onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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