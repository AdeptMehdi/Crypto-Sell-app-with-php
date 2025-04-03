# Cryptocurrency Exchange Platform

A modern PHP-based cryptocurrency exchange platform with responsive design and user authentication. This project demonstrates a full-featured cryptocurrency trading interface with market data visualization, trading functionality, and wallet management.

## Features

- **User Authentication**: Secure login and registration system
- **Market Overview**: Real-time cryptocurrency prices and market data
- **Trading Interface**: Buy and sell cryptocurrencies with live pricing
- **Wallet Management**: Track portfolio value and transaction history
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices
- **Intuitive UI**: Modern and user-friendly interface

## Screenshots

![Dashboard Screenshot](screenshots/dashboard.png)
![Market View Screenshot](screenshots/market.png)
![Trading Interface Screenshot](screenshots/exchange.png)

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- XAMPP, WAMP, LAMP, or any PHP development environment
- Web browser (Chrome, Firefox, Safari, etc.)

## Installation

1. Clone this repository:
   ```
   git clone https://github.com/yourusername/crypto-exchange.git
   ```

2. Move the project to your XAMPP `htdocs` directory:
   ```
   mv crypto-exchange /path/to/xampp/htdocs/
   ```

3. Start XAMPP and ensure Apache and MySQL services are running

4. Create the database:
   - Open your browser and navigate to `http://localhost/phpmyadmin`
   - Create a new database named `crypto_exchange`
   - Import the database structure from `database/crypto_exchange.sql`

5. Configure database connection:
   - Open `config.php` and update the database credentials if needed:
     ```php
     $host = "localhost";
     $username = "root"; // default XAMPP username
     $password = ""; // default XAMPP password (empty)
     $dbname = "crypto_exchange";
     ```

6. Access the application:
   - Navigate to `http://localhost/crypto-exchange` in your web browser

## Database Structure

The application uses the following main tables:
- `users` - User account information
- `wallets` - User cryptocurrency wallets
- `transactions` - Transaction history
- `cryptocurrencies` - Cryptocurrency information and prices

## Usage

### Demo Credentials

For demonstration purposes, you can use the following credentials to log in:

- **Email**: user@example.com
- **Password**: password

### Main Pages

- **Home Page**: `index.php` - Landing page with platform overview
- **Market Page**: `market.php` - Cryptocurrency market data and prices
- **Exchange Page**: `exchange.php` - Trading interface for buying/selling
- **Wallet Page**: `wallet.php` - Portfolio management and balance tracking
- **Login Page**: `login.php` - User authentication
- **Register Page**: `register.php` - New account creation

## Development Notes

- This application uses mock data for demonstration purposes
- In a production environment, you would need to:
  - Connect to a cryptocurrency API for real-time market data
  - Implement proper security measures (input validation, XSS protection, etc.)
  - Set up proper payment processing
  - Configure secure session management

## Customization

You can customize the platform by:

- Modifying the CSS in `css/style.css` to change the visual theme
- Adding or removing cryptocurrencies in the PHP data files
- Extending functionality with additional features

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is available under the MIT License. See the LICENSE file for more information.

## Disclaimer

This project is for educational purposes only and should not be used as-is in a production environment. Real cryptocurrency exchanges require regulatory compliance, robust security measures, and extensive backend infrastructure. 