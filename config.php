<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'crypto_user');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'crypto_exchange');

// Attempt to connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect to database. " . $conn->connect_error);
}

// Function to sanitize inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to execute a stored procedure for trading
function execute_trade($conn, $user_id, $crypto_id, $type, $amount, $price) {
    $stmt = $conn->prepare("CALL execute_trade(?, ?, ?, ?, ?)");
    $stmt->bind_param("iisdd", $user_id, $crypto_id, $type, $amount, $price);
    
    try {
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Function to get user portfolio
function get_user_portfolio($conn, $user_id) {
    $portfolio = [];
    
    $sql = "SELECT * FROM user_portfolio WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $portfolio[] = $row;
    }
    
    return $portfolio;
}

// Function to get user transaction history
function get_transaction_history($conn, $user_id) {
    $transactions = [];
    
    $sql = "SELECT * FROM transaction_history WHERE user_id = ? ORDER BY transaction_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    
    return $transactions;
}

// Function to get cryptocurrency information
function get_cryptocurrency($conn, $crypto_id) {
    $sql = "SELECT * FROM cryptocurrencies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $crypto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

// Function to get all cryptocurrencies
function get_all_cryptocurrencies($conn) {
    $cryptocurrencies = [];
    
    $sql = "SELECT * FROM cryptocurrencies ORDER BY market_cap DESC";
    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        $cryptocurrencies[] = $row;
    }
    
    return $cryptocurrencies;
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?> 