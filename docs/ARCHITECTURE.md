# 🏗️ Architecture Overview

NIRM CMS is built on the **Obii CMS Platform** — a modular Laravel-based content management system with a plugin/theme architecture.

---

## High-Level Architecture

```
┌─────────────────────────────────────────────────────┐
│                    NIRM CMS                         │
├─────────────────────────────────────────────────────┤
│  Theme Layer         │  platform/themes/nirm/       │
├──────────────────────┼──────────────────────────────┤
│  Plugin Layer        │  platform/plugins/*/          │
├──────────────────────┼──────────────────────────────┤
│  Package Layer       │  platform/packages/*/         │
├──────────────────────┼──────────────────────────────┤
│  Core CMS Platform   │  platform/core/              │
├──────────────────────┼──────────────────────────────┤
│  Laravel Framework   │  vendor/laravel/framework/   │
├──────────────────────┼──────────────────────────────┤
│  PHP 8.0 + SQLite / MySQL                           │
└─────────────────────────────────────────────────────┘
```

---

## Directory Structure

```
nirm-larvel/
├── app/                        # Laravel application code
│   ├── Console/                # Artisan commands
│   ├── Exceptions/             # Exception handlers
│   ├── Http/                   # Controllers, Middleware, Requests
│   │   └── Kernel.php          # HTTP middleware stack
│   ├── Models/                 # Eloquent models
│   └── Providers/              # Service providers
│
├── bootstrap/                  # Framework bootstrap files
│   └── cache/                  # Compiled framework files (auto-generated)
│
├── config/                     # All configuration files
│   ├── app.php                 # Application config (providers, aliases)
│   ├── auth.php                # Authentication guards & providers
│   ├── database.php            # Database connections
│   ├── filesystems.php         # Storage disks (local, S3)
│   ├── mail.php                # Mail drivers & settings
│   ├── queue.php               # Queue connections
│   ├── services.php            # Third-party service credentials
│   └── ...                     # (15 config files total)
│
├── database.sql                # Full database dump for import
│
├── platform/                   # ⭐ Obii CMS Platform (core application logic)
│   ├── core/                   # CMS core modules
│   │   ├── acl/                # Access Control List (users, roles, permissions)
│   │   ├── base/               # Base CMS functionality
│   │   ├── chart/              # Chart/analytics widgets
│   │   ├── dashboard/          # Admin dashboard
│   │   ├── js-validation/      # JavaScript validation
│   │   ├── media/              # Media manager (file uploads)
│   │   ├── setting/            # CMS settings management
│   │   ├── support/            # Helper utilities
│   │   └── table/              # DataTables integration
│   │
│   ├── packages/               # Reusable CMS packages
│   │   ├── api/                # REST API package
│   │   ├── menu/               # Menu management
│   │   ├── page/               # Page management
│   │   ├── plugin-management/  # Plugin lifecycle manager
│   │   ├── seo-helper/         # SEO meta tags
│   │   ├── shortcode/          # Shortcode system
│   │   ├── sitemap/            # Sitemap generator
│   │   ├── slug/               # URL slug management
│   │   ├── theme/              # Theme management
│   │   ├── widget/             # Widget system
│   │   ├── revision/           # Content revision history
│   │   ├── optimize/           # Performance optimization
│   │   └── (dev-only)/         # dev-tool, generators (not in production)
│   │
│   ├── plugins/                # Feature plugins (enable/disable via admin)
│   │   ├── analytics/          # Google Analytics integration
│   │   ├── audit-log/          # Action audit trail
│   │   ├── backup/             # Database/file backup
│   │   ├── block/              # Content blocks
│   │   ├── blog/               # Blog posts, categories, tags
│   │   ├── captcha/            # CAPTCHA for forms
│   │   ├── contact/            # Contact form
│   │   ├── custom-field/       # Custom fields for pages/posts
│   │   ├── information-section/# Info section content type
│   │   ├── language/           # Multi-language support
│   │   ├── slider/             # Image sliders/carousels
│   │   ├── terms-conditions/   # T&C pages
│   │   ├── twitterfeed/        # Twitter feed widget
│   │   └── visitors/           # Visitor tracking
│   │
│   └── themes/                 # Frontend themes
│       └── nirm/               # Active NIRM theme
│
├── public/                     # Web server document root
│   ├── assets/                 # Compiled CSS/JS assets
│   ├── themes/                 # Published theme assets
│   ├── index.php               # Application entry point
│   └── .htaccess               # Apache rewrite rules
│
├── routes/                     # Route definitions
│   ├── web.php                 # Web routes (empty — handled by CMS)
│   ├── api.php                 # API routes (empty — handled by API package)
│   ├── channels.php            # Broadcast channels
│   └── console.php             # Console commands
│
├── storage/                    # Generated files, logs, cache
│   ├── app/public/             # User uploads (symlinked to public/storage)
│   ├── framework/              # Cache, sessions, compiled views
│   └── logs/                   # Application logs
│
├── tests/                      # PHPUnit tests
│   ├── Feature/                # Feature/integration tests
│   └── Unit/                   # Unit tests
│
├── .env.example                # Environment template
├── .env.new                    # Alternative env config (reference)
├── .htaccess                   # Root rewrite → public/
├── artisan                     # Laravel CLI entry point
├── composer.json               # PHP dependencies
├── package.json                # Node.js dependencies
├── phpunit.xml                 # Test configuration
├── webpack.mix.js              # Asset build configuration
└── DEPLOYMENT.md               # Production deployment guide
```

