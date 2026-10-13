# 🚀 Complete Setup & Deployment Guide for NIRM.in

This guide covers the **end-to-end setup process** when you clone this repository to a new machine, testing environment, or staging server. It details everything skipped by `.gitignore` (assets, environment configs, database dumps), how to configure and migrate the database, clear caches, and serve the application with custom host and port.

---

## 📋 Table of Contents
1. [Prerequisites & Requirements](#1-prerequisites--requirements)
2. [Step 1: Clone the Repository](#step-1-clone-the-repository)
3. [Step 2: Install Dependencies](#step-2-install-dependencies)
4. [Step 3: Copy Git-Ignored Assets & Files From Production](#step-3-copy-git-ignored-assets--files-from-production)
5. [Step 4: Environment Configuration (`.env`)](#step-4-environment-configuration-env)
6. [Step 5: Database Setup & Import](#step-5-database-setup--import)
7. [Step 6: Running Migrations & Old DB Alignment](#step-6-running-migrations--old-db-alignment)
8. [Step 7: Cache Management & Optimization](#step-7-cache-management--optimization)
9. [Step 8: Serving the Application (Custom Host & Port)](#step-8-serving-the-application-custom-host--port)
10. [Step 9: Production Nginx / Apache Setup](#step-9-production-nginx--apache-setup)
11. [Troubleshooting Common Issues](#troubleshooting-common-issues)

---

## 1. Prerequisites & Requirements

Before beginning, ensure your environment meets the minimum requirements:
- **PHP**: `^7.4` or `^8.0` (8.0 recommended)
- **PHP Extensions**: `bcmath`, `curl`, `fileinfo`, `gd`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `zip`
- **Database**: MySQL `5.7+` or MariaDB `10.3+`
- **Composer**: `v2.x`
- **Node.js & NPM**: Node `14.x` / `16.x` (only required if recompiling assets with Laravel Mix)

---

## Step 1: Clone the Repository

Clone the project to your local or staging server:

```bash
git clone <repository-url> nirm.in
cd nirm.in
```

---

## Step 2: Install Dependencies

Install the PHP vendor packages:

```bash
composer install --no-dev --optimize-autoloader
```
*(For development or local testing, you can omit `--no-dev`)*

---

## Step 3: Copy Git-Ignored Assets & Files From Production

The repository excludes several large and sensitive directories via `.gitignore`. You **must copy these from your production server** or backup to ensure media, uploads, and styling work:

### Git-Ignored Items List:
| Source on Production | Destination on Target | Description |
| :--- | :--- | :--- |
| `/var/www/nirm.in/.env` | `.env` | Environment configuration & database credentials |
| `/var/www/nirm.in/public/storage/` | `public/storage/` | Uploaded images, banners, client logos, slider photos |
| `/var/www/nirm.in/storage/app/public/` | `storage/app/public/` | Backing files for storage symlink |
| `/var/www/nirm.in/public/vendor/core/` | `public/vendor/core/` | Published CMS admin assets (JS/CSS/fonts for dashboard) |
| `/var/www/nirm.in/public/mix-manifest.json` | `public/mix-manifest.json` | Compiled asset manifest |

### 📥 Option A: Copying directly via `rsync` from Production Server

Run this from your **target / local machine**:

```bash
# Set your production SSH user and host
PROD_USER="root"
PROD_HOST="ubuntu-s-2vcpu-4gb-amd-blr1-01-nirm"
PROD_PATH="/var/www/nirm.in"

# 1. Copy .env
rsync -avzP ${PROD_USER}@${PROD_HOST}:${PROD_PATH}/.env .env

# 2. Copy public media/uploads (images, client logos, sliders)
rsync -avzP ${PROD_USER}@${PROD_HOST}:${PROD_PATH}/public/storage/ public/storage/

# 3. Copy storage/app/public
rsync -avzP ${PROD_USER}@${PROD_HOST}:${PROD_PATH}/storage/app/public/ storage/app/public/

# 4. Copy published core admin assets (CMS panel styles/scripts)
rsync -avzP ${PROD_USER}@${PROD_HOST}:${PROD_PATH}/public/vendor/ public/vendor/

# 5. Copy mix-manifest.json if available
rsync -avzP ${PROD_USER}@${PROD_HOST}:${PROD_PATH}/public/mix-manifest.json public/mix-manifest.json
```

### 📥 Option B: If Copying as a Compressed Archive (.tar.gz)

On **Production**:
```bash
cd /var/www/nirm.in
tar -czvf /tmp/nirm_assets.tar.gz \
    .env \
    public/storage \
    storage/app/public \
    public/vendor \
    public/mix-manifest.json
```

On **New / Target Server**:
```bash
cd /path/to/nirm.in
tar -xzvf /tmp/nirm_assets.tar.gz
```

### 🔗 Ensure Storage Symlink & Permissions

Ensure `public/storage` is linked and write permissions are granted:
```bash
php artisan storage:link

# Set proper write permissions for storage and bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/storage
```

---

## Step 4: Environment Configuration (`.env`)

If you are not using production `.env` directly, copy `.env.example`:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` to match your target environment:
```ini
APP_NAME="NIRM CMS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Admin Panel slug (access panel via http://your-host:port/cmsadmin)
ADMIN_DIR=cmsadmin

# Database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nirm_db
DB_USERNAME=root
DB_PASSWORD=your_password
DB_STRICT=false

# Cache & Session settings
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database
```

---

## Step 5: Database Setup & Import

1. **Create the database in MySQL**:
   ```sql
   CREATE DATABASE nirm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Dump database on Production**:
   ```bash
   mysqldump -u root -p nirm_db > /tmp/nirm_backup.sql
   ```

3. **Import database on Target Machine**:
   ```bash
   mysql -u root -p nirm_db < /tmp/nirm_backup.sql
   ```

---

## Step 6: Running Migrations & Old DB Alignment

### 1. Check Migration Status:
```bash
php artisan migrate:status
```

### 2. Run Pending Migrations:
```bash
php artisan migrate
```

### 3. Handle Language Plugin & Old Database Synchronization:
When importing an existing/older database dump:
- Migrations may show as executed, but the `language` plugin might not be active in the `settings` table.
- Existing roles in `roles` may be missing language permissions (`languages.*`).
- Admin accounts might need `super_user` flags.

Run this all-in-one PHP alignment script:

```bash
php -r '
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Ensure "language" plugin is activated in settings table
$active = json_decode(DB::table("settings")->where("key", "activated_plugins")->value("value") ?: "[]", true);
if (!in_array("language", $active)) {
    $active[] = "language";
    DB::table("settings")->updateOrInsert(
        ["key" => "activated_plugins"],
        ["value" => json_encode(array_values(array_unique($active)))]
    );
    echo "✔ Added language to activated_plugins setting.\n";
} else {
    echo "✔ Language is already active in settings.\n";
}

// 2. Grant language permissions to all roles in roles table
$roles = DB::table("roles")->get();
foreach ($roles as $role) {
    $perms = json_decode($role->permissions ?: "{}", true) ?: [];
    $perms["languages.index"] = true;
    $perms["languages.create"] = true;
    $perms["languages.edit"] = true;
    $perms["languages.destroy"] = true;
    $perms["languages.theme-translations"] = true;
    DB::table("roles")->where("id", $role->id)->update([
        "permissions" => json_encode($perms)
    ]);
    echo "✔ Added language permissions to role: " . $role->name . "\n";
}

// 3. Ensure administrator accounts have super_user flag
DB::table("users")->update(["super_user" => 1, "manage_supers" => 1]);
echo "✔ Updated users to super_user = 1.\n";

// 4. Flush cache
cache()->flush();
echo "✔ Cache flushed successfully.\n";
'
```

---

## Step 7: Cache Management & Optimization

Always clear existing configuration and view caches after any file or database changes:

```bash
# Clear all cached config, routes, views, and compiled classes
php artisan optimize:clear

# Or individual clear commands:
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

> **For Production Only:**
> Once everything is working, you can cache configuration and routes for speed:
> ```bash
> php artisan config:cache
> php artisan route:cache
> php artisan view:cache
> ```

---

## Step 8: Serving the Application (Custom Host & Port)

### 🖥️ Local Testing / Built-in PHP Server:

You can specify any host and port using `php artisan serve`:

```bash
# Default (localhost:8000)
php artisan serve

# Custom Port (e.g., 8080 or 3000)
php artisan serve --port=8080

# Custom Host (allow access from other machines on LAN or VPS public IP)
php artisan serve --host=0.0.0.0 --port=8080
```

> **Accessing the Application:**
> - **Frontend**: `http://localhost:8080` (or `http://YOUR_SERVER_IP:8080`)
> - **Admin Panel**: `http://localhost:8080/cmsadmin` (configured via `ADMIN_DIR` in `.env`)

---

## Step 9: Production Nginx / Apache Setup

### Nginx Virtual Host Configuration:

```nginx
server {
    listen 80;
    server_name nirm.in www.nirm.in;
    root /var/www/nirm.in/public;

    index index.php index.html;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 🛠️ Troubleshooting Common Issues

### 1. Broken images or missing icons:
- Make sure `public/storage` has all images from production.
- If images 404, check that `APP_URL` in `.env` matches your browser URL (e.g. `APP_URL=http://localhost:8080`).

### 2. Permissions or Language Menu Missing in Admin Panel:
- Run the alignment script in [Step 6](#step-6-running-migrations--old-db-alignment).
- Run `php artisan optimize:clear`.
- **Log out** from `/cmsadmin` and **log back in** to refresh permissions.

### 3. `Permission denied` errors on `storage/` or `bootstrap/cache/`:
```bash
sudo chown -R $USER:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```
