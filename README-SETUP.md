# ArtLine - Multi-Tenant E-commerce Platform

A production-ready Laravel 11 multi-tenant e-commerce platform with Filament admin panels, featuring per-store isolation, comprehensive product management, and advanced voucher system.

## 🚀 Quick Setup on Hostinger

### Prerequisites
- PHP 8.2+ with required extensions
- MySQL 8.0+
- Composer
- Node.js & NPM (for frontend assets)

### Step 1: SSH Connection
```bash
ssh -p 65002 u549207068@147.93.21.105
```

### Step 2: Navigate to Project Directory
```bash
cd /path/to/your/artline/project
```

### Step 3: Run Setup Script
```bash
chmod +x setup-artline.sh
./setup-artline.sh
```

Or run commands manually:

## 📦 Manual Installation Commands

### 1. Install Dependencies
```bash
composer require filament/filament:"^3.0"
composer require spatie/laravel-permission
composer require spatie/laravel-activitylog
composer require darkaonline/l5-swagger
composer require pestphp/pest --dev
composer require pestphp/pest-plugin-laravel --dev
```

### 2. Configure Laravel
```bash
php artisan key:generate
cp .env.hostinger .env
```

### 3. Install Filament
```bash
php artisan filament:install --panels
php artisan filament:panel superadmin
php artisan filament:panel admin
```

### 4. Publish Vendor Assets
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config"
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
```

### 5. Database Setup
```bash
php artisan migrate
php artisan create:superadmin admin@artline.com password123 "Super Admin"
php artisan db:seed
```

### 6. Generate Resources
```bash
php artisan make:filament-resource Store --panel=superadmin
php artisan make:filament-resource Category --panel=admin
php artisan make:filament-resource Banner --panel=admin
php artisan make:filament-resource Product --panel=admin
php artisan make:filament-resource ProductOption --panel=admin
php artisan make:filament-resource Voucher --panel=admin
php artisan make:filament-resource Order --panel=admin
```

### 7. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## 🏗️ Architecture Overview

### Multi-Tenancy Implementation
- **Single Database**: All tenants share one database
- **Store Isolation**: Every tenant-owned table includes `store_id` FK
- **Global Scoping**: Automatic filtering by current store context
- **Superadmin Bypass**: Global access for platform administrators

### Admin Panels
1. **Superadmin Panel** (`/superadmin`)
   - Full platform control
   - Store management
   - User management
   - System monitoring
   - Soft-deleted data restoration

2. **Store Admin Panel** (`/admin`)
   - Store-specific management
   - Product catalog
   - Category management
   - Order processing
   - Voucher management

### Storefront URLs
- Pattern: `https://createshop.link/{storeSlug}`
- Examples:
  - `https://createshop.link/demo-store`
  - `https://createshop.link/artisan-crafts`
  - `https://createshop.link/tech-gadgets`

## 🗃️ Database Schema

### Core Tables
- `stores` - Store configurations
- `users` - System users with superadmin flag
- `store_users` - Many-to-many store-user relationships
- `categories` - Product categories (tenant-scoped)
- `products` - Product catalog (tenant-scoped)
- `banners` - Promotional banners (tenant-scoped)
- `vouchers` - Discount vouchers with flexible scoping
- `orders` - Order tracking (tenant-scoped)
- `audit_logs` - System activity logging

### Product Options System
- `product_options` - Option definitions (List/Text)
- `product_option_values` - Predefined option values
- `product_option_links` - Product-option associations

### Voucher System
- `voucher_stores` - Store-specific voucher restrictions
- `voucher_products` - Product-specific vouchers
- `voucher_categories` - Category-specific vouchers

## 🔌 API Endpoints

### Public Storefront API
```
GET /api/stores/{store}                    # Store details
GET /api/stores/{store}/categories         # Store categories
GET /api/stores/{store}/products           # Store products
GET /api/stores/{store}/products/{product} # Product details
POST /api/stores/{store}/vouchers/validate # Voucher validation
```

### Protected Admin API
```
# Store Management (Requires Authentication + Store Access)
POST   /api/admin/stores/{store}/categories
GET    /api/admin/stores/{store}/categories
PUT    /api/admin/stores/{store}/categories/{category}
DELETE /api/admin/stores/{store}/categories/{category}

# Similar patterns for products, vouchers, etc.
```

