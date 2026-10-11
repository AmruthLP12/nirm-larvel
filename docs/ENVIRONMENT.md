# ⚙️ Environment Configuration

All environment variables are set in the `.env` file at the project root. This file is **never committed to Git** — use `.env.example` as a template.

---

## Creating Your `.env` File

```bash
cp .env.example .env
php artisan key:generate
```

---

## Variable Reference

### Application Settings

| Variable | Default | Description |
|---|---|---|
| `APP_NAME` | `"CMS"` | Application name shown in admin panel and emails |
| `APP_ENV` | `production` | Environment: `local`, `staging`, `production` |
| `APP_DEBUG` | `true` | **Set to `false` in production!** Shows detailed error pages |
| `APP_URL` | `http://localhost` | Full URL of the site (used for generating links, assets) |
| `APP_KEY` | (auto-generated) | Encryption key — run `php artisan key:generate` |
| `LOG_CHANNEL` | `daily` | Logging channel: `daily`, `single`, `stack`, `syslog` |

### Database

### Database Configuration

#### SQLite (Recommended for Local Development)

In `.env`, configure SQLite with:
```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/nirm-larvel/database/database.sqlite
```
*(If `DB_DATABASE` is left omitted or empty, Laravel defaults to `database/database.sqlite`).*

#### MySQL / MariaDB (Production)

| Variable | Default | Description |
|---|---|---|
| `DB_CONNECTION` | `sqlite` *(or `mysql`)* | Database driver: `sqlite`, `mysql`, `pgsql` |
| `DB_HOST` | `127.0.0.1` | Database server hostname (MySQL) |
| `DB_PORT` | `3306` | Database server port (MySQL) |
| `DB_DATABASE` | `database.sqlite` / `laravel` | Path to `.sqlite` file OR database name |
| `DB_USERNAME` | `root` | Database username (MySQL) |
| `DB_PASSWORD` | *(empty)* | Database password (MySQL) |
| `DB_STRICT` | `false` | MySQL strict mode (disable for CMS compatibility) |

### Cache & Sessions

| Variable | Default | Description |
|---|---|---|
| `BROADCAST_DRIVER` | `log` | Broadcast driver: `log`, `pusher`, `redis` |
| `CACHE_DRIVER` | `file` | Cache backend: `file`, `redis`, `memcached`, `array` |
| `QUEUE_CONNECTION` | `database` | Queue driver: `database`, `redis`, `sync`, `sqs` |
| `SESSION_DRIVER` | `file` | Session backend: `file`, `redis`, `database`, `cookie` |
| `SESSION_LIFETIME` | `120` | Session timeout in minutes |

### Redis (Optional)

| Variable | Default | Description |
|---|---|---|
| `REDIS_HOST` | `127.0.0.1` | Redis server hostname |
| `REDIS_PASSWORD` | `null` | Redis password (set `null` for no password) |
| `REDIS_PORT` | `6379` | Redis server port |

### CMS Admin Panel

| Variable | Default | Description |
|---|---|---|
| `ADMIN_DIR` | `admin` | Admin panel URL path. Set to `cmsadmin` to access at `/cmsadmin` |

> **⚠️ Security Tip:** Change `ADMIN_DIR` from the default `admin` to something less guessable. Do NOT use special characters.

### Campaign Settings

| Variable | Default | Description |
|---|---|---|
| `CAMPAIGN_IS_LOCAL` | `true` | Whether the campaign runs locally |

### Mail Configuration

| Variable | Default | Description |
|---|---|---|
| `MAIL_MAILER` | `smtp` | Mail driver: `smtp`, `mailgun`, `ses`, `sendgrid`, `log` |
| `MAIL_HOST` | `smtp.mailgun.org` | SMTP server hostname |
| `MAIL_PORT` | `587` | SMTP port |
| `MAIL_USERNAME` | *(empty)* | SMTP username |
| `MAIL_PASSWORD` | *(empty)* | SMTP password |
| `MAIL_ENCRYPTION` | `tls` | Encryption: `tls`, `ssl`, `null` |
| `MAIL_FROM_ADDRESS` | `info@livesmart.com` | Default sender email |
| `MAIL_FROM_NAME` | `LiveSmart Technologies LLC` | Default sender name |

### Mail Service Providers (Optional)

| Variable | Description |
|---|---|
| `MAILGUN_DOMAIN` | Mailgun domain |
| `MAILGUN_SECRET` | Mailgun API key |
| `SENDGRID_API_KEY` | SendGrid API key |
| `AWS_ACCESS_KEY_ID` | AWS access key (for SES) |
| `AWS_SECRET_ACCESS_KEY` | AWS secret key (for SES) |
| `AWS_DEFAULT_REGION` | AWS region (default: `us-east-1`) |

### AWS S3 Storage (Optional)

| Variable | Description |
|---|---|
| `FILESYSTEM_DRIVER` | Set to `s3` to use S3 storage (default: `local`) |
| `AWS_BUCKET` | S3 bucket name |
| `AWS_URL` | S3 bucket URL |
| `AWS_ENDPOINT` | Custom S3 endpoint (for S3-compatible services) |

---

## Example Configurations

### Local Development (with SQLite)

```dotenv
APP_NAME="NIRM CMS Dev"
APP_DEBUG=true
APP_ENV=local
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/nirm-larvel/database/database.sqlite

ADMIN_DIR=cmsadmin
CACHE_DRIVER=file
SESSION_DRIVER=file
MAIL_MAILER=log
```

*(Or for local MySQL testing, set `DB_CONNECTION=mysql`, `DB_DATABASE=laravel_nirm_cms`, `DB_USERNAME=root`, `DB_PASSWORD=root`)*

### Production Server

```dotenv
APP_NAME="NIRM"
APP_DEBUG=false
APP_ENV=production
APP_URL=https://nirm.in

DB_DATABASE=laravel_nirm_cms
DB_USERNAME=nirm_user
DB_PASSWORD=strong_secure_password_here

ADMIN_DIR=cmsadmin
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database

MAIL_MAILER=sendgrid
SENDGRID_API_KEY=SG.xxxxxxxxxxxxx
MAIL_FROM_ADDRESS=info@nirm.in
MAIL_FROM_NAME="NIRM"
```

---

## After Changing `.env`

Always clear the config cache after modifying environment variables:

```bash
php artisan config:clear
php artisan cache:clear

# For production, re-cache:
php artisan config:cache
```
