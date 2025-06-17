<?php $pageTitle = 'Create New Post - My Blog'; ?>

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

        <!-- Create Post Form -->
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="/create">
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
                        <a href="/" class="btn btn-secondary">
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