# 🔧 Troubleshooting

Common issues and their solutions when running the NIRM CMS project.

---

## Installation Issues

### `composer install` fails with memory error

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

### `Class "XXX" not found` after installation

```bash
composer dump-autoload
php artisan package:discover
```

### `The stream or file "storage/logs/laravel.log" could not be opened`

**Cause:** Incorrect file permissions on the `storage/` directory.

```bash
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

### `No application encryption key has been specified`

```bash
php artisan key:generate
```

---

## Database Issues

### `Database file at path [...] does not exist` (SQLite)

**Cause:** The SQLite file has not been created or the path in `DB_DATABASE` is incorrect.

```bash
mkdir -p database
touch database/database.sqlite
```

> **Tip:** Set `DB_DATABASE` in `.env` to the full absolute path, e.g.:  
> `DB_DATABASE=/absolute/path/to/nirm-larvel/database/database.sqlite`

### `could not find driver (SQLSTATE[HY000])` (SQLite)

**Cause:** PHP PDO SQLite extension is not installed or enabled.

```bash
# Ubuntu/Debian
sudo apt install php8.0-sqlite3
```

### `SQLSTATE[HY000] [2002] Connection refused` (MySQL)

**Cause:** MySQL server is not running.

```bash
# Start MySQL
sudo systemctl start mysql
# OR
sudo service mysql start

# Verify it's running
sudo systemctl status mysql
```

### `SQLSTATE[HY000] [1045] Access denied for user`

**Cause:** Wrong database credentials in `.env`.

1. Verify credentials: `mysql -u root -p`
2. Check `.env` has the correct `DB_USERNAME` and `DB_PASSWORD`
3. Clear config cache: `php artisan config:clear`

### `SQLSTATE[42S01] Base table or view already exists`

**Cause:** Running migrations on a database that was imported from `database.sql`.

```bash
# Check which migrations have been recorded
php artisan migrate:status

# If needed, mark all as run without actually running them
# (only if tables already exist from the SQL import)
```

### Database import fails with encoding errors

```bash
# Force UTF-8 encoding during import
mysql -u root -p --default-character-set=utf8mb4 laravel_nirm_cms < database.sql
```

---

## Frontend Issues

### Blank white page / 500 error

1. Check the error log:
   ```bash
   tail -50 storage/logs/laravel-$(date +%Y-%m-%d).log
   ```
2. Enable debug mode temporarily:
   ```dotenv
   APP_DEBUG=true
   ```
3. Clear all caches:
   ```bash
   php artisan optimize:clear
   ```

### CSS/JS not loading

```bash
# Recompile assets
npm run dev

# Republish CMS assets
php artisan cms:publish:assets

# Clear view cache
php artisan view:clear
```

### Storage images not showing (broken image links)

```bash
# Create the storage symlink
php artisan storage:link

# Verify the symlink exists
ls -la public/storage
# Should show: public/storage -> /path/to/storage/app/public
```

### Thumbnails not generated

```bash
php artisan cms:media:thumbnail:generate
```

---

## Admin Panel Issues

### Cannot access admin panel (404)

1. Check `ADMIN_DIR` in `.env` matches the URL you're visiting
2. Clear route cache: `php artisan route:clear`
3. Try: `php artisan route:list --path=cmsadmin` to verify routes are registered

### Admin panel shows maintenance page

```bash
php artisan up
```

### "Page has expired" (419 error) on login

**Cause:** CSRF token mismatch, usually due to stale session.

```bash
php artisan cache:clear
php artisan config:clear
```

Also check that `SESSION_DRIVER` in `.env` is set correctly.

---

## Multi-Language Issues

### Translated slug gets `-1` or `-2` appended

This is a known issue with the slug generation. Check:
1. The `slugs` table for duplicate entries
2. The `language_meta` table for correct language associations

### Language switcher not showing

Ensure the Language plugin is activated:
```bash
php artisan cms:plugin:activate language
```

---

## Performance Issues

### Slow page loads

```bash
# Enable all production caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize composer autoloader
composer dump-autoload --optimize
```

### High memory usage

1. Check `storage/logs/` for large log files and clean old ones
2. Ensure `APP_DEBUG=false` in production
3. Consider using Redis for cache/session: `CACHE_DRIVER=redis`

---

## Server Configuration Issues

### Apache: `mod_rewrite` not working

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Ensure `.htaccess` is being read by adding to your Apache config:
```apache
<Directory /var/www/nirm.in/public>
    AllowOverride All
</Directory>
```

### Nginx: Routes return 404

Ensure your nginx config has:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## Useful Debug Commands

```bash
# View recent errors
tail -100 storage/logs/laravel-$(date +%Y-%m-%d).log

# Check route list
php artisan route:list

# Check loaded config
php artisan config:show database

# Interactive REPL for debugging
php artisan tinker

# Check PHP version and extensions
php -v
php -m

# Check database connection (SQLite / MySQL)
php artisan tinker --execute="DB::connection()->getPdo(); echo 'Connected to ' . config('database.default') . ' successfully!' . PHP_EOL;"

# Clear everything
php artisan optimize:clear
```

---

## Getting Help

1. Check `storage/logs/laravel-*.log` for error details
2. Enable `APP_DEBUG=true` temporarily to see full error pages
3. Search the Laravel documentation: https://laravel.com/docs/8.x
4. Check the Obii CMS documentation for platform-specific features
