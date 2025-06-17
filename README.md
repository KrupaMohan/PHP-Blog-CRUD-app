# PHP + MySQL Blog Project

A simple, modern blog application built with PHP, MySQL, and Bootstrap. This project demonstrates basic CRUD operations (Create, Read, Update, Delete) for blog posts with a clean, responsive user interface.

## Features

- ✅ **Add, View, Edit, and Delete** blog posts
- ✅ **Bootstrap 5** for modern, responsive styling
- ✅ **Clean routing** with separate files for each operation
- ✅ **MySQL database** for data storage
- ✅ **PDO** for secure database connections
- ✅ **Input validation** and error handling
- ✅ **Security features** (SQL injection prevention, XSS protection)
- ✅ **Font Awesome icons** for better UX
- ✅ **Well-commented code** for easy maintenance

## File Structure

```
PHPproj/
├── db.php          # Database connection and table creation
├── index.php       # Main page - displays all posts
├── create.php      # Create new blog posts
├── view.php        # View individual posts
├── edit.php        # Edit existing posts
├── delete.php      # Delete posts with confirmation
└── README.md       # This file
```

## Prerequisites

Before running this project, make sure you have:

1. **PHP** (version 7.4 or higher)
2. **MySQL** (version 5.7 or higher)
3. **Web server** (Apache, Nginx, or PHP built-in server)
4. **MySQL client** (for database setup)

## Installation & Setup

### 1. Database Setup

1. **Create MySQL database:**
   ```sql
   CREATE DATABASE blog_db;
   USE blog_db;
   ```

2. **The posts table will be created automatically** when you first access the application, but you can also create it manually:
   ```sql
   CREATE TABLE posts (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       content TEXT NOT NULL,
       author VARCHAR(100) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

### 2. Configure Database Connection

Edit `db.php` and update the database credentials:

```php
$host = 'localhost';        // Your MySQL host
$dbname = 'blog_db';        // Your database name
$username = 'root';         // Your MySQL username
$password = '';             // Your MySQL password
```

### 3. Start the Application

#### Option A: Using PHP Built-in Server
```bash
cd /path/to/your/project/public
php -S localhost:8000
```
Then visit: `http://localhost:8000`

#### Option B: Using Apache/Nginx
1. Point your web server's document root to the `public/` directory of this project.
   For Apache, in your VirtualHost or httpd.conf:
   ```apache
   DocumentRoot "/path/to/your/project/public"
   <Directory "/path/to/your/project/public">
       AllowOverride All
       Require all granted
   </Directory>
   ```
2. Configure your web server to serve PHP files.
3. Access via your web server URL.

## Usage

### Creating a New Post
1. Click "New Post" in the navigation
2. Fill in the title, author, and content
3. Click "Create Post"

### Viewing Posts
- **All posts**: Visit the home page (`index.php`)
- **Individual post**: Click "View" on any post card

### Editing a Post
1. Click "Edit" on any post
2. Modify the title, author, or content
3. Click "Update Post"

### Deleting a Post
1. Click "Delete" on any post
2. Confirm the deletion on the confirmation page
3. Click "Delete Post Permanently"

## Security Features

- **SQL Injection Prevention**: Uses PDO prepared statements
- **XSS Protection**: All output is escaped using `htmlspecialchars()`
- **Input Validation**: Server-side validation for all form inputs
- **Confirmation Dialogs**: JavaScript confirmations for destructive actions

## Database Schema

### Posts Table
| Column     | Type         | Description                    |
|------------|--------------|--------------------------------|
| id         | INT          | Primary key, auto-increment    |
| title      | VARCHAR(255) | Post title                     |
| content    | TEXT         | Post content                   |
| author     | VARCHAR(100) | Author name                    |
| created_at | TIMESTAMP    | Creation timestamp             |
| updated_at | TIMESTAMP    | Last update timestamp          |

## Customization

### Styling
- The application uses Bootstrap 5 for styling
- Custom CSS can be added to any page's `<style>` section
- Font Awesome icons can be replaced or customized

### Database
- Modify the table structure in `db.php` if needed
- Add additional fields to the posts table
- Create additional tables for features like categories, tags, etc.

### Features
- Add user authentication
- Implement categories or tags
- Add image upload functionality
- Create an admin panel
- Add search functionality
- Implement pagination for large numbers of posts

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check your MySQL credentials in `db.php`
   - Ensure MySQL service is running
   - Verify the database exists

2. **Permission Errors**
   - Ensure your web server has read permissions for the project files
   - Check file ownership and permissions

3. **Page Not Found**
   - Verify your web server is configured to serve PHP files
   - Check that all files are in the correct directory

4. **Blank Pages**
   - Check PHP error logs
   - Enable error reporting in PHP for debugging

## Contributing

Feel free to fork this project and submit pull requests for improvements. Some areas for enhancement:

- Add user authentication
- Implement categories and tags
- Add image upload functionality
- Create an API for mobile apps
- Add search and filtering
- Implement pagination
