<?php 
$pageTitle = htmlspecialchars($post['title']) . ' - My Blog';
$headContent = '<style>
        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .post-meta {
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 0;
            margin: 2rem 0;
        }
    </style>';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Back Button -->
        <div class="mb-3">
            <a href="/" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to All Posts
            </a>
        </div>

        <!-- Post Content -->
        <article class="card shadow">
            <div class="card-body">
                <!-- Post Title -->
                <h1 class="display-4 mb-3"><?php echo htmlspecialchars($post['title']); ?></h1>
                
                <!-- Post Meta Information -->
                <div class="post-meta">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="fas fa-user text-primary me-2"></i>
                                <strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <strong>Published:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($post['created_at'])); ?>
                            </p>
                        </div>
                    </div>
                    <?php if ($post['updated_at'] !== $post['created_at']): ?>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p class="mb-0">
                                    <i class="fas fa-edit text-warning me-2"></i>
                                    <strong>Last Updated:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($post['updated_at'])); ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Post Content -->
                <div class="post-content">
                    <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="/" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-1"></i>All Posts
                        </a>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="/edit?id=<?php echo $post['id']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit Post
                        </a>
                        <a href="/delete?id=<?php echo $post['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                            <i class="fas fa-trash me-1"></i>Delete Post
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div> 