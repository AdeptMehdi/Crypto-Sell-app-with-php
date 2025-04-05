<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
        'price' => 98.75,
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
        $message = '<div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded mb-4">Please enter a valid amount.</div>';
    } else {
        if ($action === 'buy') {
            $message = '<div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded mb-4">Successfully purchased ' . $amount . ' ' . $selected_coin['symbol'] . ' for $' . number_format($total, 2) . '</div>';
        } else if ($action === 'sell') {
            $message = '<div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded mb-4">Successfully sold ' . $amount . ' ' . $selected_coin['symbol'] . ' for $' . number_format($total, 2) . '</div>';
        }
    }
}

// Helper function to format price
function formatPrice($price) {
    if ($price < 0.01) {
        return number_format($price, 6);
    } elseif ($price < 1) {
        return number_format($price, 4);
    } elseif ($price < 10) {
        return number_format($price, 2);
    } else {
        return number_format($price, 0);
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange - CryptoExchange</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'gradient': 'gradient 8s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'spin-slow': 'spin 20s linear infinite',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .text-gradient {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-500;
            }
            .bg-gradient {
                @apply bg-gradient-to-r from-purple-600 to-blue-500;
            }
            .animated-bg {
                background: linear-gradient(45deg, #1a1a2e, #16213e, #0f3460, #1a1a2e);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
            }
            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .particle {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                animation: float 6s ease-in-out infinite;
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-gray-900/80 backdrop-blur-lg border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <img src="CryptoExchange_logo.png" alt="CryptoExchange Logo" class="h-8 w-auto">
                    <span class="ml-2 text-xl font-bold text-gradient">CryptoExchange</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                        <a href="market.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Market</a>
                        <a href="exchange.php" class="bg-purple-500/20 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Exchange</a>
                        <a href="wallet.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Wallet</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                        <a href="logout.php" class="text-gray-300 hover:text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Logout</a>
                        <span class="text-gray-300 px-4 py-2 rounded-md text-sm font-medium"><?php echo htmlspecialchars($_SESSION["name"]); ?></span>
                    <?php else: ?>
                        <a href="login.php" class="text-gray-300 hover:text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                        <a href="register.php" class="bg-gradient text-white px-4 py-2 rounded-md text-sm font-medium hover:opacity-90 transition-opacity">Register</a>
                    <?php endif; ?>
                </div>
                <div class="md:hidden">
                    <button type="button" class="text-gray-400 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Exchange Section with Animated Background -->
    <section class="pt-32 pb-20 relative overflow-hidden animated-bg">
        <!-- Animated Particles -->
        <div id="particles" class="absolute inset-0 overflow-hidden"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 text-gradient animate-gradient">
                    Cryptocurrency Exchange
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Buy and sell cryptocurrencies with ease. Fast, secure, and reliable trading platform.
                </p>
            </div>
            
            <!-- Exchange Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition-colors">
                    <div class="text-4xl font-bold text-purple-500 mb-2">24/7</div>
                    <div class="text-gray-400">Trading Available</div>
                </div>
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition-colors">
                    <div class="text-4xl font-bold text-purple-500 mb-2">0.1%</div>
                    <div class="text-gray-400">Lowest Fees</div>
                </div>
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition-colors">
                    <div class="text-4xl font-bold text-purple-500 mb-2">150+</div>
                    <div class="text-gray-400">Trading Pairs</div>
                </div>
            </div>
            
            <!-- Exchange Form -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Coin Selection -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                        <h2 class="text-xl font-bold mb-4 text-gradient">Select Cryptocurrency</h2>
                        <div class="space-y-2">
                            <?php foreach ($coins as $id => $coin): ?>
                                <a href="?coin=<?php echo $id; ?>" class="flex items-center p-3 rounded-lg <?php echo $id === $selected_coin_id ? 'bg-purple-500/20 border border-purple-500' : 'hover:bg-gray-700/50 border border-gray-700'; ?> transition-colors">
                                    <img src="<?php echo $coin['logo']; ?>" alt="<?php echo $coin['name']; ?>" class="w-8 h-8 mr-3">
                                    <div>
                                        <div class="font-medium"><?php echo $coin['name']; ?></div>
                                        <div class="text-gray-400 text-sm"><?php echo $coin['symbol']; ?></div>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <div class="font-medium">$<?php echo formatPrice($coin['price']); ?></div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Exchange Form -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                        <div class="flex items-center mb-6">
                            <img src="<?php echo $selected_coin['logo']; ?>" alt="<?php echo $selected_coin['name']; ?>" class="w-10 h-10 mr-3">
                            <div>
                                <h2 class="text-xl font-bold text-gradient"><?php echo $selected_coin['name']; ?> (<?php echo $selected_coin['symbol']; ?>)</h2>
                                <p class="text-gray-400">Current Price: $<?php echo formatPrice($selected_coin['price']); ?></p>
                            </div>
                        </div>
                        
                        <?php echo $message; ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Buy Form -->
                            <div class="bg-gray-700/30 p-6 rounded-xl border border-gray-600">
                                <h3 class="text-lg font-bold mb-4 text-green-400">Buy <?php echo $selected_coin['symbol']; ?></h3>
                                <form method="post" class="space-y-4">
                                    <input type="hidden" name="action" value="buy">
                                    <div>
                                        <label class="block text-gray-300 text-sm font-medium mb-2" for="buy-amount">Amount (<?php echo $selected_coin['symbol']; ?>)</label>
                                        <input type="number" name="amount" id="buy-amount" step="0.000001" min="0.000001" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-300 text-sm font-medium mb-2" for="buy-total">Total (USD)</label>
                                        <input type="number" name="total" id="buy-total" step="0.01" min="0.01" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" required>
                                    </div>
                                    <button type="submit" class="w-full bg-green-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-900">Buy Now</button>
                                </form>
                            </div>
                            
                            <!-- Sell Form -->
                            <div class="bg-gray-700/30 p-6 rounded-xl border border-gray-600">
                                <h3 class="text-lg font-bold mb-4 text-red-400">Sell <?php echo $selected_coin['symbol']; ?></h3>
                                <form method="post" class="space-y-4">
                                    <input type="hidden" name="action" value="sell">
                                    <div>
                                        <label class="block text-gray-300 text-sm font-medium mb-2" for="sell-amount">Amount (<?php echo $selected_coin['symbol']; ?>)</label>
                                        <input type="number" name="amount" id="sell-amount" step="0.000001" min="0.000001" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-300 text-sm font-medium mb-2" for="sell-total">Total (USD)</label>
                                        <input type="number" name="total" id="sell-total" step="0.01" min="0.01" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" required>
                                    </div>
                                    <button type="submit" class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-red-600 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900">Sell Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Exchange Chart Placeholder -->
            <div class="mt-12 bg-gray-800/50 p-8 rounded-xl border border-gray-700">
                <h2 class="text-2xl font-bold mb-6 text-gradient"><?php echo $selected_coin['name']; ?> Price Chart</h2>
                <div class="h-80 bg-gray-700/30 rounded-lg flex items-center justify-center">
                    <p class="text-gray-400">Interactive price chart would be displayed here</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="CryptoExchange_logo.png" alt="CryptoExchange Logo" class="h-8 w-auto">
                        <span class="ml-2 text-xl font-bold text-gradient">CryptoExchange</span>
                    </div>
                    <p class="text-gray-400">The most secure and reliable cryptocurrency exchange platform for trading digital assets.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Compliance</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> CryptoExchange. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('button');
            const mobileMenu = document.querySelector('.md\\:block');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Create animated particles for hero section
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random size between 5px and 20px
                const size = Math.random() * 15 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Random animation delay
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                // Random animation duration
                particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
                
                particlesContainer.appendChild(particle);
            }
            
            // Calculate total based on amount and price
            const buyAmountInput = document.getElementById('buy-amount');
            const buyTotalInput = document.getElementById('buy-total');
            const sellAmountInput = document.getElementById('sell-amount');
            const sellTotalInput = document.getElementById('sell-total');
            const price = <?php echo $selected_coin['price']; ?>;
            
            if (buyAmountInput && buyTotalInput) {
                buyAmountInput.addEventListener('input', function() {
                    buyTotalInput.value = (this.value * price).toFixed(2);
                });
                
                buyTotalInput.addEventListener('input', function() {
                    buyAmountInput.value = (this.value / price).toFixed(6);
                });
            }
            
            if (sellAmountInput && sellTotalInput) {
                sellAmountInput.addEventListener('input', function() {
                    sellTotalInput.value = (this.value * price).toFixed(2);
                });
                
                sellTotalInput.addEventListener('input', function() {
                    sellAmountInput.value = (this.value / price).toFixed(6);
                });
            }
        });
    </script>
</body>
</html> 