<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL without specifying a database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $dbname = 'event_management';
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    echo "Database created successfully or already exists.<br>";
    
    // Select the database
    $pdo->exec("USE `$dbname`");
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        user_type ENUM('user', 'organizer') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Users table created successfully.<br>";
    
    // Create events table
    $sql = "CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category VARCHAR(50) NOT NULL,
        event_type ENUM('In-Person', 'Virtual', 'Hybrid') NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE,
        start_time TIME NOT NULL,
        end_time TIME,
        location VARCHAR(255) NOT NULL,
        image_url VARCHAR(255),
        organizer_id INT NOT NULL,
        price VARCHAR(100),
        capacity INT,
        is_premium TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
    echo "Events table created successfully.<br>";
    
    // Create registrations table
    $sql = "CREATE TABLE IF NOT EXISTS registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        event_id INT NOT NULL,
        user_id INT NOT NULL,
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('confirmed', 'pending', 'cancelled') DEFAULT 'confirmed',
        FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY (event_id, user_id)
    )";
    
    $pdo->exec($sql);
    echo "Registrations table created successfully.<br>";
    
    echo "<p>Database setup completed successfully!</p>";
    echo "<p><a href='index.php'>Go to Homepage</a> | <a href='signup.php'>Go to Sign Up</a></p>";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?> 