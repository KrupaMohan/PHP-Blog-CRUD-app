<?php

require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../helpers/view_renderer.php'; // Include the new helper

/**
 * Post Controller
 * Handles requests related to blog posts, interacts with the PostModel, and loads views.
 */
class PostController {
    private $postModel;

    public function __construct(PostModel $postModel) {
        $this->postModel = $postModel;
    }

    /**
     * Displays a list of all blog posts.
     */
    public function index() {
        $posts = $this->postModel->getAllPosts();
        $message = '';
        $messageType = '';

        if (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
            $message = 'Post deleted successfully!';
            $messageType = 'success';
        }

        // Use the render helper function
        render('posts/index.php', ['posts' => $posts, 'message' => $message, 'messageType' => $messageType], 'My Blog');
    }

    /**
     * Displays the form for creating a new post and handles form submission.
     */
    public function create() {
        $message = '';
        $messageType = '';
        $title = '';
        $content = '';
        $author = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $author = trim($_POST['author'] ?? '');
            
            if (empty($title) || empty($content) || empty($author)) {
                $message = 'All fields are required!';
                $messageType = 'danger';
            } else {
                if ($this->postModel->createPost($title, $content, $author)) {
                    $message = 'Post created successfully!';
                    $messageType = 'success';
                    $title = $content = $author = ''; // Clear form
                } else {
                    $message = 'Error creating post.';
                    $messageType = 'danger';
                }
            }
        }
        // Use the render helper function
        render('posts/create.php', [
            'message' => $message,
            'messageType' => $messageType,
            'title' => $title,
            'content' => $content,
            'author' => $author
        ], 'Create New Post - My Blog');
    }

    /**
     * Displays a single blog post.
     * @param int $id The ID of the post.
     */
    public function view($id) {
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            header('Location: index.php'); // Redirect if post not found
            exit;
        }
        // Use the render helper function
        render('posts/view.php', ['post' => $post], htmlspecialchars($post['title']) . ' - My Blog', 
               '<style>
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
                </style>');
    }

    /**
     * Displays the form for editing an existing post and handles form submission.
     * @param int $id The ID of the post to edit.
     */
    public function edit($id) {
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            header('Location: index.php'); // Redirect if post not found
            exit;
        }

        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $author = trim($_POST['author'] ?? '');
            
            if (empty($title) || empty($content) || empty($author)) {
                $message = 'All fields are required!';
                $messageType = 'danger';
            } else {
                if ($this->postModel->updatePost($id, $title, $content, $author)) {
                    $message = 'Post updated successfully!';
                    $messageType = 'success';
                    // Update the local $post array to reflect changes immediately
                    $post['title'] = $title;
                    $post['content'] = $content;
                    $post['author'] = $author;
                    // Re-fetch updated_at if needed, or rely on client-side refresh for full accuracy
                } else {
                    $message = 'Error updating post.';
                    $messageType = 'danger';
                }
            }
        }
        // Use the render helper function
        render('posts/edit.php', [
            'post' => $post,
            'message' => $message,
            'messageType' => $messageType
        ], 'Edit Post - My Blog');
    }

    /**
     * Handles the deletion of a post.
     * @param int $id The ID of the post to delete.
     */
    public function delete($id) {
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            header('Location: index.php');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
            if ($this->postModel->deletePost($id)) {
                header('Location: index.php?deleted=1');
                exit;
            } else {
                $error = 'Error deleting post.';
            }
        }
        // Use the render helper function
        render('posts/delete.php', ['post' => $post, 'error' => $error], 'Delete Post - My Blog');
    }
} 