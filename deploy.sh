#!/bin/bash

# ArtLine Deployment Script for Hostinger
# Run this script after uploading files to your hosting

echo "🚀 Deploying ArtLine to Hostinger..."

# Check if .env exists
if [ ! -f .env ]; then
    echo "❌ .env file not found. Please copy .env.example to .env and configure it first."
    exit 1
fi

# Install/update composer dependencies (if composer is available)
if command -v composer &> /dev/null; then
    echo "📦 Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader
else
    echo "⚠️  Composer not found. Please install dependencies manually."
fi

# Generate application key if not set
echo "🔑 Checking application key..."
php artisan key:generate --force

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Clear and cache configuration
echo "⚡ Optimizing application..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "🔒 Setting file permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ Deployment completed successfully!"
echo "🌐 Your ArtLine application should now be live!"

# Display important reminders
echo ""
echo "📋 Post-deployment checklist:"
echo "1. Verify database connection works"
echo "2. Test main application routes"
echo "3. Check error logs if any issues"
echo "4. Ensure HTTPS is configured"
echo "5. Set up regular backups"
