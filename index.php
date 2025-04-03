<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Exchange</title>
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
        
        /* Additional styles for new sections */
        .latest-news {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .news-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .news-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 20px;
        }

        .news-date {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .news-title {
            margin: 0 0 15px;
            font-size: 1.3rem;
            color: #333;
        }

        .news-excerpt {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .news-read-more {
            display: inline-block;
            color: #3861fb;
            font-weight: 500;
        }

        .how-it-works {
            padding: 80px 0;
            background: linear-gradient(135deg, #f6f9fe, #eef4fd);
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .step-card {
            width: calc(25% - 20px);
            min-width: 250px;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(56, 97, 251, 0.15);
            border-color: rgba(56, 97, 251, 0.1);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(56, 97, 251, 0.3);
        }

        .step-title {
            margin: 0 0 15px;
            color: #333;
            font-size: 1.3rem;
        }

        .step-description {
            color: #666;
            line-height: 1.6;
        }

        .testimonials {
            padding: 80px 0;
            background-color: white;
        }

        .testimonials-container {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            padding: 20px 0;
            margin-top: 40px;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        
        .testimonials-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .testimonial-card {
            min-width: 350px;
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            position: relative;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: rgba(56, 97, 251, 0.1);
        }

        .testimonial-text {
            margin-bottom: 20px;
            font-style: italic;
            color: #333;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
            border: 2px solid #3861fb;
        }

        .author-name {
            font-weight: 500;
            color: #333;
            margin: 0;
        }

        .author-title {
            color: #666;
            font-size: 0.9rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.2rem;
            color: #222;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #3861fb, #6b4bff);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(56, 97, 251, 0.2);
        }
        
        .cta-section::before,
        .cta-section::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }
        
        .cta-section::before {
            top: -100px;
            right: -100px;
        }
        
        .cta-section::after {
            bottom: -100px;
            left: -100px;
        }

        .cta-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .cta-subtitle {
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .cta-btn {
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cta-btn-white {
            background-color: white;
            color: #3861fb;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-btn-white:hover {
            background-color: #f0f0f0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .cta-btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stats-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 40px;
            gap: 15px;
        }

        .stat-card {
            text-align: center;
            padding: 25px;
            width: 220px;
            margin-bottom: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: rgba(56, 97, 251, 0.1);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #3861fb, #6b4bff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 1.1rem;
        }

        .features-extended {
            padding: 80px 0;
            background-color: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: rgba(56, 97, 251, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(56, 97, 251, 0.2);
        }

        .feature-icon svg {
            width: 35px;
            height: 35px;
            fill: white;
        }

        .feature-title {
            margin: 0 0 15px;
            color: #333;
            font-size: 1.4rem;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .step-card {
                width: 100%;
            }
            
            .testimonial-card {
                min-width: 100%;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .cta-btn {
                width: 100%;
                max-width: 300px;
            }
        }

        .feature {
            background-color: white;
            border-radius: 16px;
            padding: 35px;
            transition: all 0.4s ease;
            border: 1px solid rgba(56, 97, 251, 0.1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            z-index: 1;
        }
        
        .feature::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(56, 97, 251, 0.03), rgba(107, 75, 255, 0.06));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .feature:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(56, 97, 251, 0.15);
            border-color: transparent;
        }
        
        .feature:hover::before {
            opacity: 1;
        }
        
        .feature .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(56, 97, 251, 0.3);
            transform: rotate(-5deg);
            transition: all 0.4s ease;
        }
        
        .feature:hover .feature-icon {
            transform: rotate(0) scale(1.05);
        }
        
        .feature .feature-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        
        .feature h3 {
            color: #222;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 12px;
        }
        
        .feature h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #3861fb, #6b4bff);
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        
        .feature:hover h3::after {
            width: 60px;
        }
        
        .feature p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.7;
            font-size: 1.05rem;
        }
        
        .feature-link {
            display: inline-block;
            color: #3861fb;
            font-weight: 600;
            position: relative;
            padding-right: 22px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .feature-link::after {
            content: '→';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
        }
        
        .feature:hover .feature-link {
            color: #6b4bff;
            padding-right: 28px;
        }
        
        .feature:hover .feature-link::after {
            transform: translate(5px, -50%);
        }
        
        .features {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }
        
        .features::before,
        .features::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(56, 97, 251, 0.03);
            z-index: 0;
        }
        
        .features::before {
            top: -100px;
            right: -100px;
        }
        
        .features::after {
            bottom: -100px;
            left: -100px;
        }
        
        .feature-grid {
            position: relative;
            z-index: 1;
            gap: 40px;
            margin-top: 60px;
        }
        
        @media (max-width: 768px) {
            .feature {
                padding: 30px 25px;
            }
            
            .feature .feature-icon {
                width: 65px;
                height: 65px;
                border-radius: 16px;
            }
            
            .feature .feature-icon svg {
                width: 32px;
                height: 32px;
            }
            
            .feature h3 {
                font-size: 1.3rem;
            }
            
            .features {
                padding: 80px 0;
            }
            
            .feature-grid {
                gap: 30px;
                margin-top: 40px;
            }
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="market.php">Market</a></li>
                    <li><a href="exchange.php">Exchange</a></li>
                    <li><a href="wallet.php">Wallet</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="login.php" class="btn btn-login">Login</a>
                <a href="register.php" class="btn btn-register">Register</a>
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
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

    <!-- New Section: Stats -->
    <section class="stats-section">
        <div class="container">
            <h2 class="section-title">CryptoExchange Stats</h2>
            <p class="section-subtitle">A trusted platform for millions of users worldwide</p>
            
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-value">$4.2B+</div>
                    <div class="stat-label">Trading Volume</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">2.5M+</div>
                    <div class="stat-label">Registered Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">150+</div>
                    <div class="stat-label">Cryptocurrencies</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">100+</div>
                    <div class="stat-label">Countries Supported</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Get started with cryptocurrency trading in just a few simple steps</p>
            
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Create Account</h3>
                    <p class="step-description">Register for a free account using your email address and create a password</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Verify Identity</h3>
                    <p class="step-description">Complete the verification process to increase your account security</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Fund Your Account</h3>
                    <p class="step-description">Add funds to your account using a variety of payment methods</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Start Trading</h3>
                    <p class="step-description">Buy, sell and trade crypto with ease on our secure platform</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose Our Exchange?</h2>
            <p class="section-subtitle">We offer the best features for cryptocurrency traders of all levels</p>
            <div class="feature-grid">
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <h3>Secure Storage</h3>
                    <p>Your funds are stored in cold wallets with multi-signature technology for maximum protection.</p>
                    <a href="#" class="feature-link">Learn more</a>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                    </div>
                    <h3>Low Fees</h3>
                    <p>Enjoy competitive trading fees and zero deposit fees to maximize your investment returns.</p>
                    <a href="#" class="feature-link">Fee schedule</a>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/></svg>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our customer support team is always ready to help you with any questions or concerns.</p>
                    <a href="#" class="feature-link">Contact support</a>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/></svg>
                    </div>
                    <h3>Advanced Trading Tools</h3>
                    <p>Access real-time charts, market data, and advanced trading indicators for successful trades.</p>
                    <a href="#" class="feature-link">Explore tools</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Extended Features Section -->
    <section class="features-extended">
        <div class="container">
            <h2 class="section-title">Advanced Features</h2>
            <p class="section-subtitle">Our platform offers everything you need for successful crypto trading</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <h3 class="feature-title">Enterprise-Grade Security</h3>
                    <p class="feature-description">We use advanced security measures like 2FA, cold storage, and regular security audits to protect your assets.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/></svg>
                    </div>
                    <h3 class="feature-title">Order Types</h3>
                    <p class="feature-description">Execute trades with market, limit, and stop orders to maximize your trading strategy.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11 9h2v2h-2zm-2 2h2v2H9zm4 0h2v2h-2zm2-2h2v2h-2zM7 9h2v2H7zm12-6H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/></svg>
                    </div>
                    <h3 class="feature-title">API Access</h3>
                    <p class="feature-description">Connect your trading bots and applications using our comprehensive REST and WebSocket APIs.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                    </div>
                    <h3 class="feature-title">Advanced Charts</h3>
                    <p class="feature-description">Analyze market trends with professional-grade charting tools and technical indicators.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10z"/></svg>
                    </div>
                    <h3 class="feature-title">Portfolio Management</h3>
                    <p class="feature-description">Track and manage your crypto holdings with intuitive portfolio tools and real-time updates.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                    </div>
                    <h3 class="feature-title">Flexible Payment Options</h3>
                    <p class="feature-description">Fund your account with bank transfers, credit/debit cards, and other popular payment methods.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="latest-news">
        <div class="container">
            <h2 class="section-title">Latest Crypto News</h2>
            <p class="section-subtitle">Stay updated with the latest developments in the cryptocurrency world</p>
            
            <div class="news-container">
                <div class="news-card">
                    <img src="https://via.placeholder.com/600x400" alt="Bitcoin News" class="news-image">
                    <div class="news-content">
                        <div class="news-date">May 15, 2023</div>
                        <h3 class="news-title">Bitcoin Breaks $50,000 Barrier as Institutional Adoption Grows</h3>
                        <p class="news-excerpt">The largest cryptocurrency by market cap has reached new heights as more institutions add it to their balance sheets.</p>
                        <a href="#" class="news-read-more">Read More</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/600x400" alt="Ethereum News" class="news-image">
                    <div class="news-content">
                        <div class="news-date">May 10, 2023</div>
                        <h3 class="news-title">Ethereum 2.0 Upgrade: What You Need to Know</h3>
                        <p class="news-excerpt">The long-awaited Ethereum upgrade promises to solve scalability issues and reduce gas fees.</p>
                        <a href="#" class="news-read-more">Read More</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/600x400" alt="Regulation News" class="news-image">
                    <div class="news-content">
                        <div class="news-date">May 5, 2023</div>
                        <h3 class="news-title">New Crypto Regulations: Impact on Global Markets</h3>
                        <p class="news-excerpt">Governments worldwide are introducing new regulatory frameworks for cryptocurrencies. Here's what it means for traders.</p>
                        <a href="#" class="news-read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Users Say</h2>
            <p class="section-subtitle">Hear from satisfied users who have trusted us with their crypto journey</p>
            
            <div class="testimonials-container">
                <div class="testimonial-card">
                    <p class="testimonial-text">"CryptoExchange has transformed how I trade cryptocurrencies. The platform is intuitive, secure, and offers all the tools I need for successful trading."</p>
                    <div class="testimonial-author">
                        <img src="https://via.placeholder.com/100x100" alt="Sarah J." class="author-avatar">
                        <div>
                            <h4 class="author-name">Sarah Johnson</h4>
                            <div class="author-title">Active Trader, Since 2021</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"As a beginner in crypto, I needed a platform that was easy to understand. CryptoExchange provided exactly that, along with excellent customer support that helped me every step of the way."</p>
                    <div class="testimonial-author">
                        <img src="https://via.placeholder.com/100x100" alt="Michael R." class="author-avatar">
                        <div>
                            <h4 class="author-name">Michael Rodriguez</h4>
                            <div class="author-title">New Investor, Since 2022</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"The security features on CryptoExchange give me peace of mind. Their cold storage solution and two-factor authentication ensure my investments are protected."</p>
                    <div class="testimonial-author">
                        <img src="https://via.placeholder.com/100x100" alt="David L." class="author-avatar">
                        <div>
                            <h4 class="author-name">David Lee</h4>
                            <div class="author-title">Security Specialist, Since 2020</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Start Your Crypto Journey Today</h2>
            <p class="cta-subtitle">Join millions of users worldwide who trust CryptoExchange for their cryptocurrency needs</p>
            <div class="cta-buttons">
                <a href="register.php" class="cta-btn cta-btn-white">Create Account</a>
                <a href="market.php" class="cta-btn cta-btn-outline">Explore Market</a>
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