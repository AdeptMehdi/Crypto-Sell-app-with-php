-- Create the database
CREATE DATABASE IF NOT EXISTS crypto_exchange;
USE crypto_exchange;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    wallet_balance DECIMAL(15, 2) DEFAULT 0.00
);

-- Create cryptocurrencies table
CREATE TABLE IF NOT EXISTS cryptocurrencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    symbol VARCHAR(10) NOT NULL,
    name VARCHAR(100) NOT NULL,
    current_price DECIMAL(20, 8) NOT NULL,
    image_url VARCHAR(255),
    market_cap DECIMAL(24, 2),
    volume_24h DECIMAL(24, 2),
    price_change_24h DECIMAL(12, 2),
    price_change_percentage_24h DECIMAL(8, 2),
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    crypto_id INT NOT NULL,
    type ENUM('buy', 'sell') NOT NULL,
    amount DECIMAL(20, 8) NOT NULL,
    price DECIMAL(20, 8) NOT NULL,
    total DECIMAL(20, 2) NOT NULL,
    fee DECIMAL(20, 2) NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (crypto_id) REFERENCES cryptocurrencies(id)
);

-- Create wallets table
CREATE TABLE IF NOT EXISTS wallets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    crypto_id INT NOT NULL,
    balance DECIMAL(20, 8) NOT NULL DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (crypto_id) REFERENCES cryptocurrencies(id),
    UNIQUE KEY user_crypto (user_id, crypto_id)
);

-- Insert sample data

