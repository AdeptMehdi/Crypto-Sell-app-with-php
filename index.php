<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Exchange</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
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
                <a href="login.php" class="btn btn-login">Login</a>
                <a href="register.php" class="btn btn-register">Register</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Buy, Sell & Trade Cryptocurrencies</h2>
                <p>Fast, secure, and reliable platform for cryptocurrency exchange</p>
                <a href="register.php" class="btn btn-primary">Get Started</a>
            </div>
            <div class="market-preview">
                <table>
                    <thead>
                        <tr>
                            <th>Coin</th>
                            <th>Price</th>
                            <th>24h Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Sample data - in a real app, this would come from an API
                        $coins = [
                            ['name' => 'Bitcoin (BTC)', 'price' => '$45,632.10', 'change' => '+2.5%', 'class' => 'positive'],
                            ['name' => 'Ethereum (ETH)', 'price' => '$3,278.45', 'change' => '+1.8%', 'class' => 'positive'],
                            ['name' => 'Cardano (ADA)', 'price' => '$1.92', 'change' => '-0.7%', 'class' => 'negative'],
                            ['name' => 'Binance Coin (BNB)', 'price' => '$528.30', 'change' => '+3.2%', 'class' => 'positive'],
                        ];

                        foreach ($coins as $coin) {
                            echo "<tr>";
                            echo "<td>{$coin['name']}</td>";
                            echo "<td>{$coin['price']}</td>";
                            echo "<td class='{$coin['class']}'>{$coin['change']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="market.php" class="view-all">View All Markets</a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Why Choose Our Exchange?</h2>
            <div class="feature-grid">
                <div class="feature">
                    <h3>Secure Storage</h3>
                    <p>Your funds are stored in cold wallets with multi-signature technology.</p>
                </div>
                <div class="feature">
                    <h3>Low Fees</h3>
                    <p>Enjoy competitive trading fees and zero deposit fees.</p>
                </div>
                <div class="feature">
                    <h3>24/7 Support</h3>
                    <p>Our customer support team is always ready to help you.</p>
                </div>
                <div class="feature">
                    <h3>Advanced Trading Tools</h3>
                    <p>Access real-time charts, market data, and trading indicators.</p>
                </div>
            </div>
        </div>
    </section>

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