<?php
// In a real application, this data would be fetched from a cryptocurrency API
$market_data = [
    [
        'id' => 'bitcoin',
        'symbol' => 'BTC',
        'name' => 'Bitcoin',
        'image' => 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png',
        'current_price' => 45632.10,
        'market_cap' => 864258741258,
        'market_cap_rank' => 1,
        'price_change_24h' => 2.5,
        'price_change_percentage_24h' => 2.5,
        'volume_24h' => 28541254125,
    ],
    [
        'id' => 'ethereum',
        'symbol' => 'ETH',
        'name' => 'Ethereum',
        'image' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png',
        'current_price' => 3278.45,
        'market_cap' => 382541254125,
        'market_cap_rank' => 2,
        'price_change_24h' => 58.45,
        'price_change_percentage_24h' => 1.8,
        'volume_24h' => 18541254125,
    ],
    [
        'id' => 'cardano',
        'symbol' => 'ADA',
        'name' => 'Cardano',
        'image' => 'https://assets.coingecko.com/coins/images/975/large/cardano.png',
        'current_price' => 1.92,
        'market_cap' => 62541254125,
        'market_cap_rank' => 3,
        'price_change_24h' => -0.014,
        'price_change_percentage_24h' => -0.7,
        'volume_24h' => 5541254125,
    ],
    [
        'id' => 'binancecoin',
        'symbol' => 'BNB',
        'name' => 'Binance Coin',
        'image' => 'https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png',
        'current_price' => 528.30,
        'market_cap' => 81541254125,
        'market_cap_rank' => 4,
        'price_change_24h' => 16.45,
        'price_change_percentage_24h' => 3.2,
        'volume_24h' => 3541254125,
    ],
    [
        'id' => 'solana',
        'symbol' => 'SOL',
        'name' => 'Solana',
        'image' => 'https://assets.coingecko.com/coins/images/4128/large/solana.png',
        'current_price' => 102.15,
        'market_cap' => 32541254125,
        'market_cap_rank' => 5,
        'price_change_24h' => -2.35,
        'price_change_percentage_24h' => -2.3,
        'volume_24h' => 2541254125,
    ],
    [
        'id' => 'ripple',
        'symbol' => 'XRP',
        'name' => 'XRP',
        'image' => 'https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png',
        'current_price' => 0.75,
        'market_cap' => 28541254125,
        'market_cap_rank' => 6,
        'price_change_24h' => 0.015,
        'price_change_percentage_24h' => 2.0,
        'volume_24h' => 2141254125,
    ],
    [
        'id' => 'polkadot',
        'symbol' => 'DOT',
        'name' => 'Polkadot',
        'image' => 'https://assets.coingecko.com/coins/images/12171/large/polkadot.png',
        'current_price' => 27.85,
        'market_cap' => 25541254125,
        'market_cap_rank' => 7,
        'price_change_24h' => 0.85,
        'price_change_percentage_24h' => 3.1,
        'volume_24h' => 1541254125,
    ],
    [
        'id' => 'dogecoin',
        'symbol' => 'DOGE',
        'name' => 'Dogecoin',
        'image' => 'https://assets.coingecko.com/coins/images/5/large/dogecoin.png',
        'current_price' => 0.25,
        'market_cap' => 20541254125,
        'market_cap_rank' => 8,
        'price_change_24h' => -0.005,
        'price_change_percentage_24h' => -2.1,
        'volume_24h' => 1341254125,
    ],
    [
        'id' => 'avalanche',
        'symbol' => 'AVAX',
        'name' => 'Avalanche',
        'image' => 'https://assets.coingecko.com/coins/images/12559/large/Avalanche_Circle_RedWhite_Trans.png',
        'current_price' => 85.45,
        'market_cap' => 18541254125,
        'market_cap_rank' => 9,
        'price_change_24h' => 2.15,
        'price_change_percentage_24h' => 2.5,
        'volume_24h' => 1241254125,
    ],
    [
        'id' => 'chainlink',
        'symbol' => 'LINK',
        'name' => 'Chainlink',
        'image' => 'https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png',
        'current_price' => 28.75,
        'market_cap' => 15541254125,
        'market_cap_rank' => 10,
        'price_change_24h' => 0.55,
        'price_change_percentage_24h' => 1.9,
        'volume_24h' => 1141254125,
    ],
];

