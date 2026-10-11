# 🗄️ Database Guide

NIRM CMS supports both **SQLite** (lightweight, zero-configuration, ideal for local development and testing) and **MySQL / MariaDB** (standard for production).

---

## Database Setup

### Option 1: SQLite (Recommended for Local Development)

SQLite stores the entire database in a single local file, eliminating the need to install or run a separate database server.

#### 1. Create the Database File
```bash
# Ensure the database directory exists
mkdir -p database

# Create the SQLite file
touch database/database.sqlite
```

#### 2. Configure `.env`
Set the database connection in `.env`:
```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/nirm-larvel/database/database.sqlite
```
> **Note:** Providing the full absolute path in `DB_DATABASE` prevents path resolution issues across Artisan CLI and web requests.

#### 3. Run Migrations
```bash
php artisan migrate
```

---

### Option 2: MySQL / MariaDB (Production / Full Dump Import)

The repository provides a full dump `database.sql` (≈350 KB) captured from MySQL 8.0.34.

#### 1. Create the Database
```bash
mysql -u root -p -e "CREATE DATABASE laravel_nirm_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

#### 2. Import the Database Dump
```bash
mysql -u root -p laravel_nirm_cms < database.sql
```

#### 3. Configure `.env`
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_nirm_cms
DB_USERNAME=root
DB_PASSWORD=your_password
DB_STRICT=false
```

---

## Database Tables (56 tables)

### Core CMS Tables

| Table | Description |
|---|---|
| `users` | Admin/CMS users |
| `user_meta` | Extended user profile data |
| `activations` | User activation tokens |
| `roles` | User roles (admin, editor, etc.) |
| `role_users` | Role-to-user assignments |
| `password_resets` | Password reset tokens |
| `personal_access_tokens` | API tokens (Sanctum) |
| `settings` | CMS global settings (key-value) |
| `meta_boxes` | Generic metadata storage |
| `migrations` | Laravel migration history |

### Content Tables

| Table | Description |
|---|---|
| `pages` | CMS pages (static content) |
| `posts` | Blog posts |
| `categories` | Blog/post categories |
| `tags` | Content tags |
| `post_categories` | Post ↔ Category pivot |
| `post_tags` | Post ↔ Tag pivot |
| `slugs` | URL slugs for all content types |
| `revisions` | Content revision history |
| `blocks` | Reusable content blocks |
| `galleries` | Image galleries |
| `gallery_meta` | Gallery metadata |

### Menu & Navigation

| Table | Description |
|---|---|
| `menus` | Menu definitions |
| `menu_nodes` | Menu items (tree structure) |
| `menu_locations` | Menu placement locations |

### Media

| Table | Description |
|---|---|
| `media_files` | Uploaded files metadata |
| `media_folders` | Media folder structure |
| `media_settings` | Media library settings |

### Forms & Contact

| Table | Description |
|---|---|
| `contacts` | Contact form submissions |
| `contact_replies` | Admin replies to contacts |
| `forms` | Custom form definitions |
| `form_submits` | Custom form submissions |
| `form_types` | Form type definitions |
| `get_in_touch_replies` | Get-in-touch form replies |
| `subscribes` | Newsletter subscribers |

### Custom Fields

| Table | Description |
|---|---|
| `custom_fields` | Custom field values |
| `field_groups` | Field group definitions |
| `field_items` | Individual field definitions |

### Multi-Language

| Table | Description |
|---|---|
| `languages` | Configured languages |
| `language_meta` | Content translation mappings |
| `translations` | Translation strings |

### Dashboard & Analytics

| Table | Description |
|---|---|
| `dashboard_widgets` | Dashboard widget definitions |
| `dashboard_widget_settings` | Widget configuration |
| `sliders` | Slider/carousel data |
| `widgets` | Sidebar/footer widgets |

### Authentication & API

| Table | Description |
|---|---|
| `oauth_access_tokens` | OAuth2 access tokens |
| `oauth_auth_codes` | OAuth2 authorization codes |
| `oauth_clients` | OAuth2 registered clients |
| `oauth_personal_access_clients` | Personal access clients |
| `oauth_refresh_tokens` | OAuth2 refresh tokens |
| `members` | Frontend member accounts |
| `member_activity_logs` | Member activity history |
| `member_password_resets` | Member password resets |

### System

| Table | Description |
|---|---|
| `audit_histories` | Admin action audit trail |
| `request_logs` | HTTP request logs |
| `jobs` | Queue jobs |
| `failed_jobs` | Failed queue jobs |

---

## Backup & Restore

### SQLite Backup & Restore

Since SQLite is a single file, backup and restore are as simple as copying the file:

```bash
# Backup SQLite database
cp database/database.sqlite database/backup_$(date +%Y%m%d_%H%M%S).sqlite

# Restore SQLite database
cp database/backup_20241011_120000.sqlite database/database.sqlite
```

### MySQL Backup & Restore

```bash
# Full backup with data
mysqldump -u root -p laravel_nirm_cms > backup_$(date +%Y%m%d_%H%M%S).sql

# Schema only (no data)
mysqldump -u root -p --no-data laravel_nirm_cms > schema_only.sql

# Restore from backup
mysql -u root -p laravel_nirm_cms < backup_20241011_120000.sql
```

---

## Migrations

While the project includes a `database.sql` dump, the CMS platform also uses Laravel migrations. To run pending migrations:

```bash
# Check migration status
php artisan migrate:status

# Run new migrations
php artisan migrate

# Run in production (skip confirmation)
php artisan migrate --force
```

> **⚠️ Warning:** Never run `migrate:fresh` or `migrate:reset` on a production database — these commands DROP ALL TABLES.

---

## Key Relationships

```
users ──── role_users ──── roles
  │
  ├──── pages ──── slugs
  │                  │
  │              language_meta ──── languages
  │
  ├──── posts ──── post_categories ──── categories
  │          │
  │          └──── post_tags ──── tags
  │
  └──── media_files ──── media_folders
```
