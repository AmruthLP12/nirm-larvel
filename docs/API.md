# 🔗 API Reference

The NIRM CMS includes a REST API package (`obii/api`) for programmatic access to CMS content.

---

## Overview

The API is provided by the `platform/packages/api/` package and uses Laravel's built-in API routing with OAuth2 authentication (via Laravel Passport).

> **Note:** The main `routes/api.php` file is empty — API routes are registered by the `obii/api` package service provider.

---

## Authentication

The API uses OAuth2 tokens via **Laravel Passport**. The database includes OAuth tables:

- `oauth_access_tokens`
- `oauth_auth_codes`
- `oauth_clients`
- `oauth_personal_access_clients`
- `oauth_refresh_tokens`

### Getting an Access Token

```bash
# Personal Access Token (for testing/development)
php artisan passport:client --personal

# Use the token in requests
curl -H "Authorization: Bearer YOUR_TOKEN" \
     https://nirm.in/api/v1/pages
```

---

## Available Endpoints

The Obii API package typically provides these RESTful endpoints:

### Pages

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/pages` | List all published pages |
| `GET` | `/api/v1/pages/{id}` | Get a specific page |

### Blog Posts

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/posts` | List all published posts |
| `GET` | `/api/v1/posts/{id}` | Get a specific post |

### Categories

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/categories` | List all categories |
| `GET` | `/api/v1/categories/{id}` | Get a specific category |

### Tags

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/tags` | List all tags |
| `GET` | `/api/v1/tags/{id}` | Get a specific tag |

### Menus

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/menus` | List all menus |
| `GET` | `/api/v1/menus/{id}` | Get menu with items |

---

## Third-Party Integrations

### Email Services

The CMS supports multiple email providers configured via `.env`:

| Service | Package | Config Key |
|---|---|---|
| **SMTP** | Built-in | `MAIL_MAILER=smtp` |
| **Mailgun** | `mailgun/mailgun-php` | `MAIL_MAILER=mailgun` |
| **SendGrid** | `sendgrid/sendgrid` | `MAIL_MAILER=sendgrid` |
| **AWS SES** | `aws/aws-sdk-php` | `MAIL_MAILER=ses` |
| **SparkPost** | `sparkpost/sparkpost` | `MAIL_MAILER=sparkpost` |

### AWS S3

File storage can be configured to use S3:
- Package: `league/flysystem-aws-s3-v3`
- Set `FILESYSTEM_DRIVER=s3` in `.env`

### Google Analytics

The analytics plugin integrates Google Analytics data into the admin dashboard.

### SNS (Amazon Simple Notification Service)

The project includes `aws/aws-php-sns-message-validator` for validating SNS notifications.

---

## Discovering Routes

To see all registered API routes:

```bash
php artisan route:list --path=api
```
