# ArtLine - Hostinger Deployment Guide

## Your Database Credentials
- **Database Name:** u549207068_artLineDB
- **Username:** u549207068_artLineUser
- **Password:** Hostinger@90949089
- **Host:** localhost
- **Domain:** https://createshop.link

## Deployment Steps

### 1. File Upload to Hostinger
1. Upload all project files to your `public_html` directory
2. If using a subdomain, upload to the appropriate subdirectory

### 2. Environment Configuration
1. Copy `.env.hostinger` to `.env` on your Hostinger server:
   ```bash
   cp .env.hostinger .env
   ```
2. Your database credentials are already configured in `.env.hostinger`

### 3. Install Dependencies (if needed)
```bash
composer install --no-dev --optimize-autoloader
```

### 4. Directory Permissions
Set the following directories to 755 permissions:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 5. Run Database Migrations
```bash
php artisan migrate --force
```

### 6. Generate Application Key (if needed)
```bash
php artisan key:generate --force
```

### 7. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 8. Document Root Configuration
Make sure your domain points to the `public` folder or move the contents accordingly.

## Local Development
For local development, the project is configured to use SQLite database.
- Use `.env` for local development (already configured)
- Use `.env.hostinger` for production deployment

## File Structure
- `.env` - Local development environment
- `.env.hostinger` - Production environment (ready for Hostinger)
- `hostinger-test.php` - Test your production configuration

## Important Security Notes
- Never commit `.env` files to version control
- Keep your database credentials secure
- Enable HTTPS on your domain
- Regularly backup your database

## Troubleshooting
- If you get 500 errors, check file permissions
- If database connection fails, verify credentials in Hostinger control panel
- Check error logs in `storage/logs/`
