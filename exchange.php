<?php
// In a real application, these would be fetched from a database or API
$coins = [
    'bitcoin' => [
        'name' => 'Bitcoin',
        'symbol' => 'BTC',
        'price' => 45632.10,
        'logo' => 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png',
    ],
    'ethereum' => [
        'name' => 'Ethereum',
        'symbol' => 'ETH',
        'price' => 3278.45,
        'logo' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png',
    ],
    'cardano' => [
        'name' => 'Cardano',
        'symbol' => 'ADA',
        'price' => 1.92,
        'logo' => 'https://assets.coingecko.com/coins/images/975/large/cardano.png',
    ],
    'binancecoin' => [
        'name' => 'Binance Coin',
        'symbol' => 'BNB',
        'price' => 528.30,
        'logo' => 'https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png',
    ],
    'solana' => [
        'name' => 'Solana',
        'symbol' => 'SOL',
        'price' => 102.15,
        'logo' => 'https://assets.coingecko.com/coins/images/4128/large/solana.png',
    ],
];

// Get selected coin from URL or default to bitcoin
$selected_coin_id = isset($_GET['coin']) ? $_GET['coin'] : 'bitcoin';
$selected_coin = isset($coins[$selected_coin_id]) ? $coins[$selected_coin_id] : $coins['bitcoin'];

