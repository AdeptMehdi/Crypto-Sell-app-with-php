<?php
// Include config file
require_once "config.php";

// Read SQL file
$sql_file = file_get_contents('crypto_exchange.sql');

// Split the SQL file into individual queries
$queries = explode(';', $sql_file);

// Execute each query
foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if ($conn->query($query) === FALSE) {
            // Ignore errors for existing tables/database
            echo "Error executing query: " . $conn->error . "<br>";
        } else {
            echo "Query executed successfully.<br>";
        }
    }
}

echo "Database setup completed!";
?> 