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
        /* New header styles */
        header {
            background: linear-gradient(to right, #ffffff, #f8f9ff);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0;
            transition: all 0.3s ease;
        }
        
        header .container {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        header .logo {
            display: flex;
            align-items: center;
            z-index: 101;
        }
        
        header .logo h1 {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: all 0.3s ease;
            letter-spacing: -0.5px;
            position: relative;
        }
        
        header .logo h1::before {
            content: '';
            position: absolute;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, rgba(56, 97, 251, 0.15), rgba(107, 75, 255, 0.15));
            border-radius: 50%;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: -1;
        }
        
        header nav {
            margin-left: auto;
            margin-right: 30px;
            transition: all 0.4s ease;
        }
        
        header nav ul {
            display: flex;
            gap: 10px;
            margin: 0;
            padding: 0;
        }
        
        header nav ul li {
            position: relative;
            list-style: none;
        }
        
        header nav ul li a {
            display: block;
            padding: 10px 16px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            position: relative;
            z-index: 1;
        }
        
        header nav ul li a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(to right, #3861fb, #6b4bff);
            transition: width 0.3s ease;
            border-radius: 3px;
            z-index: -1;
        }
        
        header nav ul li a:hover {
            color: #3861fb;
        }
        
        header nav ul li a:hover::before {
            width: 70%;
        }
        
        header nav ul li.active a::before {
            width: 70%;
        }
        
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 101;
        }
        
        .btn-login {
            padding: 8px 20px;
            border-radius: 30px;
            border: 1.5px solid #3861fb;
            color: #3861fb;
            font-weight: 500;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .btn-login:hover {
            background: rgba(56, 97, 251, 0.08);
            transform: translateY(-2px);
        }
        
        .btn-register {
            padding: 8px 20px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 97, 251, 0.25);
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 97, 251, 0.3);
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
            z-index: 101;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.3s ease;
            background: rgba(56, 97, 251, 0.08);
            position: relative;
        }
        
        .mobile-menu-btn:hover {
            background: rgba(56, 97, 251, 0.15);
            color: #3861fb;
        }
        
        /* Responsive header */
        @media (max-width: 991px) {
            header nav {
                margin-right: 20px;
            }
            
            header nav ul li a {
                padding: 10px 12px;
                font-size: 0.95rem;
            }
            
            .btn-login, .btn-register {
                padding: 7px 15px;
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 768px) {
            header {
                padding: 0;
            }
            
            header .container {
                padding: 15px 20px;
            }
            
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: 15px;
            }
            
            header nav {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                z-index: 100;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            
            header nav.show {
                transform: translateX(0);
            }
            
            header nav ul {
                flex-direction: column;
                align-items: center;
                gap: 20px;
                padding-top: 80px;
            }
            
            header nav ul li {
                width: 100%;
                text-align: center;
            }
            
            header nav ul li a {
                padding: 12px 25px;
                font-size: 1.2rem;
                width: 100%;
                max-width: 200px;
                margin: 0 auto;
            }
            
            header nav ul li a:hover::before {
                width: 50%;
            }
            
            .auth-buttons {
                gap: 10px;
            }
            
            .btn-login, .btn-register {
                padding: 7px 12px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            header .logo h1 {
                font-size: 1.5rem;
            }
            
            .auth-buttons {
                gap: 5px;
            }
            
            .btn-login, .btn-register {
                padding: 6px 10px;
                font-size: 0.85rem;
            }
        }
        
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
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .wallet-card h3 {
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .wallet-card ul {
            list-style: none;
            padding: 0;
        }
        
        .wallet-card ul li {
            margin-bottom: 15px;
        }
        
        .wallet-card ul li a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .wallet-card ul li a:hover {
            color: #3861fb;
        }
        
        .wallet-balance {
            text-align: center;
            padding: 20px 0;
        }
        
        .balance-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .balance-amount {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        
        .wallet-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .wallet-btn {
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        
        .wallet-btn.deposit {
            background-color: #00c853;
            color: white;
        }
        
        .wallet-btn.deposit:hover {
            background-color: #00a844;
            transform: translateY(-2px);
        }
        
        .wallet-btn.withdraw {
            background-color: #ff3d00;
            color: white;
        }
        
        .wallet-btn.withdraw:hover {
            background-color: #dd3500;
            transform: translateY(-2px);
        }
        
        .tab-container {
            width: 100%;
        }
        
        .tab-buttons {
            display: flex;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        
        .tab-button {
            padding: 15px 30px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            color: #666;
            position: relative;
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
        }
        
        .tab-content.active {
            display: block;
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
        
        .transaction-type {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .transaction-buy {
            background-color: rgba(0, 200, 83, 0.1);
            color: #00c853;
        }
        
        .transaction-sell {
            background-color: rgba(255, 61, 0, 0.1);
            color: #ff3d00;
        }
        
        .page-title {
            margin: 40px 0 10px;
            font-size: 2rem;
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
            // Tab switching
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
            <nav id="mainNav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="market.php">Market</a></li>
                    <li><a href="exchange.php">Exchange</a></li>
                    <li class="active"><a href="wallet.php">Wallet</a></li>
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
            <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
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

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mainNav = document.getElementById('mainNav');
            
            if (mobileMenuBtn && mainNav) {
                mobileMenuBtn.addEventListener('click', function() {
                    mainNav.classList.toggle('show');
                    mobileMenuBtn.textContent = mainNav.classList.contains('show') ? '✕' : '☰';
                });
            }
            
            // Close menu when clicking on a link
            const navLinks = document.querySelectorAll('#mainNav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        mainNav.classList.remove('show');
                        mobileMenuBtn.textContent = '☰';
                    }
                });
            });
        });
    </script>
</body>
</html> 