---

## How the CMS Platform Works

### Composer Merge Plugin

The project uses `wikimedia/composer-merge-plugin` to automatically include `composer.json` files from:

- `platform/plugins/*/composer.json`
- `platform/themes/*/composer.json`

This means each plugin and theme can declare its own PHP dependencies.

### Local Repositories

The project's `composer.json` defines local path repositories:

```json
"repositories": [
    { "type": "path", "url": "./platform/core" },
    { "type": "path", "url": "./platform/packages/*" }
]
```

This allows `platform/core` and `platform/packages/*` to be loaded as Composer packages without publishing them to Packagist.

### Route Registration

Routes are **not** defined in the standard `routes/web.php` or `routes/api.php`. Instead:

- **Each plugin** registers its own routes via its service provider
- **The theme** registers frontend routes in `platform/themes/nirm/routes/web.php`
- **Core packages** register admin routes for pages, menus, settings, etc.

### Middleware Stack

The HTTP kernel uses standard Laravel middleware:

| Middleware | Purpose |
|---|---|
| `TrustProxies` | Handle proxy/load balancer headers |
| `HandleCors` | Cross-Origin Resource Sharing |
| `PreventRequestsDuringMaintenance` | Maintenance mode handler |
| `ValidatePostSize` | POST size validation |
| `TrimStrings` | Trim whitespace from input |
| `ConvertEmptyStringsToNull` | Normalize empty inputs |

---

## Key Obii CMS Packages

| Package | Namespace | Purpose |
|---|---|---|
| `obii/platform` | `Obii\Platform` | Core CMS boot and lifecycle |
| `obii/api` | `Obii\Api` | REST API endpoints |
| `obii/menu` | `Obii\Menu` | Menu builder and management |
| `obii/page` | `Obii\Page` | Page content management |
| `obii/theme` | `Obii\Theme` | Theme engine |
| `obii/shortcode` | `Obii\Shortcode` | Shortcode parser `[shortcode]` |
| `obii/plugin-management` | `Obii\PluginManagement` | Enable/disable plugins |
| `obii/optimize` | `Obii\Optimize` | Performance optimization |

---

## Request Lifecycle

```
Browser Request
    │
    ▼
public/index.php (or .htaccess → public/)
    │
    ▼
Laravel Bootstrap → Service Providers
    │
    ▼
Obii CMS Core loads → Registers plugins, themes, packages
    │
    ▼
Route Matching (plugin/theme routes)
    │
    ▼
Middleware Pipeline
    │
    ▼
Controller Action
    │
    ▼
Blade View (theme layout + partials)
    │
    ▼
HTML Response
```
