<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'crypto_exchange');

// Attempt to connect to MySQL database without selecting a database first
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// Check connection
if($conn === false){
    die("ERROR: Could not connect to database. " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === FALSE) {
    die("ERROR: Could not create database. " . $conn->error);
}

// Select the database
$conn->select_db(DB_NAME);

// Function to sanitize inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to execute a trade - simplified version
function execute_trade($conn, $user_id, $crypto_id, $type, $amount, $price) {
    // For demo purposes, just return success
    return true;
}

// Function to get user portfolio - simplified with mock data
function get_user_portfolio($conn, $user_id) {
    // Return mock data for demo purposes
    return [
        [
            'user_id' => $user_id,
            'user_name' => 'Demo User',
            'email' => 'user@example.com',
            'symbol' => 'BTC',
            'crypto_name' => 'Bitcoin',
            'balance' => 0.15,
            'current_price' => 45632.10,
            'value_usd' => 6844.82
        ],
        [
            'user_id' => $user_id,
            'user_name' => 'Demo User',
            'email' => 'user@example.com',
            'symbol' => 'ETH',
            'crypto_name' => 'Ethereum',
            'balance' => 2.0,
            'current_price' => 3278.45,
            'value_usd' => 6556.90
        ]
    ];
}

// Function to get user transaction history - simplified with mock data
function get_transaction_history($conn, $user_id) {
    // Return mock data for demo purposes
    return [
        [
            'transaction_id' => 1,
            'user_name' => 'Demo User',
            'symbol' => 'BTC',
            'crypto_name' => 'Bitcoin',
            'type' => 'buy',
            'amount' => 0.15,
            'price' => 44000.00,
            'total' => 6600.00,
            'fee' => 33.00,
            'transaction_date' => date('Y-m-d H:i:s', strtotime('-2 days'))
        ],
        [
            'transaction_id' => 2,
            'user_name' => 'Demo User',
            'symbol' => 'ETH',
            'crypto_name' => 'Ethereum',
            'type' => 'buy',
            'amount' => 2.5,
            'price' => 3100.00,
            'total' => 7750.00,
            'fee' => 38.75,
            'transaction_date' => date('Y-m-d H:i:s', strtotime('-1 day'))
        ],
        [
            'transaction_id' => 3,
            'user_name' => 'Demo User',
            'symbol' => 'ADA',
            'crypto_name' => 'Cardano',
            'type' => 'buy',
            'amount' => 1000,
            'price' => 1.80,
            'total' => 1800.00,
            'fee' => 9.00,
            'transaction_date' => date('Y-m-d H:i:s', strtotime('-3 days'))
        ],
        [
            'transaction_id' => 4,
            'user_name' => 'Demo User',
            'symbol' => 'ETH',
            'crypto_name' => 'Ethereum',
            'type' => 'sell',
            'amount' => 0.5,
            'price' => 3250.00,
            'total' => 1625.00,
            'fee' => 8.13,
            'transaction_date' => date('Y-m-d H:i:s', strtotime('-12 hours'))
        ]
    ];
}

// Function to get cryptocurrency information
function get_cryptocurrency($conn, $crypto_id) {
    // In a real app, this would query the database
    // For demo purposes, return mock data
    $cryptocurrencies = [
        1 => [
            'id' => 1,
            'symbol' => 'BTC',
            'name' => 'Bitcoin',
            'current_price' => 45632.10
        ],
        2 => [
            'id' => 2,
            'symbol' => 'ETH',
            'name' => 'Ethereum',
            'current_price' => 3278.45
        ]
    ];
    
    return isset($cryptocurrencies[$crypto_id]) ? $cryptocurrencies[$crypto_id] : null;
}

// Function to get all cryptocurrencies
function get_all_cryptocurrencies($conn) {
    // For demo purposes, return mock data
    return [
        [
            'id' => 1,
            'symbol' => 'BTC',
            'name' => 'Bitcoin',
            'current_price' => 45632.10,
            'market_cap' => 864258741258,
            'price_change_percentage_24h' => 2.5
        ],
        [
            'id' => 2,
            'symbol' => 'ETH',
            'name' => 'Ethereum',
            'current_price' => 3278.45,
            'market_cap' => 382541254125,
            'price_change_percentage_24h' => 1.8
        ]
    ];
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?> 