-- Sample Users (password is hashed - in this example "password" is hashed with password_hash() in PHP)
INSERT INTO users (name, email, password, wallet_balance) VALUES
('Demo User', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 10000.00),
('Alice Smith', 'alice@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5000.00),
('Bob Johnson', 'bob@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 7500.00);

-- Sample Cryptocurrencies
INSERT INTO cryptocurrencies (symbol, name, current_price, image_url, market_cap, volume_24h, price_change_24h, price_change_percentage_24h) VALUES
('BTC', 'Bitcoin', 45632.10, 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png', 864258741258, 28541254125, 2.50, 2.50),
('ETH', 'Ethereum', 3278.45, 'https://assets.coingecko.com/coins/images/279/large/ethereum.png', 382541254125, 18541254125, 58.45, 1.80),
('ADA', 'Cardano', 1.92, 'https://assets.coingecko.com/coins/images/975/large/cardano.png', 62541254125, 5541254125, -0.014, -0.70),
('BNB', 'Binance Coin', 528.30, 'https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png', 81541254125, 3541254125, 16.45, 3.20),
('SOL', 'Solana', 102.15, 'https://assets.coingecko.com/coins/images/4128/large/solana.png', 32541254125, 2541254125, -2.35, -2.30),
('XRP', 'XRP', 0.75, 'https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png', 28541254125, 2141254125, 0.015, 2.00),
('DOT', 'Polkadot', 27.85, 'https://assets.coingecko.com/coins/images/12171/large/polkadot.png', 25541254125, 1541254125, 0.85, 3.10),
('DOGE', 'Dogecoin', 0.25, 'https://assets.coingecko.com/coins/images/5/large/dogecoin.png', 20541254125, 1341254125, -0.005, -2.10),
('AVAX', 'Avalanche', 85.45, 'https://assets.coingecko.com/coins/images/12559/large/Avalanche_Circle_RedWhite_Trans.png', 18541254125, 1241254125, 2.15, 2.50),
('LINK', 'Chainlink', 28.75, 'https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png', 15541254125, 1141254125, 0.55, 1.90);

-- Sample Transactions
INSERT INTO transactions (user_id, crypto_id, type, amount, price, total, fee) VALUES
(1, 1, 'buy', 0.15, 44000.00, 6600.00, 33.00),
(1, 2, 'buy', 2.5, 3100.00, 7750.00, 38.75),
(1, 3, 'buy', 1000, 1.80, 1800.00, 9.00),
(2, 1, 'buy', 0.05, 45000.00, 2250.00, 11.25),
(2, 4, 'buy', 5, 500.00, 2500.00, 12.50),
(3, 1, 'buy', 0.1, 43000.00, 4300.00, 21.50),
(3, 2, 'buy', 1.5, 3200.00, 4800.00, 24.00),
(1, 2, 'sell', 0.5, 3250.00, 1625.00, 8.13);

-- Sample Wallets
INSERT INTO wallets (user_id, crypto_id, balance) VALUES
(1, 1, 0.15),
(1, 2, 2.0),
(1, 3, 1000),
(2, 1, 0.05),
(2, 4, 5),
(3, 1, 0.1),
(3, 2, 1.5);

-- Create stored procedures

-- Procedure to handle buys and sells
DELIMITER //
CREATE PROCEDURE execute_trade(
    IN p_user_id INT,
    IN p_crypto_id INT,
    IN p_type ENUM('buy', 'sell'),
    IN p_amount DECIMAL(20, 8),
    IN p_price DECIMAL(20, 8)
)
BEGIN
    DECLARE p_total DECIMAL(20, 2);
    DECLARE p_fee DECIMAL(20, 2);
    DECLARE current_balance DECIMAL(20, 8);
    DECLARE wallet_exists INT;
    
    -- Calculate total and fee
    SET p_total = p_amount * p_price;
    SET p_fee = p_total * 0.005; -- 0.5% fee
    
    -- Start transaction
    START TRANSACTION;
    
    IF p_type = 'buy' THEN
        -- Check if user has enough balance
        SELECT wallet_balance INTO current_balance FROM users WHERE id = p_user_id;
        
        IF current_balance < (p_total + p_fee) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient balance';
            ROLLBACK;
        ELSE
            -- Update user balance
            UPDATE users SET wallet_balance = wallet_balance - (p_total + p_fee) WHERE id = p_user_id;
            
            -- Check if wallet exists
            SELECT COUNT(*) INTO wallet_exists FROM wallets WHERE user_id = p_user_id AND crypto_id = p_crypto_id;
            
            IF wallet_exists > 0 THEN
                -- Update wallet
                UPDATE wallets SET balance = balance + p_amount WHERE user_id = p_user_id AND crypto_id = p_crypto_id;
            ELSE
                -- Create wallet
                INSERT INTO wallets (user_id, crypto_id, balance) VALUES (p_user_id, p_crypto_id, p_amount);
            END IF;
        END IF;
    ELSE -- sell
        -- Check if user has enough crypto
        SELECT balance INTO current_balance FROM wallets WHERE user_id = p_user_id AND crypto_id = p_crypto_id;
        
        IF current_balance < p_amount THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient crypto balance';
            ROLLBACK;
        ELSE
            -- Update wallet
            UPDATE wallets SET balance = balance - p_amount WHERE user_id = p_user_id AND crypto_id = p_crypto_id;
            
            -- Update user balance (add the proceeds minus fee)
            UPDATE users SET wallet_balance = wallet_balance + (p_total - p_fee) WHERE id = p_user_id;
        END IF;
    END IF;
    
    -- Record transaction
    INSERT INTO transactions (user_id, crypto_id, type, amount, price, total, fee)
    VALUES (p_user_id, p_crypto_id, p_type, p_amount, p_price, p_total, p_fee);
    
    COMMIT;
END //
DELIMITER ;

-- Views

-- Portfolio view showing all user holdings
CREATE VIEW user_portfolio AS
SELECT 
    u.id AS user_id,
    u.name AS user_name,
    u.email,
    c.symbol,
    c.name AS crypto_name,
    w.balance,
    c.current_price,
    (w.balance * c.current_price) AS value_usd
FROM 
    users u
JOIN 
    wallets w ON u.id = w.user_id
JOIN 
    cryptocurrencies c ON w.crypto_id = c.id
WHERE 
    w.balance > 0;

-- Transaction history view
CREATE VIEW transaction_history AS
SELECT 
    t.id AS transaction_id,
    u.name AS user_name,
    c.symbol,
    c.name AS crypto_name,
    t.type,
    t.amount,
    t.price,
    t.total,
    t.fee,
    t.transaction_date
FROM 
    transactions t
JOIN 
    users u ON t.user_id = u.id
JOIN 
    cryptocurrencies c ON t.crypto_id = c.id
ORDER BY 
    t.transaction_date DESC; 