<?php
// Include config file
require_once "config.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Get user ID from session
$user_id = $_SESSION["id"];

// Set default user data since we're using mock data
$user = [
    "id" => $user_id,
    "name" => isset($_SESSION["name"]) ? $_SESSION["name"] : "Demo User",
    "email" => isset($_SESSION["email"]) ? $_SESSION["email"] : "user@example.com",
    "wallet_balance" => 5000.00
];

// Get user portfolio using the mock data function
$portfolio = get_user_portfolio($conn, $user_id);

// Calculate total portfolio value
$total_portfolio_value = 0;
foreach ($portfolio as $asset) {
    $total_portfolio_value += $asset['value_usd'];
}

// Get user transactions using the mock data function
$transactions = get_transaction_history($conn, $user_id);
// Limit to 10 transactions
$transactions = array_slice($transactions, 0, 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wallet - CryptoExchange</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <style>
        .wallet-container {
            display: flex;
            gap: 30px;
            margin: 40px 0;
        }
        
        .wallet-sidebar {
            flex: 1;
        }
        
        .wallet-main {
            flex: 3;
        }
        
        .wallet-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .wallet-card h3 {
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .wallet-balance {
            text-align: center;
            padding: 20px 0;
        }
        
        .balance-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .balance-amount {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .wallet-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        
        .wallet-btn {
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .wallet-btn:hover {
            background-color: #eaecef;
        }
        
        .wallet-btn.deposit {
            background-color: #00c853;
            color: white;
            border-color: #00c853;
        }
        
        .wallet-btn.deposit:hover {
            background-color: #00a844;
        }
        
        .wallet-btn.withdraw {
            background-color: #ff3d00;
            color: white;
            border-color: #ff3d00;
        }
        
        .wallet-btn.withdraw:hover {
            background-color: #dd3500;
        }
        
        .portfolio-table, .transaction-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .portfolio-table th, .portfolio-table td,
        .transaction-table th, .transaction-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .portfolio-table th, .transaction-table th {
            color: #666;
            font-weight: 500;
        }
        
        .coin-info {
            display: flex;
            align-items: center;
        }
        
        .coin-name {
            font-weight: 500;
        }
        
        .coin-symbol {
            color: #666;
            margin-left: 5px;
        }
        
        .transaction-type {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        
        .transaction-buy {
            background-color: #e6f7ee;
            color: #00a844;
        }
        
        .transaction-sell {
            background-color: #ffebee;
            color: #dd3500;
        }
        
        .tab-container {
            margin-bottom: 20px;
        }
        
        .tab-buttons {
            display: flex;
            border-bottom: 1px solid #eee;
        }
        
        .tab-button {
            padding: 15px 30px;
            cursor: pointer;
            background: none;
            border: none;
            font-weight: 500;
            position: relative;
            color: #666;
        }
        
        .tab-button.active {
            color: #3861fb;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #3861fb;
        }
        
        .tab-content {
            display: none;
            padding: 20px 0;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .view-all {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
            color: #333;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .view-all:hover {
            background-color: #eaecef;
        }
        
        .user-info {
            margin-bottom: 10px;
            color: #666;
        }
        
        .user-name {
            font-weight: 500;
            color: #333;
        }
        
        .portfolio-summary {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .portfolio-total {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
        }
    </style>
    <script>
        // Simple JavaScript for tab switching
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    // Add active class to current button and content
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>CryptoExchange</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="market.php">Market</a></li>
                    <li><a href="exchange.php">Exchange</a></li>
                    <li><a href="wallet.php">Wallet</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION["email"]); ?></span>
                    <a href="logout.php" class="btn btn-login">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="register.php" class="btn btn-register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container">
        <h1 class="page-title">My Wallet</h1>
        <p class="user-info">Welcome, <span class="user-name"><?php echo htmlspecialchars($user["name"]); ?></span></p>
        
        <div class="wallet-container">
            <div class="wallet-sidebar">
                <div class="wallet-card">
                    <h3>USD Balance</h3>
                    <div class="wallet-balance">
                        <div class="balance-label">Available Balance</div>
                        <div class="balance-amount">$<?php echo number_format($user["wallet_balance"], 2); ?></div>
                    </div>
                    <div class="wallet-actions">
                        <button class="wallet-btn deposit">Deposit</button>
                        <button class="wallet-btn withdraw">Withdraw</button>
                    </div>
                </div>
                
                <div class="wallet-card">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="market.php">View Market</a></li>
                        <li><a href="exchange.php">Trade Cryptocurrencies</a></li>
                        <li><a href="#">Transaction History</a></li>
                        <li><a href="#">Account Settings</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="wallet-main">
                <div class="wallet-card">
                    <div class="tab-container">
                        <div class="tab-buttons">
                            <button class="tab-button active" data-tab="portfolio">Portfolio</button>
                            <button class="tab-button" data-tab="transactions">Transactions</button>
                        </div>
                        
                        <div id="portfolio" class="tab-content active">
                            <div class="portfolio-summary">
                                <div class="portfolio-total">Total Portfolio Value: $<?php echo number_format($total_portfolio_value, 2); ?></div>
                            </div>
                            
                            <?php if(empty($portfolio)): ?>
                                <p>You don't have any cryptocurrencies yet. <a href="exchange.php">Start trading</a> to build your portfolio.</p>
                            <?php else: ?>
                                <table class="portfolio-table">
                                    <thead>
                                        <tr>
                                            <th>Asset</th>
                                            <th>Balance</th>
                                            <th>Price</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($portfolio as $asset): ?>
                                            <tr>
                                                <td>
                                                    <div class="coin-info">
                                                        <span class="coin-name"><?php echo htmlspecialchars($asset['crypto_name']); ?></span>
                                                        <span class="coin-symbol"><?php echo htmlspecialchars($asset['symbol']); ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo number_format($asset['balance'], 8); ?></td>
                                                <td>$<?php echo number_format($asset['current_price'], 2); ?></td>
                                                <td>$<?php echo number_format($asset['value_usd'], 2); ?></td>
                                                <td>
                                                    <a href="exchange.php?coin=<?php echo htmlspecialchars($asset['symbol']); ?>" class="btn btn-primary">Trade</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        
                        <div id="transactions" class="tab-content">
                            <?php if(empty($transactions)): ?>
                                <p>No transactions found. <a href="exchange.php">Start trading</a> to see your transaction history.</p>
                            <?php else: ?>
                                <table class="transaction-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Asset</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $transaction): ?>
                                            <tr>
                                                <td>
                                                <?php 
                                                    // Check if transaction_date is a valid date string
                                                    $date_display = "";
                                                    if (isset($transaction['transaction_date'])) {
                                                        try {
                                                            $date_display = date('M d, Y H:i', strtotime($transaction['transaction_date']));
                                                        } catch (Exception $e) {
                                                            $date_display = "N/A";
                                                        }
                                                    } else {
                                                        $date_display = "N/A";
                                                    }
                                                    echo $date_display;
                                                ?>
                                                </td>
                                                <td>
                                                    <span class="transaction-type transaction-<?php echo htmlspecialchars($transaction['type']); ?>">
                                                        <?php echo ucfirst(htmlspecialchars($transaction['type'])); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="coin-info">
                                                        <span class="coin-name"><?php echo htmlspecialchars($transaction['crypto_name']); ?></span>
                                                        <span class="coin-symbol"><?php echo htmlspecialchars($transaction['symbol']); ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo number_format($transaction['amount'], 8); ?></td>
                                                <td>$<?php echo number_format($transaction['price'], 2); ?></td>
                                                <td>$<?php echo number_format($transaction['total'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <a href="#" class="view-all">View All Transactions</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>CryptoExchange</h3>
                    <p>Your trusted partner for cryptocurrency trading.</p>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="fees.php">Fees</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="blog.php">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="terms.php">Terms of Service</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Connect With Us</h3>
                    <div class="social-links">
                        <a href="#">Twitter</a>
                        <a href="#">Telegram</a>
                        <a href="#">Facebook</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> CryptoExchange. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html> 