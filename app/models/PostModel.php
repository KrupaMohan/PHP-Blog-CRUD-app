<?php

/**
 * Post Model
 * Handles all database operations related to blog posts.
 */

class PostModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Fetches all blog posts from the database, ordered by creation date.
     * @return array An array of post data.
     */
    public function getAllPosts() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // In a real application, you'd log this error and show a user-friendly message.
            die("Error fetching posts: " . $e->getMessage());
        }
    }

    /**
     * Fetches a single blog post by its ID.
     * @param int $id The ID of the post to fetch.
     * @return array|false The post data as an associative array, or false if not found.
     */
    public function getPostById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            die("Error fetching post: " . $e->getMessage());
        }
    }

    /**
     * Creates a new blog post.
     * @param string $title The title of the post.
     * @param string $content The content of the post.
     * @param string $author The author of the post.
     * @return bool True on success, false on failure.
     */
    public function createPost($title, $content, $author) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)");
            return $stmt->execute([$title, $content, $author]);
        } catch (PDOException $e) {
            die("Error creating post: " . $e->getMessage());
        }
    }

    /**
     * Updates an existing blog post.
     * @param int $id The ID of the post to update.
     * @param string $title The new title of the post.
     * @param string $content The new content of the post.
     * @param string $author The new author of the post.
     * @return bool True on success, false on failure.
     */
    public function updatePost($id, $title, $content, $author) {
        try {
            $stmt = $this->pdo->prepare("UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?");
            return $stmt->execute([$title, $content, $author, $id]);
        } catch (PDOException $e) {
            die("Error updating post: " . $e->getMessage());
        }
    }

    /**
     * Deletes a blog post by its ID.
     * @param int $id The ID of the post to delete.
     * @return bool True on success, false on failure.
     */
    public function deletePost($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error deleting post: " . $e->getMessage());
        }
    }
} 