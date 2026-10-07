# 🚀 NIRM.in — Safe Production Deployment Guide

This guide ensures you can deploy updates to your live production server **without losing live data, breaking user uploads, or experiencing downtime**.

---

## 📋 Pre-Flight Checklist

| Item | What to do | Why |
|---|---|---|
| **`.env`** | **NEVER overwrite** | Contains live DB passwords, production domain, APP_KEY |
| **`public/storage/`** | **NEVER delete or overwrite** | Contains live uploaded files, documents, and media |
| **Database** | **Always backup first** | Allows 1-click rollback if something unexpected happens |
| **`database/*.sqlite`** | **Do NOT copy to server** | Local test database only; server runs MariaDB/MySQL |

---

## 🛡️ Step 1: Create Full Backups on the Live Server

Before pulling any new code, SSH into your server and create a timestamped backup of the files and the database.

### 1.1 Create a Backup Folder
```bash
BACKUP_DIR=~/nirm_backups/backup_$(date +%Y%m%d_%H%M%S)
mkdir -p "$BACKUP_DIR"
```

### 1.2 Backup the Live Database (MySQL / MariaDB)
```bash
# Replace with your actual DB user and database name
mysqldump -u root -p laravel_nirm_cms > "$BACKUP_DIR/live_db_backup.sql"
```

### 1.3 Backup the `.env` and `public/storage`
```bash
# Backup the environment configuration
cp /var/www/nirm.in/.env "$BACKUP_DIR/.env.backup"

# Backup user uploads
cp -r /var/www/nirm.in/public/storage "$BACKUP_DIR/storage_backup"
```

---

## 🧪 Step 2: Safe Staging / Port Test (Recommended Before Going Live)

If you want to test the new code on a separate port before updating the live site:

### 2.1 Create a Temporary Test Database Copy
```bash
# Create a test database
mysql -u root -p -e "CREATE DATABASE nirm_test_db;"

# Import the live database backup into the test database
mysql -u root -p nirm_test_db < "$BACKUP_DIR/live_db_backup.sql"
```

### 2.2 Clone / Pull to a Test Directory
```bash
git clone <YOUR_GIT_REPO_URL> /var/www/nirm_test
cd /var/www/nirm_test

# Copy the server's .env to test, and change DB_DATABASE to nirm_test_db
cp /var/www/nirm.in/.env /var/www/nirm_test/.env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=nirm_test_db/' /var/www/nirm_test/.env

# Copy storage uploads
cp -r /var/www/nirm.in/public/storage /var/www/nirm_test/public/storage

# Install dependencies and migrate test DB
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan cms:publish:assets
php artisan cms:media:thumbnail:generate

# Start test server on port 8082
php artisan serve --host=0.0.0.0 --port=8082
```
*Visit `http://YOUR_SERVER_IP:8082` to verify everything works.*

---

## 🚀 Step 3: Deploy to the Live Production Site

Once verified (or ready to deploy):

```bash
cd /var/www/nirm.in

# 1. (Optional) Turn on maintenance mode so visitors see a clean maintenance page
php artisan down --message="Site is being updated, please check back in 2 minutes."

# 2. Pull the latest code
git pull origin master

# 3. Install/Update PHP packages
composer install --no-dev --optimize-autoloader

# 4. Run database migrations (only applies new tables/columns, never deletes data)
php artisan migrate --force

# 5. Publish theme & plugin assets (CSS, JS, Language files)
php artisan cms:publish:assets

# 6. Generate any missing media thumbnails (for admin media gallery)
php artisan cms:media:thumbnail:generate

# 7. Clear old cached views and configs
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 8. Optimize for production speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Bring the site back live
php artisan up
```

---

## ⏪ Step 4: Emergency Rollback (If Needed)

If an unexpected error occurs and you need to restore the live site immediately:

```bash
cd /var/www/nirm.in

# 1. Restore the code to the previous commit
git reset --hard HEAD@{1}

# 2. Restore the database from the backup taken in Step 1
mysql -u root -p laravel_nirm_cms < "$BACKUP_DIR/live_db_backup.sql"

# 3. Restore the .env
cp "$BACKUP_DIR/.env.backup" /var/www/nirm.in/.env

# 4. Clear cache and re-publish assets
php artisan optimize:clear
php artisan cms:publish:assets
php artisan up
```

---

## 🛠️ Post-Deployment Verification Checklist

1. [ ] **Homepage loads:** Check top bar language switcher (`English`, `हिन्दी`, `ಕನ್ನಡ`).
2. [ ] **Admin Login:** Check `/cmsadmin` login works.
3. [ ] **Media Gallery:** Go to `/cmsadmin/media` and check thumbnails show up properly.
4. [ ] **Page Translations:** Edit a page, check that saving a translated slug does not append `-1` or `-2`.
