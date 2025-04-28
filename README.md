Aurelien Goncalves - 220082411

# Password Manager

A simple Password Manager web application built with Laravel, using Laravel Sail for development environment management.

## Prerequisites

Make sure you have the following installed:

- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/)

> **Note**: This project uses [Laravel Sail](https://laravel.com/docs/11.x/sail) — a lightweight command-line interface for interacting with Laravel's Docker environment.

## Installation

Follow these steps to get the project up and running:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/AurelienGON/password-manager.git
   cd password-manager
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Install Node.js Dependencies**

   ```bash
   npm install
   ```

4. **Start Laravel Sail**

   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Create a New Database**

   Ensure there is a database named `laravel` inside your MySQL service.  
   If using Sail's MySQL container, you can connect using a tool like [TablePlus](https://tableplus.com/) or directly through the CLI.

6. **Run Migrations and Seeders**

   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

7. **Build Frontend Assets**

   ```bash
   npm run build
   ```

8. **Access the Application**

   Open your browser and navigate to:

   ```
   http://localhost
   ```

---

## Notes

- If you encounter any port conflicts with Sail, make sure that the default ports (e.g., 80, 3306) are available.
- Refer to the [Laravel Sail documentation](https://laravel.com/docs/11.x/sail) for advanced usage or troubleshooting.
