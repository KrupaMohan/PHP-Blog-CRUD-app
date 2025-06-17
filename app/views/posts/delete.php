<?php $pageTitle = 'Delete Post - My Blog'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-5 text-danger">
                    <i class="fas fa-trash me-2"></i>Delete Post
                </h1>
                <p class="lead">Are you sure you want to delete this post?</p>
            </div>
        </div>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Post Preview -->
        <div class="card border-danger mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Post to be Deleted
                </h5>
            </div>
            <div class="card-body">
                <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                <p class="text-muted">
                    <i class="fas fa-user me-1"></i>By <?php echo htmlspecialchars($post['author']); ?>
                    <span class="ms-3">
                        <i class="fas fa-calendar me-1"></i><?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                    </span>
                </p>
                <div class="border-top pt-3">
                    <p class="text-muted">
                        <?php 
                        $content = htmlspecialchars($post['content']);
                        echo strlen($content) > 200 ? substr($content, 0, 200) . '...' : $content;
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Warning Message -->
        <div class="alert alert-warning">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-triangle me-2"></i>Warning!
            </h5>
            <p class="mb-0">
                This action cannot be undone. Once you delete this post, it will be permanently removed from the database.
            </p>
        </div>

        <!-- Confirmation Form -->
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="/delete?id=<?php echo $post['id']; ?>">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <a href="/view?id=<?php echo $post['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View Post
                            </a>
                            <a href="/edit?id=<?php echo $post['id']; ?>" class="btn btn-outline-warning">
                                <i class="fas fa-edit me-1"></i>Edit Instead
                            </a>
                        </div>
                        <button type="submit" name="confirm_delete" class="btn btn-danger" 
                                onclick="return confirm('Are you absolutely sure you want to delete this post? This action cannot be undone.')">
                            <i class="fas fa-trash me-1"></i>Delete Post Permanently
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 