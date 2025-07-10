<?php 

$db_name = 'blog_db';
$db_user = 'blog_user';
$db_pass = 'LittleTimmy';
$db_host = 'localhost';
$db_port = '3306';  

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};";

$admin_username = 'admin';
$admin_password = 'admin123';
$admin_email = 'admin@example.com';

$blog_title = 'My Blog';
$blog_url = 'http://blog.local';

$hash = password_hash($admin_password, PASSWORD_BCRYPT);
try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
  /*  $pdo->exec("CREATE DATABASE IF NOT EXISTS {$db_name}");
    $pdo->exec("USE {$db_name}");

    // Create the users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");*/

    // Insert the admin user
    $stmt = $pdo->prepare("INSERT INTO users (username, pass_hash, email, created_at, role) VALUES (:username, :password, :email, :created_at, :role)");
    $stmt->execute([':username' => $admin_username, ':password' => $hash, ':email' => $admin_email, ':created_at' => date('Y-m-d H:i:s'), ':role' => 0]);

    // Create Options table
  /*  $pdo->exec("CREATE TABLE IF NOT EXISTS options (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(256) NOT NULL UNIQUE,
        value TEXT NOT NULL,
        
    )"); */
    // Insert default options
    $stmt = $pdo->prepare("INSERT INTO options (name, value) VALUES (:name, :value) ON DUPLICATE KEY UPDATE value = :value");
    $stmt->execute([
        ':name' => 'blog_title',
        ':value' => $blog_title
    ]);
    $stmt->execute([
        ':name' => 'blog_url',
        ':value' => $blog_url
    ]);

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}