# 🛠️ Admin Panel Guide

The NIRM CMS admin panel is a full-featured content management dashboard built on the Obii CMS Platform.

---

## Accessing the Admin Panel

| Item | Value |
|---|---|
| **URL** | `{APP_URL}/{ADMIN_DIR}` (default: `/cmsadmin`) |
| **Login** | Use CMS user credentials from the `users` table |

The admin URL is configured via the `ADMIN_DIR` environment variable in `.env`.

> **Security:** Change `ADMIN_DIR` from the default to a custom path to prevent automated attacks on `/admin`.

---

## Admin Panel Features

### Dashboard
- Site overview with key metrics
- Customizable dashboard widgets
- Recent activity log
- Quick access to content management

### Content Management

| Section | Description |
|---|---|
| **Pages** | Create/edit static pages with rich text editor |
| **Blog → Posts** | Write blog posts with categories and tags |
| **Blog → Categories** | Manage post categories (hierarchical) |
| **Blog → Tags** | Manage content tags |
| **Blocks** | Create reusable content blocks |
| **Sliders** | Manage image sliders/carousels |

### Media Manager
- Upload, organize, and manage files
- Folder-based organization
- Image thumbnail generation
- Drag-and-drop upload
- Access: **Admin → Media**

### Menus
- Visual drag-and-drop menu builder
- Multiple menu locations (header, footer)
- Supports pages, posts, custom links
- Access: **Admin → Appearance → Menus**

### Widgets
- Sidebar and footer widget management
- Drag-and-drop widget placement
- Access: **Admin → Appearance → Widgets**

### Theme Options
- Logo and favicon upload
- Social media links
- Footer text and copyright
- Color and layout options
- Access: **Admin → Appearance → Theme Options**

### Multi-Language
- Manage languages (English, Hindi, Kannada)
- Translate pages, posts, menus, and widgets
- Language switcher on the frontend
- Access: **Admin → Settings → Languages**

### Plugins
- Enable/disable installed plugins
- Plugin settings and configuration
- Access: **Admin → Plugins**

### Settings
- General site settings
- Email configuration
- Media upload settings
- SEO settings
- Access: **Admin → Settings**

### Users & Permissions
- Manage admin users
- Role-based access control (ACL)
- Access: **Admin → Users**

### System Tools

| Tool | Description |
|---|---|
| **Backup** | Create and download database/file backups |
| **Audit Log** | View all admin actions with timestamps |
| **SEO** | Configure meta tags, sitemap, robots.txt |
| **Analytics** | View Google Analytics data in dashboard |

---

## Common Admin Tasks

### Creating a New Page

1. Go to **Admin → Pages → Create**
2. Enter page title and content
3. Select a page template (default, homepage, form)
4. Set SEO meta title and description
5. Add custom fields if needed
6. Publish or save as draft

### Adding a Blog Post

1. Go to **Admin → Blog → Posts → Create**
2. Enter title, content, and featured image
3. Assign categories and tags
4. Configure SEO settings
5. Publish

### Translating Content

1. Create/edit a page or post
2. Click the language selector at the top
3. Switch to the target language
4. Enter translated content
5. Save — the slug is auto-generated for that language

### Managing the Contact Form

1. View submissions at **Admin → Contact**
2. Reply to contacts from the admin panel
3. Configure form settings (CAPTCHA, email notifications)

---

## Artisan Commands

| Command | Description |
|---|---|
| `php artisan cms:publish:assets` | Publish plugin/theme assets to `public/` |
| `php artisan cms:media:thumbnail:generate` | Regenerate media thumbnails |
| `php artisan cms:plugin:list` | List all plugins and their status |
| `php artisan cms:plugin:activate <name>` | Activate a plugin |
| `php artisan cms:plugin:deactivate <name>` | Deactivate a plugin |
| `php artisan cms:theme:create <name>` | Scaffold a new theme |
| `php artisan cms:plugin:create <name>` | Scaffold a new plugin |
