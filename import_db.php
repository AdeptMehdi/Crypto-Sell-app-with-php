<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = ''; // Default WAMP password is empty
$database = 'crypto_exchange';

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql = file_get_contents('crypto_exchange.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    echo "Database and tables created successfully!";
    
    // Clear results
    while ($conn->more_results() && $conn->next_result()) {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    }
} else {
    echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();
?> 