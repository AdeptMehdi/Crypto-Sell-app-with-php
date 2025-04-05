<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoExchange - Modern Cryptocurrency Trading Platform</title>
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
                        <a href="exchange.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Exchange</a>
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

    <!-- Hero Section with Animated Background -->
    <section class="pt-32 pb-20 relative overflow-hidden animated-bg">
        <!-- Animated Particles -->
        <div id="particles" class="absolute inset-0 overflow-hidden"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 text-gradient animate-gradient">
                    The Future of Digital Finance
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Trade cryptocurrencies with confidence on our secure, fast, and reliable platform. Join millions of users worldwide who trust us for their digital assets.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="register.php" class="bg-gradient text-white px-8 py-3 rounded-lg text-lg font-semibold hover:opacity-90 transition-opacity">
                        Get Started
                    </a>
                    <a href="market.php" class="border border-purple-500 text-purple-500 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-purple-500/10 transition-colors">
                        Explore Markets
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-purple-500 transition-colors group">
                    <div class="w-12 h-12 bg-gradient rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Secure Trading</h3>
                    <p class="text-gray-400">Your assets are protected with state-of-the-art security measures and encryption.</p>
                </div>
                <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-purple-500 transition-colors group">
                    <div class="w-12 h-12 bg-gradient rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Low Fees</h3>
                    <p class="text-gray-400">Enjoy competitive trading fees and zero deposit fees on most cryptocurrencies.</p>
                </div>
                <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-purple-500 transition-colors group">
                    <div class="w-12 h-12 bg-gradient rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">24/7 Support</h3>
                    <p class="text-gray-400">Our dedicated support team is available around the clock to assist you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Overview Section -->
    <section class="py-20 bg-gray-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gradient">Market Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                    <div class="text-4xl font-bold text-purple-500 mb-2">$4.2B+</div>
                    <div class="text-gray-400">Trading Volume</div>
                </div>
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                    <div class="text-4xl font-bold text-purple-500 mb-2">150+</div>
                    <div class="text-gray-400">Cryptocurrencies</div>
                </div>
                <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                    <div class="text-4xl font-bold text-purple-500 mb-2">2.5M+</div>
                    <div class="text-gray-400">Active Users</div>
                </div>
            </div>
            <div class="bg-gray-800/50 rounded-xl border border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Coin</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">24h Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $coins = [
                                ['name' => 'Bitcoin (BTC)', 'price' => '45,632.10', 'change' => '+2.5%', 'class' => 'text-green-500'],
                                ['name' => 'Ethereum (ETH)', 'price' => '3,278.45', 'change' => '+1.8%', 'class' => 'text-green-500'],
                                ['name' => 'Cardano (ADA)', 'price' => '1.92', 'change' => '-0.7%', 'class' => 'text-red-500'],
                                ['name' => 'Binance Coin (BNB)', 'price' => '528.30', 'change' => '+3.2%', 'class' => 'text-green-500'],
                                ['name' => 'Solana (SOL)', 'price' => '98.75', 'change' => '+5.1%', 'class' => 'text-green-500'],
                                ['name' => 'Polkadot (DOT)', 'price' => '18.42', 'change' => '-1.3%', 'class' => 'text-red-500'],
                            ];

                            foreach ($coins as $coin) {
                                echo "<tr class='border-b border-gray-700 hover:bg-gray-700/50 transition-colors'>";
                                echo "<td class='px-6 py-4'><div class='flex items-center'><div class='w-8 h-8 bg-gradient rounded-full flex items-center justify-center mr-3'>" . substr($coin['name'], 0, 1) . "</div>{$coin['name']}</div></td>";
                                echo "<td class='px-6 py-4'>\${$coin['price']}</td>";
                                echo "<td class='px-6 py-4 {$coin['class']}'>{$coin['change']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
        });
    </script>
</body>
</html> 