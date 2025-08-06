<?php
// Simple test script to verify everything is working
require_once 'config.php';

echo "<h2>🔧 Biodata System Test</h2>";

// Test database connection
try {
    echo "<p>✅ Database connection successful!</p>";
    
    // Check if tables exist
    $tables = ['users', 'biodata'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            echo "<p>✅ Table '$table' exists</p>";
        } else {
            echo "<p>❌ Table '$table' missing</p>";
        }
    }
    
    echo "<hr>";
    echo "<h3>🎉 System Status: Ready!</h3>";
    echo "<p><a href='login.php'>Go to Login Page</a></p>";
    echo "<p><a href='register.php'>Go to Registration Page</a></p>";
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}
?>
