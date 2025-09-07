#!/bin/bash

# ArtLine Multi-Tenant E-commerce Platform Setup Script
# Run this script on your Hostinger server after SSH connection

echo "🚀 Setting up ArtLine Multi-Tenant E-commerce Platform..."

# Step 1: Install Composer packages
echo "📦 Installing required packages..."
composer require filament/filament:"^3.0" --no-interaction
composer require spatie/laravel-permission --no-interaction
composer require spatie/laravel-activitylog --no-interaction
composer require darkaonline/l5-swagger --no-interaction
composer require pestphp/pest --dev --no-interaction
composer require pestphp/pest-plugin-laravel --dev --no-interaction

# Step 2: Setup Laravel
echo "🔧 Setting up Laravel..."
php artisan key:generate --force

# Step 3: Install and configure Filament
echo "🎨 Installing Filament..."
php artisan filament:install --panels --no-interaction

# Step 4: Publish vendor configs
echo "📄 Publishing vendor configurations..."
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --no-interaction
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations" --no-interaction
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config" --no-interaction
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider" --no-interaction

# Step 5: Create Filament panels
echo "🏗️ Creating Filament panels..."
php artisan filament:panel superadmin --no-interaction
php artisan filament:panel admin --no-interaction

# Step 6: Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Step 7: Create super admin user
echo "👤 Creating super admin user..."
php artisan create:superadmin "admin@artline.com" "password123" "Super Admin"

# Step 8: Seed database
echo "🌱 Seeding database..."
php artisan db:seed

# Step 9: Generate API documentation
echo "📚 Generating API documentation..."
php artisan l5-swagger:generate

# Step 10: Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev

# Step 11: Set permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "✅ ArtLine setup completed successfully!"
echo ""
echo "🌐 Access URLs:"
echo "   Storefront: https://createshop.link/{store-slug}"
echo "   Super Admin: https://createshop.link/superadmin"
echo "   Store Admin: https://createshop.link/admin"
echo ""
echo "🔑 Super Admin Credentials:"
echo "   Email: admin@artline.com"
echo "   Password: password123"
echo ""
echo "📖 API Documentation: https://createshop.link/api/documentation"
