<?php $pageTitle = 'Edit Post - My Blog'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-5">
                    <i class="fas fa-edit me-2"></i>Edit Post
                </h1>
                <p class="lead">Update your blog post content</p>
            </div>
        </div>

        <!-- Edit Post Form -->
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="/edit?id=<?php echo $post['id']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-heading me-1"></i>Title
                        </label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?php echo htmlspecialchars($post['title']); ?>" 
                               placeholder="Enter post title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="author" class="form-label">
                            <i class="fas fa-user me-1"></i>Author
                        </label>
                        <input type="text" class="form-control" id="author" name="author" 
                               value="<?php echo htmlspecialchars($post['author']); ?>" 
                               placeholder="Enter your name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">
                            <i class="fas fa-edit me-1"></i>Content
                        </label>
                        <textarea class="form-control" id="content" name="content" rows="12" 
                                  placeholder="Write your blog post content here..." required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    
                    <!-- Post Info -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <small>
                                    <i class="fas fa-calendar me-1"></i>
                                    <strong>Created:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($post['created_at'])); ?>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small>
                                    <i class="fas fa-edit me-1"></i>
                                    <strong>Last Updated:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($post['updated_at'])); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Home
                            </a>
                            <a href="/view?id=<?php echo $post['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View Post
                            </a>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 