// Handle form submission (in a real app, this would connect to a payment gateway and update a database)
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
    
    if ($amount <= 0) {
        $message = '<div class="alert alert-error">Please enter a valid amount.</div>';
    } else {
        if ($action === 'buy') {
            $message = '<div class="alert alert-success">Successfully purchased ' . $amount . ' ' . $selected_coin['symbol'] . ' for $' . number_format($total, 2) . '.</div>';
        } else {
            $message = '<div class="alert alert-success">Successfully sold ' . $amount . ' ' . $selected_coin['symbol'] . ' for $' . number_format($total, 2) . '.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange - CryptoExchange</title>
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
        
        .exchange-container {
            display: flex;
            gap: 30px;
            margin: 40px 0;
        }
        
        .coin-selector {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        .coin-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .coin-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .coin-item:hover, .coin-item.active {
            background-color: #f0f5ff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .coin-item.active {
            border: 2px solid #3861fb;
        }
        
        .coin-logo {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
        }
        
        .coin-symbol {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .coin-price {
            font-size: 12px;
            color: #666;
        }
        
        .exchange-form {
            flex: 2;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3861fb;
            box-shadow: 0 0 0 2px rgba(56, 97, 251, 0.1);
            outline: none;
        }
        
        .exchange-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .tab {
            padding: 15px 30px;
            cursor: pointer;
            font-weight: 500;
            position: relative;
        }
        
        .tab.active {
            color: #3861fb;
        }
        
        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #3861fb;
        }
        
        .exchange-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn-buy {
            background-color: #00c853;
            color: white;
            border: none;
            flex: 1;
        }
        
        .btn-buy:hover {
            background-color: #00a844;
        }
        
        .btn-sell {
            background-color: #ff3d00;
            color: white;
            border: none;
            flex: 1;
        }
        
        .btn-sell:hover {
            background-color: #dd3500;
        }
        
        .selected-coin-info {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .selected-coin-logo {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        
        .selected-coin-details h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .selected-coin-price {
            color: #666;
        }
        
        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #e6f7ee;
            color: #00a844;
            border: 1px solid #b7e6c9;
        }
        
        .alert-error {
            background-color: #ffebee;
            color: #dd3500;
            border: 1px solid #ffcdd2;
        }

        .exchange-summary {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: 500;
        }
    </style>
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
                    <li class="active"><a href="exchange.php">Exchange</a></li>
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
            <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
        </div>
    </header>

    <main class="container">
        <h1 class="page-title">Exchange</h1>
        <p class="page-subtitle">Buy and sell cryptocurrencies easily with competitive rates.</p>
        
        <?php echo $message; ?>
        
        <div class="exchange-container">
            <div class="coin-selector">
                <h3>Select Currency</h3>
                <div class="coin-list">
                    <?php foreach ($coins as $id => $coin): ?>
                        <a href="?coin=<?php echo $id; ?>" class="coin-item <?php echo $id === $selected_coin_id ? 'active' : ''; ?>">
                            <img src="<?php echo $coin['logo']; ?>" alt="<?php echo $coin['name']; ?>" class="coin-logo">
                            <span class="coin-symbol"><?php echo $coin['symbol']; ?></span>
                            <span class="coin-price">$<?php echo number_format($coin['price'], 2); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="exchange-form">
                <div class="selected-coin-info">
                    <img src="<?php echo $selected_coin['logo']; ?>" alt="<?php echo $selected_coin['name']; ?>" class="selected-coin-logo">
                    <div class="selected-coin-details">
                        <h2><?php echo $selected_coin['name']; ?> (<?php echo $selected_coin['symbol']; ?>)</h2>
                        <span class="selected-coin-price">$<?php echo number_format($selected_coin['price'], 2); ?></span>
                    </div>
                </div>
                
                <div class="exchange-tabs">
                    <div class="tab active" data-tab="buy">Buy</div>
                    <div class="tab" data-tab="sell">Sell</div>
                </div>
                
                <form id="buyForm" method="post" action="exchange.php?coin=<?php echo $selected_coin_id; ?>">
                    <input type="hidden" name="action" value="buy">
                    
                    <div class="form-group">
                        <label for="amount">Amount (<?php echo $selected_coin['symbol']; ?>)</label>
                        <input type="number" id="amount" name="amount" class="form-control" step="0.0001" min="0.0001" placeholder="0.00" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="total">Total (USD)</label>
                        <input type="number" id="total" name="total" class="form-control" step="0.01" readonly>
                    </div>
                    
                    <div class="exchange-summary">
                        <div class="summary-item">
                            <span>Exchange Rate:</span>
                            <span>1 <?php echo $selected_coin['symbol']; ?> = $<?php echo number_format($selected_coin['price'], 2); ?></span>
                        </div>
                        <div class="summary-item">
                            <span>Transaction Fee (0.5%):</span>
                            <span id="fee">$0.00</span>
                        </div>
                        <div class="summary-total">
                            <span>Total:</span>
                            <span id="displayTotal">$0.00</span>
                        </div>
                    </div>
                    
                    <div class="exchange-actions">
                        <button type="submit" class="btn btn-buy">Buy <?php echo $selected_coin['symbol']; ?></button>
                        <button type="submit" class="btn btn-sell" style="display:none;">Sell <?php echo $selected_coin['symbol']; ?></button>
                    </div>
                </form>
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
        // Simple JavaScript for the exchange form
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const totalInput = document.getElementById('total');
            const feeDisplay = document.getElementById('fee');
            const totalDisplay = document.getElementById('displayTotal');
            const coinPrice = <?php echo $selected_coin['price']; ?>;
            const tabs = document.querySelectorAll('.tab');
            const actionInput = document.querySelector('input[name="action"]');
            const buyButton = document.querySelector('.btn-buy');
            const sellButton = document.querySelector('.btn-sell');
            
            // Calculate total when amount changes
            amountInput.addEventListener('input', calculateTotal);
            
            function calculateTotal() {
                const amount = parseFloat(amountInput.value) || 0;
                const subtotal = amount * coinPrice;
                const fee = subtotal * 0.005; // 0.5% fee
                const total = subtotal + fee;
                
                totalInput.value = total.toFixed(2);
                feeDisplay.textContent = '$' + fee.toFixed(2);
                totalDisplay.textContent = '$' + total.toFixed(2);
            }
            
            // Tab switching
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    const action = this.getAttribute('data-tab');
                    actionInput.value = action;
                    
                    if (action === 'buy') {
                        buyButton.style.display = 'block';
                        sellButton.style.display = 'none';
                    } else {
                        buyButton.style.display = 'none';
                        sellButton.style.display = 'block';
                    }
                });
            });
            
            // Mobile menu toggle
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