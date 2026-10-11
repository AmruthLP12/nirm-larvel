# 📚 NIRM CMS — Project Documentation

**NIRM** is a multi-language CMS (Content Management System) built on **Laravel 8** using the **Obii CMS Platform (v5.21)**. It powers [nirm.in](http://nirm.in) with support for English, Hindi (हिन्दी), and Kannada (ಕನ್ನಡ).

---

## Documentation Index

| Document | Description |
|---|---|
| [Getting Started](./GETTING_STARTED.md) | Prerequisites, installation, and first run |
| [Environment Configuration](./ENVIRONMENT.md) | `.env` variables reference and setup |
| [Architecture Overview](./ARCHITECTURE.md) | Project structure, platform/plugin/theme system |
| [Database Guide](./DATABASE.md) | Schema, tables, import/export, and migrations |
| [Plugin Reference](./PLUGINS.md) | All installed plugins and their purpose |
| [Theme Development](./THEME.md) | NIRM theme structure, layouts, and customization |
| [Asset Compilation](./ASSETS.md) | Webpack Mix, npm scripts, CSS/JS build pipeline |
| [Deployment Guide](./DEPLOYMENT.md) | Production deployment, staging, and rollback |
| [Admin Panel](./ADMIN_PANEL.md) | CMS admin usage, routes, and features |
| [API Reference](./API.md) | Available API endpoints and integrations |
| [Troubleshooting](./TROUBLESHOOTING.md) | Common issues and fixes |

---

## Quick Start (TL;DR)

```bash
# 1. Clone the repo
git clone <REPO_URL> nirm-larvel && cd nirm-larvel

# 2. Install PHP dependencies
composer install

# 3. Setup environment
cp .env.example .env
# Edit .env with your database credentials

# 4. Generate app key
php artisan key:generate

# 5. Setup SQLite database
touch database/database.sqlite
php artisan migrate

# 6. Create storage symlink
php artisan storage:link

# 7. Install Node dependencies & build assets
npm install && npm run dev

# 8. Run the development server
php artisan serve
```

> **Tip:** If using MySQL instead of SQLite, see the [Database Guide](./DATABASE.md) or import `database.sql` directly.

Visit `http://127.0.0.1:8000` for the site and `http://127.0.0.1:8000/cmsadmin` for the admin panel.

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | Laravel 8.12+ |
| **PHP** | 7.3+ / 8.0+ (platform target: 8.0.30) |
| **CMS Platform** | Obii CMS Core v5.21 |
| **Database** | SQLite (default/recommended for quick start) / MySQL 8.0 / MariaDB |
| **Frontend** | Vue.js 2, Bootstrap 4, jQuery, SASS |
| **Build Tool** | Laravel Mix 6 (Webpack) |
| **Mail** | SMTP, Mailgun, SendGrid, SES, SparkPost |
| **Storage** | Local filesystem / AWS S3 |
| **Cache** | File (default) / Redis (available) |
| **Queue** | Database driver |