## 🎛️ Key Features

### Multi-Tenant Features
- ✅ Single database with tenant isolation
- ✅ Store-specific admin panels
- ✅ Automatic tenant scoping
- ✅ Superadmin global access
- ✅ Soft deletes with restoration

### Product Management
- ✅ Rich product catalog
- ✅ Image galleries with main image selection
- ✅ Dynamic pricing with discounts
- ✅ Flexible product options (List/Text types)
- ✅ Category associations
- ✅ SKU uniqueness per store

### Voucher Engine
- ✅ Percentage and fixed discounts
- ✅ Cart total or item-specific vouchers
- ✅ Usage limits (total and per-user)
- ✅ Date-based validity
- ✅ Store-specific or global scope
- ✅ Product/category targeting

### Banner System
- ✅ Image and YouTube video support
- ✅ Popup banners with session control
- ✅ Link attachments for CTAs
- ✅ Scheduled display (start/end dates)
- ✅ Active/inactive status

## 🔐 Authentication & Authorization

### User Types
- **Superadmin**: Platform-wide access, can manage all stores
- **Store Admin**: Limited to assigned store(s)
- **Store User**: Basic store access

### Middleware
- `tenant`: Sets current store context
- `superadmin`: Restricts to superadmin users
- Standard Laravel auth middleware

## 🛠️ Development Tools

### Code Quality
- **PHP-CS-Fixer**: Code style enforcement
- **Larastan**: Static analysis (Level 6+)
- **Pest**: Testing framework

### API Documentation
- **L5-Swagger**: OpenAPI documentation
- Auto-generated from annotations
- Available at `/api/documentation`

### Testing
- Feature tests for tenancy isolation
- Voucher engine validation tests
- API endpoint coverage

## 📱 Frontend Stack

### Technologies
- **Laravel Blade**: Server-side templating
- **Bootstrap 5**: Responsive UI framework
- **Vite**: Asset bundling and HMR
- **Vanilla JS**: Minimal JavaScript footprint

### Responsive Design
- Mobile-first approach
- Touch-friendly interfaces
- Progressive enhancement

## 🔄 Deployment Workflow

### Environment Configuration
1. Copy `.env.hostinger` to `.env`
2. Update database credentials
3. Set proper APP_URL and domain
4. Configure mail settings

### Production Optimizations
- Route caching
- Configuration caching
- View compilation
- Composer optimization
- File permission setup

## 📊 Monitoring & Logging

### Activity Logging
- User actions tracked via `audit_logs`
- Entity changes (before/after states)
- Store-specific activity isolation
- Superadmin can view all activities

### Error Handling
- Laravel's built-in error handling
- Environment-specific logging levels
- Production-safe error pages

## 🎯 Access URLs

### Production URLs
- **Storefront**: `https://createshop.link/{store-slug}`
- **Super Admin**: `https://createshop.link/superadmin`
- **Store Admin**: `https://createshop.link/admin`
- **API Docs**: `https://createshop.link/api/documentation`

### Default Credentials
- **Super Admin**: `admin@artline.com` / `password123`
- **Demo Store**: Available after seeding

## 🔧 Customization Guide

### Adding New Tenant-Scoped Models
1. Add `store_id` foreign key to migration
2. Use `TenantScoped` trait in model
3. Include in `TenantScope` if needed
4. Create Filament resources with proper panel assignment

### Extending Voucher Engine
1. Add new `applies_to` enum values
2. Update voucher validation logic
3. Implement frontend integration
4. Add corresponding tests

### Custom Storefront Themes
1. Create theme-specific Blade layouts
2. Override CSS variables for branding
3. Add store-specific asset compilation
4. Implement theme switching logic

## 📞 Support & Documentation

### Resources
- Laravel 11 Documentation
- Filament v3 Documentation  
- Spatie Packages Documentation
- Bootstrap 5 Reference

### Common Tasks
- Store creation and configuration
- User management and roles
- Product catalog management
- Voucher campaign setup
- Order processing workflows

---

Built with ❤️ using Laravel 11, Filament v3, and modern web technologies.
