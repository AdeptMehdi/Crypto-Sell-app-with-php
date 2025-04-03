<?php
// Include config file to get database connection
require_once "config.php";

// Initialize session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = "";
$name_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement to check if email already exists
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement (without wallet_balance)
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_email, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page with success message
                header("location: login.php?registered=true");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CryptoExchange</title>
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
        
        /* Register form styles */
        .register-container {
            max-width: 480px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .register-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3861fb;
            outline: none;
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #3861fb, #6b4bff);
            color: white;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 97, 251, 0.25);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 97, 251, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #3861fb;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .social-login {
            margin-top: 30px;
            text-align: center;
        }
        
        .social-login p {
            margin-bottom: 15px;
            color: #666;
            position: relative;
        }
        
        .social-login p:before,
        .social-login p:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 35%;
            height: 1px;
            background-color: #ddd;
        }
        
        .social-login p:before {
            left: 0;
        }
        
        .social-login p:after {
            right: 0;
        }
        
        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f8f9fa;
            border: 1px solid #eee;
            color: #333;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .social-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .social-button.google:hover {
            color: #DB4437;
            border-color: #DB4437;
        }
        
        .social-button.facebook:hover {
            color: #4267B2;
            border-color: #4267B2;
        }
        
        .social-button.apple:hover {
            color: #000;
            border-color: #000;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
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

    <main class="container">
        <div class="register-container">
            <?php if(!empty($error_msg)): ?>
                <div class="alert">
                    <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>
            
            <?php if(!empty($success_msg)): ?>
                <div class="alert alert-success">
                    <?php echo $success_msg; ?>
                </div>
            <?php endif; ?>
            
            <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Create an Account</h2>
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn btn-submit">Register</button>
                
                <div class="login-link">
                    Already have an account? <a href="login.php">Login here</a>
                </div>
                
                <div class="social-login">
                    <p>Or register with</p>
                    <div class="social-buttons">
                        <a href="#" class="social-button google">G</a>
                        <a href="#" class="social-button facebook">f</a>
                        <a href="#" class="social-button apple">⌘</a>
                    </div>
                </div>
            </form>
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