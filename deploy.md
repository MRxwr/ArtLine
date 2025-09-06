# ArtLine - Hostinger Deployment Guide

## Prerequisites
1. Hostinger hosting account with PHP 8.1+ support
2. MySQL database created in Hostinger control panel
3. Domain configured to point to your hosting

## Deployment Steps

### 1. Database Setup
1. Log into your Hostinger control panel
2. Create a new MySQL database
3. Note down the database credentials:
   - Database name
   - Database username
   - Database password
   - Database host (usually localhost)

### 2. File Upload
1. Upload all project files to your hosting directory (usually `public_html`)
2. If uploading to subdirectory, upload to `public_html/artline`

### 3. Environment Configuration
1. Update `.env` file with your actual database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_actual_database_name
   DB_USERNAME=your_actual_username
   DB_PASSWORD=your_actual_password
   ```

2. Update your domain URL:
   ```
   APP_URL=https://yourdomain.com
   ```

3. Generate a new application key:
   ```bash
   php artisan key:generate
   ```

### 4. Directory Permissions
Set the following directories to 755 permissions:
- `storage/`
- `storage/logs/`
- `storage/framework/`
- `storage/framework/cache/`
- `storage/framework/sessions/`
- `storage/framework/views/`
- `bootstrap/cache/`

### 5. Run Migrations
```bash
php artisan migrate --force
```

### 6. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 7. Document Root Configuration
If your domain points to the root directory, you'll need to either:
1. Move the contents of the `public` folder to the root and adjust paths in `index.php`
2. Or configure your domain to point to the `public` folder

## Important Notes
- Keep `.env` file secure and never commit it to version control
- Enable HTTPS in production
- Regularly backup your database
- Monitor error logs in `storage/logs/`

## Troubleshooting
- If you get 500 errors, check file permissions
- If database connection fails, verify credentials
- If routes don't work, ensure mod_rewrite is enabled
