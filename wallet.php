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
    "username" => isset($_SESSION["name"]) ? $_SESSION["name"] : "Demo User",
    "email" => isset($_SESSION["name"]) ? $_SESSION["name"] . "@example.com" : "user@example.com",
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
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wallet - CryptoExchange</title>
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
                        <a href="wallet.php" class="text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Wallet</a>
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
                    Your Crypto Wallet
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Manage your digital assets and track your portfolio in one place
                </p>
            </div>
        </div>
    </section>

    <!-- Wallet Content -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Balance Card -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-6 border border-gray-700/50">
                        <h2 class="text-xl font-semibold mb-4">Available Balance</h2>
                        <div class="text-3xl font-bold text-blue-400 mb-6">$<?php echo number_format($user["wallet_balance"], 2); ?></div>
                        <div class="flex gap-4">
                            <button class="flex-1 bg-gradient text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
                                Deposit
                            </button>
                            <button class="flex-1 border border-purple-500 text-purple-500 px-4 py-2 rounded-lg font-medium hover:bg-purple-500/10 transition-colors">
                                Withdraw
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Section -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-6 border border-gray-700/50">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold">Your Portfolio</h2>
                            <div class="text-right">
                                <div class="text-sm text-gray-400">Total Value</div>
                                <div class="text-2xl font-bold text-green-400">$<?php echo number_format($total_portfolio_value, 2); ?></div>
                            </div>
                        </div>

                        <?php if (!empty($portfolio)): ?>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-left text-gray-400 text-sm">
                                            <th class="pb-4">Asset</th>
                                            <th class="pb-4">Amount</th>
                                            <th class="pb-4">Value</th>
                                            <th class="pb-4">24h Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($portfolio as $asset): ?>
                                            <tr class="border-t border-gray-700/50">
                                                <td class="py-4">
                                                    <div class="flex items-center gap-3">
                                                        <img src="img/<?php echo strtolower($asset["symbol"]); ?>.png" alt="<?php echo $asset["symbol"]; ?>" class="w-8 h-8">
                                                        <div>
                                                            <div class="font-medium"><?php echo $asset["symbol"]; ?></div>
                                                            <div class="text-sm text-gray-400"><?php echo $asset["crypto_name"]; ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4">
                                                    <div class="font-medium"><?php echo number_format($asset["balance"], 8); ?></div>
                                                    <div class="text-sm text-gray-400">$<?php echo number_format($asset["current_price"], 2); ?></div>
                                                </td>
                                                <td class="py-4">
                                                    <div class="font-medium">$<?php echo number_format($asset["value_usd"], 2); ?></div>
                                                    <div class="text-sm text-gray-400"><?php echo number_format(($asset["value_usd"] / $total_portfolio_value) * 100, 1); ?>%</div>
                                                </td>
                                                <td class="py-4">
                                                    <div class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-gray-500/20 text-gray-400">
                                                        N/A
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-12">
                                <div class="text-gray-400 mb-4">You don't have any cryptocurrencies yet</div>
                                <a href="exchange.php" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300">
                                    Start Trading
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Particle animation
        const particlesContainer = document.querySelector('#particles');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.width = Math.random() * 5 + 2 + 'px';
            particle.style.height = particle.style.width;
            particle.style.animationDelay = Math.random() * 5 + 's';
            particlesContainer.appendChild(particle);
        }
    </script>
</body>
</html> 