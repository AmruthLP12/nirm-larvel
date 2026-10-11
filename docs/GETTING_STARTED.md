# 🚀 Getting Started

This guide walks you through setting up the NIRM CMS project on your local machine from scratch.

---

## Prerequisites

Before you begin, ensure you have the following installed:

### Required Software

| Software | Version | Check Command |
|---|---|---|
| **PHP** | 8.0+ | `php -v` |
| **Composer** | 2.x | `composer --version` |
| **SQLite** (or MySQL/MariaDB) | 3.x+ (or MySQL 8.0+) | `sqlite3 --version` |
| **Node.js** | 14+ (LTS recommended) | `node -v` |
| **npm** | 6+ | `npm -v` |
| **Git** | 2.x | `git --version` |

### Required PHP Extensions

The following PHP extensions must be enabled (check with `php -m`):

- `php-sqlite3` / `pdo_sqlite` (for SQLite)
- `php-curl`
- `php-json`
- `php-zip`
- `php-mbstring`
- `php-xml`
- `php-mysql` (or `php-pdo_mysql`, if using MySQL)
- `php-gd` or `php-imagick` (for image processing)
- `php-bcmath`
- `php-tokenizer`
- `php-fileinfo`

#### Install PHP extensions on Ubuntu/Debian:
```bash
sudo apt update
sudo apt install php8.0 php8.0-sqlite3 php8.0-curl php8.0-json php8.0-zip php8.0-mbstring \
    php8.0-xml php8.0-mysql php8.0-gd php8.0-bcmath php8.0-tokenizer \
    php8.0-fileinfo
```

#### Install PHP extensions on macOS (Homebrew):
```bash
brew install php@8.0
# Most extensions come bundled with Homebrew PHP
```

---

## Installation Steps

### Step 1: Clone the Repository

```bash
git clone <YOUR_REPO_URL> nirm-larvel
cd nirm-larvel
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

> **Note:** If you encounter memory issues, try:
> ```bash
> COMPOSER_MEMORY_LIMIT=-1 composer install
> ```

### Step 3: Configure Environment

Copy the example environment file and customize it:

```bash
cp .env.example .env
```

Open `.env` in your editor and update these values:

#### For SQLite (recommended for fast local setup):
```dotenv
APP_NAME="NIRM CMS"
APP_DEBUG=true
APP_ENV=local
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/nirm-larvel/database/database.sqlite
# Or leave DB_DATABASE empty / use default database_path('database.sqlite')

ADMIN_DIR=cmsadmin
```

*(Alternatively, for MySQL, set `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=laravel_nirm_cms`, `DB_USERNAME=root`, `DB_PASSWORD=your_password`)*

See [Environment Configuration](./ENVIRONMENT.md) for a full reference of all variables.

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Setup the Database

#### Option A: SQLite (Quick & Self-Contained)

1. Create the `database` folder (if it doesn't exist) and the SQLite database file:
```bash
mkdir -p database
touch database/database.sqlite
```

2. Run the migrations to build all platform tables:
```bash
php artisan migrate
```

> **Note:** If you want pre-populated seed data or need specific content, you can convert `database.sql` into SQLite or use `php artisan db:seed` / artisan commands.

#### Option B: MySQL / MariaDB (Production / Full Dump Import)

If you prefer using MySQL with the existing `database.sql` dump:

```bash
# Create the database first
mysql -u root -p -e "CREATE DATABASE laravel_nirm_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import the SQL dump
mysql -u root -p laravel_nirm_cms < database.sql
```

### Step 6: Create Storage Symlink

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` → `storage/app/public`, allowing uploaded files to be publicly accessible.

### Step 7: Publish CMS Assets

```bash
php artisan cms:publish:assets
```

This publishes CSS, JS, and language files from all platform plugins and themes to the `public/` directory.

### Step 8: Install Node Dependencies & Build Assets

```bash
npm install
npm run dev
```

### Step 9: Set Directory Permissions

```bash
# Ensure storage and cache directories are writable
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

### Step 10: Run the Development Server

```bash
php artisan serve
```

---

## Verify Installation

| Check | URL |
|---|---|
| **Homepage** | http://127.0.0.1:8000 |
| **Admin Panel** | http://127.0.0.1:8000/cmsadmin |

### Default Admin Credentials

After importing `database.sql`, use the existing admin account to log in. If you need to create a new admin user, use tinker:

```bash
php artisan tinker
```

```php
// Check existing users
\Obii\ACL\Models\User::all();
```

---

## Common First-Run Issues

| Issue | Solution |
|---|---|
| `Database file at path [...] does not exist` | Run `mkdir -p database && touch database/database.sqlite` |
| `could not find driver (SQLSTATE[HY000])` (SQLite) | Install PHP SQLite extension: `sudo apt install php8.0-sqlite3` |
| `SQLSTATE[HY000] [2002]` (MySQL) | MySQL is not running. Start with `sudo systemctl start mysql` |
| `The stream or file "storage/logs/laravel.log" could not be opened` | Fix permissions: `chmod -R 775 storage` |
| `No application encryption key` | Run `php artisan key:generate` |
| `Class "XXX" not found` | Run `composer dump-autoload` |
| Blank white page | Check `storage/logs/laravel.log` for errors |
| CSS/JS not loading | Run `npm run dev` and `php artisan cms:publish:assets` |

---

## Next Steps

- 📖 [Architecture Overview](./ARCHITECTURE.md) — Understand the project structure
- 🔧 [Environment Configuration](./ENVIRONMENT.md) — Configure services and features
- 🎨 [Theme Development](./THEME.md) — Customize the NIRM theme
- 🚀 [Deployment Guide](./DEPLOYMENT.md) — Deploy to production
