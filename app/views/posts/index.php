<?php $pageTitle = 'My Blog'; ?>

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
                <a href="/create" class="btn btn-primary">
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
                            <a href="/view?id=<?php echo $post['id']; ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <a href="/edit?id=<?php echo $post['id']; ?>" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="/delete?id=<?php echo $post['id']; ?>" class="btn btn-outline-danger btn-sm" 
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