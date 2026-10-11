# 🚀 Deployment Guide

This guide covers deploying NIRM CMS to a production Linux server.

> **Also see:** The original [DEPLOYMENT.md](../DEPLOYMENT.md) in the project root for a step-by-step deployment checklist with rollback procedures.

---

## Server Requirements

### Minimum Hardware

| Resource | Minimum | Recommended |
|---|---|---|
| **CPU** | 1 core | 2+ cores |
| **RAM** | 1 GB | 2+ GB |
| **Disk** | 10 GB | 20+ GB (depends on media uploads) |

### Required Software

| Software | Version |
|---|---|
| **PHP** | 8.0+ |
| **MySQL** or **MariaDB** | 8.0+ / 10.4+ |
| **Apache** or **Nginx** | 2.4+ / 1.18+ |
| **Composer** | 2.x |
| **Node.js** | 14+ (for building assets, not needed at runtime) |

### Required PHP Extensions

```
curl, json, zip, mbstring, xml, mysql (pdo_mysql), gd, bcmath, 
tokenizer, fileinfo, openssl, ctype
```

---

## Deployment Steps

### 1. Prepare the Server

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php8.0 php8.0-{curl,json,zip,mbstring,xml,mysql,gd,bcmath,tokenizer,fileinfo} \
    mysql-server apache2 libapache2-mod-php8.0 composer git

# Enable Apache modules
sudo a2enmod rewrite
sudo a2enmod headers
sudo systemctl restart apache2
```

### 2. Clone the Repository

```bash
cd /var/www
git clone <REPO_URL> nirm.in
cd nirm.in
```

### 3. Install Dependencies

```bash
# Production install (no dev dependencies)
composer install --no-dev --optimize-autoloader
```

### 4. Configure Environment

```bash
cp .env.example .env
nano .env
```

**Critical production settings:**
```dotenv
APP_DEBUG=false
APP_ENV=production
APP_URL=https://nirm.in

DB_DATABASE=laravel_nirm_cms
DB_USERNAME=nirm_db_user
DB_PASSWORD=strong_password

ADMIN_DIR=cmsadmin
```

```bash
php artisan key:generate
```

### 5. Setup Database

```bash
# Create database and user
mysql -u root -p << 'EOF'
CREATE DATABASE laravel_nirm_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'nirm_db_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON laravel_nirm_cms.* TO 'nirm_db_user'@'localhost';
FLUSH PRIVILEGES;
EOF

# Import database
mysql -u nirm_db_user -p laravel_nirm_cms < database.sql
```

### 6. Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/nirm.in
sudo chmod -R 755 /var/www/nirm.in
sudo chmod -R 775 /var/www/nirm.in/storage
sudo chmod -R 775 /var/www/nirm.in/bootstrap/cache
```

### 7. Create Storage Symlink

```bash
php artisan storage:link
```

### 8. Publish Assets

```bash
php artisan cms:publish:assets
php artisan cms:media:thumbnail:generate
```

### 9. Optimize for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Web Server Configuration

### Apache Virtual Host

```apache
<VirtualHost *:80>
    ServerName nirm.in
    ServerAlias www.nirm.in
    DocumentRoot /var/www/nirm.in/public

    <Directory /var/www/nirm.in/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/nirm-error.log
    CustomLog ${APACHE_LOG_DIR}/nirm-access.log combined
</VirtualHost>
```

Enable the site:
```bash
sudo a2ensite nirm.in.conf
sudo systemctl reload apache2
```

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name nirm.in www.nirm.in;
    root /var/www/nirm.in/public;
    index index.php;

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

## SSL/HTTPS Setup (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-apache   # For Apache
# OR
sudo apt install certbot python3-certbot-nginx     # For Nginx

sudo certbot --apache -d nirm.in -d www.nirm.in
# OR
sudo certbot --nginx -d nirm.in -d www.nirm.in
```

Update `.env`:
```dotenv
APP_URL=https://nirm.in
```

---

## Updating the Live Site

```bash
cd /var/www/nirm.in

# 1. Maintenance mode
php artisan down --message="Site is being updated."

# 2. Pull latest code
git pull origin master

# 3. Update dependencies
composer install --no-dev --optimize-autoloader

# 4. Run new migrations
php artisan migrate --force

# 5. Publish assets
php artisan cms:publish:assets
php artisan cms:media:thumbnail:generate

# 6. Clear and rebuild caches
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Go live
php artisan up
```

---

## Queue Workers (Optional)

The CMS uses database queue. To process queued jobs:

```bash
# Run queue worker
php artisan queue:work --daemon

# Supervisor config (recommended for production)
# /etc/supervisor/conf.d/nirm-worker.conf
[program:nirm-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/nirm.in/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/nirm.in/storage/logs/worker.log
stopwaitsecs=3600
```

---

## Scheduled Tasks (Cron)

Add to crontab for the web server user:

```bash
sudo crontab -u www-data -e
```

```cron
* * * * * cd /var/www/nirm.in && php artisan schedule:run >> /dev/null 2>&1
```

---

## Emergency Rollback

```bash
cd /var/www/nirm.in

# Revert code
git reset --hard HEAD@{1}

# Restore database from backup
mysql -u nirm_db_user -p laravel_nirm_cms < ~/nirm_backups/latest/live_db_backup.sql

# Restore .env
cp ~/nirm_backups/latest/.env.backup .env

# Clear cache and republish
php artisan optimize:clear
php artisan cms:publish:assets
php artisan up
```

---

## Post-Deployment Checklist

- [ ] Homepage loads correctly
- [ ] Language switcher works (English, हिन्दी, ಕನ್ನಡ)
- [ ] Admin login at `/cmsadmin` works
- [ ] Media gallery shows thumbnails
- [ ] Contact form submits successfully
- [ ] SSL certificate is active (HTTPS)
- [ ] Cron jobs are running
- [ ] Log files are being written to `storage/logs/`
