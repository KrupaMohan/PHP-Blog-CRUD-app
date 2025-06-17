-- PHP Blog Project Database Setup
-- Run this file in your MySQL client to set up the database

-- Create the database
CREATE DATABASE IF NOT EXISTS blog_db;
USE blog_db;

-- Create the posts table
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data (optional)
INSERT INTO posts (title, content, author) VALUES 
('Welcome to My Blog', 'This is my first blog post! I am excited to share my thoughts and experiences with you. Stay tuned for more content coming soon.', 'John Doe'),
('Getting Started with PHP', 'PHP is a powerful server-side scripting language that is widely used for web development. In this post, I will share some basic concepts and tips for beginners.', 'Jane Smith'),
('The Power of Bootstrap', 'Bootstrap is a popular CSS framework that makes it easy to create responsive and modern web designs. Let me show you some of its key features and how to use them effectively.', 'Mike Johnson');

-- Show the created table structure
DESCRIBE posts;

-- Show sample data
SELECT * FROM posts; 