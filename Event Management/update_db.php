<?php
// Database connection parameters
require_once 'config.php';

try {
    // Add is_premium column to events table if it doesn't exist
    $sql = "SHOW COLUMNS FROM events LIKE 'is_premium'";
    $result = $pdo->query($sql);
    
    if ($result->rowCount() == 0) {
        // Column doesn't exist, add it
        $sql = "ALTER TABLE events ADD COLUMN is_premium TINYINT(1) DEFAULT 0";
        $pdo->exec($sql);
        echo "Added is_premium column to events table.<br>";
    } else {
        echo "is_premium column already exists in events table.<br>";
    }
    
    echo "Database schema update completed.<br>";
    echo "<a href='organizer_dashboard.php'>Go to Dashboard</a>";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?> 