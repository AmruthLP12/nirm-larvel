# 🔌 Plugin Reference

NIRM CMS uses a modular plugin system managed by the **Obii Plugin Management** package. Plugins can be enabled/disabled from the CMS admin panel.

---

## Installed Plugins

All plugins are located in `platform/plugins/`.

### Content Plugins

| Plugin | Directory | Description |
|---|---|---|
| **Blog** | `blog/` | Full blogging system with posts, categories, tags. Handles blog listing, single post views, category/tag archives. |
| **Block** | `block/` | Reusable content blocks that can be placed anywhere on the site using shortcodes. |
| **Custom Field** | `custom-field/` | Add custom fields to pages, posts, and other content types. Similar to ACF (Advanced Custom Fields) in WordPress. |
| **Slider** | `slider/` | Image sliders and carousels for hero sections and galleries. |
| **Information Section** | `information-section/` | Dedicated content type for information sections/panels. |
| **Terms & Conditions** | `terms-conditions/` | Manage and display terms & conditions, privacy policies, and legal pages. |

### Communication Plugins

| Plugin | Directory | Description |
|---|---|---|
| **Contact** | `contact/` | Contact form with submission management. Admin can view and reply to submissions from the CMS dashboard. |
| **Captcha** | `captcha/` | CAPTCHA integration for forms to prevent spam submissions. |

### Multilingual

| Plugin | Directory | Description |
|---|---|---|
| **Language** | `language/` | Multi-language support for all content types. Manages language switcher (English, हिन्दी, ಕನ್ನಡ), content translations, and language-specific slugs. |

### Analytics & Monitoring

| Plugin | Directory | Description |
|---|---|---|
| **Analytics** | `analytics/` | Google Analytics integration for the admin dashboard. Displays traffic metrics and page views. |
| **Visitors** | `visitors/` | Built-in visitor tracking and statistics. |
| **Audit Log** | `audit-log/` | Tracks all admin actions (create, edit, delete) with user, IP, and timestamp details. |

### Social & Feeds

| Plugin | Directory | Description |
|---|---|---|
| **Twitter Feed** | `twitterfeed/` | Embed and display Twitter/X feeds on the site. |

### System Plugins

| Plugin | Directory | Description |
|---|---|---|
| **Backup** | `backup/` | Database and file backup utility accessible from the admin panel. |

---

## Managing Plugins

### Via Admin Panel

Navigate to **Admin → Plugins** to enable/disable plugins with a toggle switch.

### Via Artisan CLI

```bash
# List all plugins
php artisan cms:plugin:list

# Activate a plugin
php artisan cms:plugin:activate <plugin-name>

# Deactivate a plugin
php artisan cms:plugin:deactivate <plugin-name>

# Remove a plugin
php artisan cms:plugin:remove <plugin-name>
```

---

## Plugin Structure

Each plugin follows this standard structure:

```
platform/plugins/<plugin-name>/
├── composer.json           # Plugin metadata and dependencies
├── config/                 # Plugin configuration
├── database/
│   └── migrations/         # Plugin database migrations
├── helpers/                # Helper functions
├── resources/
│   ├── lang/               # Translation files
│   └── views/              # Blade templates
├── routes/
│   └── web.php             # Plugin routes
├── src/
│   ├── Http/
│   │   ├── Controllers/    # Plugin controllers
│   │   └── Requests/       # Form request validators
│   ├── Models/             # Eloquent models
│   ├── Providers/          # Service providers
│   ├── Repositories/       # Repository pattern implementations
│   └── Plugin.php          # Plugin activation/deactivation hooks
└── webpack.mix.js          # Plugin asset compilation (optional)
```

---

## Creating a New Plugin

Use the plugin generator (dev dependency):

```bash
php artisan cms:plugin:create <plugin-name>
```

This scaffolds a new plugin with all necessary directories and files.