// Helper function to format large numbers
function formatNumber($number) {
    if ($number >= 1000000000) {
        return '$' . number_format($number / 1000000000, 2) . 'B';
    } elseif ($number >= 1000000) {
        return '$' . number_format($number / 1000000, 2) . 'M';
    } elseif ($number >= 1000) {
        return '$' . number_format($number / 1000, 2) . 'K';
    } else {
        return '$' . number_format($number, 2);
    }
}

// Helper function to format price
function formatPrice($price) {
    if ($price < 1) {
        return '$' . number_format($price, 4);
    } else {
        return '$' . number_format($price, 2);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Data - CryptoExchange</title>
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
        
        .market-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 40px 0;
        }

        .market-table th, .market-table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .market-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #666;
        }

        .market-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .coin-info {
            display: flex;
            align-items: center;
        }

        .coin-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .coin-name {
            font-weight: 500;
        }

        .coin-symbol {
            color: #666;
            margin-left: 5px;
        }

        .positive {
            color: #00c853;
        }

        .negative {
            color: #ff3d00;
        }

        .market-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
            font-size: 14px;
            outline: none;
        }

        .search-bar:focus {
            border-color: #3861fb;
            box-shadow: 0 0 0 2px rgba(56, 97, 251, 0.1);
        }

        .sort-options {
            display: flex;
            gap: 10px;
        }

        .sort-btn {
            padding: 8px 15px;
            border: 1px solid #ddd;
            background-color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .sort-btn:hover, .sort-btn.active {
            background-color: #3861fb;
            color: white;
            border-color: #3861fb;
        }

        .page-title {
            margin: 40px 0 20px;
            font-size: 2rem;
            color: #222;
        }

        .page-subtitle {
            color: #666;
            margin-bottom: 30px;
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
                    <li class="active"><a href="market.php">Market</a></li>
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
            <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
        </div>
    </header>

    <main class="container">
        <h1 class="page-title">Cryptocurrency Market</h1>
        <p class="page-subtitle">Track and analyze digital currencies in real-time.</p>
        
        <div class="market-filters">
            <input type="text" class="search-bar" placeholder="Search for a cryptocurrency...">
            <div class="sort-options">
                <button class="sort-btn active">Market Cap</button>
                <button class="sort-btn">Volume</button>
                <button class="sort-btn">Price Change</button>
            </div>
        </div>

        <table class="market-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>24h %</th>
                    <th>Market Cap</th>
                    <th>Volume (24h)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($market_data as $coin): ?>
                    <tr>
                        <td><?php echo $coin['market_cap_rank']; ?></td>
                        <td>
                            <div class="coin-info">
                                <img src="<?php echo $coin['image']; ?>" alt="<?php echo $coin['name']; ?>" class="coin-icon">
                                <span class="coin-name"><?php echo $coin['name']; ?></span>
                                <span class="coin-symbol"><?php echo $coin['symbol']; ?></span>
                            </div>
                        </td>
                        <td><?php echo formatPrice($coin['current_price']); ?></td>
                        <td class="<?php echo $coin['price_change_percentage_24h'] >= 0 ? 'positive' : 'negative'; ?>">
                            <?php echo ($coin['price_change_percentage_24h'] >= 0 ? '+' : '') . number_format($coin['price_change_percentage_24h'], 2); ?>%
                        </td>
                        <td><?php echo formatNumber($coin['market_cap']); ?></td>
                        <td><?php echo formatNumber($coin['volume_24h']); ?></td>
                        <td>
                            <a href="trade.php?coin=<?php echo $coin['id']; ?>" class="btn btn-primary">Trade</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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