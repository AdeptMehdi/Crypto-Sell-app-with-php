<?php
// Initialize session
session_start();

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
        // In a real application, you would check if email already exists in database
        $email = trim($_POST["email"]);
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
        // In a real application, you would insert the user into a database
        // This is a mock success for demonstration
        
        // Redirect to login page with success message
        header("location: login.php?registered=true");
        exit();
    }
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
        .auth-form-container {
            max-width: 450px;
            margin: 80px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        
        .auth-form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
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
        
        .form-control.is-invalid {
            border-color: #ff3d00;
        }
        
        .invalid-feedback {
            color: #ff3d00;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .auth-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #3861fb;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .auth-btn:hover {
            background-color: #2d4ec9;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .terms {
            font-size: 12px;
            color: #666;
            margin-top: 15px;
            text-align: center;
        }
        
        .social-login {
            margin-top: 30px;
            text-align: center;
        }
        
        .social-login p {
            color: #666;
            margin-bottom: 15px;
            position: relative;
        }
        
        .social-login p::before,
        .social-login p::after {
            content: "";
            display: inline-block;
            width: 40%;
            height: 1px;
            background-color: #ddd;
            position: absolute;
            top: 50%;
        }
        
        .social-login p::before {
            left: 0;
        }
        
        .social-login p::after {
            right: 0;
        }
        
        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-btn {
            padding: 12px 20px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        
        .google-btn {
            background-color: #4285F4;
        }
        
        .facebook-btn {
            background-color: #3b5998;
        }
    </style>
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

    <main class="container">
        <div class="auth-form-container">
            <h2>Create an Account</h2>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                    <?php if(!empty($name_err)): ?>
                        <div class="invalid-feedback"><?php echo $name_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <?php if(!empty($email_err)): ?>
                        <div class="invalid-feedback"><?php echo $email_err; ?></div>
                    <?php endif; ?>
                </div>    
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <?php if(!empty($password_err)): ?>
                        <div class="invalid-feedback"><?php echo $password_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <?php if(!empty($confirm_password_err)): ?>
                        <div class="invalid-feedback"><?php echo $confirm_password_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="auth-btn">Register</button>
                </div>
                <div class="terms">
                    By registering, you agree to our <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a>.
                </div>
                <div class="auth-links">
                    <a href="login.php">Already have an account? Login</a>
                </div>
            </form>
            
            <div class="social-login">
                <p>Or register with</p>
                <div class="social-buttons">
                    <a href="#" class="social-btn google-btn">Google</a>
                    <a href="#" class="social-btn facebook-btn">Facebook</a>
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