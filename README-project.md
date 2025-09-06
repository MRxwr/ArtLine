You are a senior Laravel architect. Extend and complete an existing Laravel + MySQL project into a production-ready multi-tenant e-commerce platform with one shared database (single schema) and per-store isolation via store_id. The platform has a public storefront and two admin panels:

Superdashboard (superadmin): full control, create/manage stores, see & restore soft-deleted data.

Dashboard (store client): manage only their store.

Tech & Conventions

Laravel 11, PHP 8.2+, MySQL 8.

Auth: Laravel Breeze (web) + Sanctum (SPA/API tokens). Superadmin is global; client roles are per store.

UI: Blade + Bootstrap 5 (via Vite). Fully responsive; no Tailwind.

Queues/Jobs: database driver for dev; abstract for Redis in prod.

Files: Storage facade (local in dev), S3-ready abstraction.

Validation: Form Requests. Policies/Gates for RBAC.

Testing: Pest (preferred) or PHPUnit. Feature tests for tenancy + voucher engine.

Quality: PHP-CS-Fixer config, Larastan (level 6+) optional.

Docs: OpenAPI (use darkaonline/l5-swagger) for API.

Multitenancy Rules

Single DB; every tenant-owned table includes store_id FK → stores.id.

All client routes/queries MUST be scoped by store_id.

Superadmin bypasses store_id scope.

Soft deletes (deleted_at) for tenant data; only superadmin can list/restore soft-deleted rows.

Storefront URLs: https://createshop.link/{storeSlug}.

Tenancy Implementation

Create a SetCurrentStore middleware that:

For client dashboard and API routes, resolves store_id from route param or session context and applies a global scope (TenantScope) to relevant models.

Superadmin routes skip the scope.

Provide WithoutTenantScope trait helper for superadmin services.

Entities & Migrations (minimum fields)

Create migrations, models, factories, seeders, policies, resources (API transformers), and repositories/services.

stores
id, slug(unique), title, busy:boolean, intl_shipping_method:ENUM('DHL','ARAMEX','COMPANY','NONE'), created_at, updated_at

users
id, name, email(unique), password, is_superadmin:boolean, created_at, updated_at

store_users (per-store membership)
id, store_id FK, user_id FK, role_id FK(nullable), created_at

roles (per store)
id, store_id FK, name
role_permissions (pivot)
role_id, permission (string; e.g., products.create)

(Alternatively you may use spatie/laravel-permission with a store_id column on roles & model_has_roles; ensure per-store scoping.)

categories (soft deletes)
id, store_id FK, logo_url, cover_url, title, subtitle(nullable), description(nullable), sort_order:int, active:boolean, deleted_at

banners (soft deletes)
id, store_id FK, title, image_url, video_youtube_id(nullable), link_url(nullable), show_as_popup:boolean, active:boolean, start_at:nullable, end_at:nullable, deleted_at

products (soft deletes)
id, store_id FK, title, details:text, images:json, main_image_index:int, video_url(nullable), price:decimal(12,2), cost:decimal(12,2), sku(varchar unique per store), height:decimal(8,2), width:decimal(8,2), weight:decimal(8,2), length:decimal(8,2), discount_amount:decimal(12,2) nullable, discount_type:ENUM('FIXED','PERCENT') nullable, active:boolean, deleted_at

Unique index (store_id, sku).

product_options (definition)
id, store_id FK, name, input_type:ENUM('LIST','TEXT'), required:boolean, text_price_delta:decimal(12,2) nullable

product_option_values
id, product_option_id FK, label, price_delta:decimal(12,2) default 0, sort_order:int

product_option_links (attach options to products)
id, product_id FK, product_option_id FK (allow reuse)

vouchers
id, store_id FK nullable (null = all stores), code(unique), start_date, end_date, usage_limit_total:int nullable, usage_limit_per_user:int nullable, discount_amount:decimal(12,2), discount_type:ENUM('FIXED','PERCENT'), applies_to:ENUM('CART_TOTAL','SELECTED_ITEMS','SELECTED_ITEMS_DOUBLE'), active:boolean

voucher_stores (when restricted)
voucher_id, store_id

voucher_products / voucher_categories (scoping for selected items)
voucher_id, product_id / voucher_id, category_id

orders (stub to validate voucher engine)
id, store_id, user_id nullable, subtotal:decimal, total_discount:decimal, total:decimal, created_at

audit_logs
id, actor_user_id, store_id nullable, entity_type, entity_id, action, before:json nullable, after:json nullable, created_at

Routing & Panels

Use route groups, middleware, and controllers.

Storefront (public):
GET /{storeSlug} (home: banners + categories)
GET /{storeSlug}/category/{id-or-slug}
GET /{storeSlug}/product/{id-or-slug}

Product page renders dynamic options:

LIST → radio/select; each value adds price_delta.

TEXT → free text; add text_price_delta if configured.

If product has video_url or banner has video_youtube_id, open Bootstrap modal with YouTube iframe.

Popup banner when show_as_popup=true (once per session).

Superdashboard (superadmin, no tenant scope):
GET /superdashboard … CRUD: stores, global users, soft-deleted viewer (with restore), impersonation (audited).

Dashboard (client, tenant-scoped):
GET /dashboard/{store} … sections for Categories, Banners, Products, Product Options, Vouchers, Employees (roles/permissions), Store Settings.
Actions supported everywhere: Edit / Add / Hide / Delete(soft).

API (Sanctum, /api) – mirror the controllers; expose Swagger.

RBAC

Policies per resource (CategoryPolicy, BannerPolicy, ProductPolicy, VoucherPolicy, EmployeePolicy, StoreSettingsPolicy).

Map CRUD abilities to permissions like categories.read, categories.create, categories.update, categories.delete, etc.

Superadmin bypasses; client permissions checked via store_users.role.permissions.

Controllers & Features (high level)

CRUD controllers for all resources with Form Requests for validation.

Soft Delete: ->delete() sets deleted_at; only superadmin routes can withTrashed()/onlyTrashed() and restore().

Hide: toggles active flag; hidden items don’t render on storefront.

Employees:

Create roles dynamically with a set of permissions.

Add employee (user) to store by email; attach role in store_users.

Store Settings: edit busy and intl_shipping_method.

If busy=true, storefront shows a “Store is busy” overlay and prevents checkout (stub); add <meta name="robots" content="noindex">.

Voucher Engine (Service + Tests)

Create App\Services\VoucherService with pure methods:

Eligibility

now ∈ [start_date, end_date]; active=true; within usage_limit_total and usage_limit_per_user (track via voucher_usages table or computed from orders in tests).

Scope

CART_TOTAL: apply discount on cart subtotal after product discounts.

SELECTED_ITEMS: apply on eligible items using original product price (ignore product discount).

SELECTED_ITEMS_DOUBLE: apply on eligible items using discounted product price (stack voucher after product discount).

Type

FIXED: subtract amount but never below 0.

PERCENT: round to 2 decimals; clamp so total never < 0.

Return a breakdown per line item + totals. Provide hooks to reserve/commit usage on order placement.

Price Computation

Product final price = base price − product discount (FIXED/PERCENT) + sum(option price_deltas).

Validate required options server-side; TEXT options allowed with text_price_delta added when present.

Provide a PricePreviewController@preview that accepts {product_id, selectedOptionValueIds[], textInputs[]}.

Bootstrap UI Details

Use Bootstrap modals for YouTube video on banners/products.

Popup banner (if show_as_popup) fires once per session (use session() flag).

CRUD UIs: collapsible forms, image previews, sortable lists for product images & option values.

Seeders

Create seeders to populate:

One superadmin, two sample stores (demo-shop, alpha-shop).

Roles per store: Manager, Editor, Viewer (with representative permissions).

Sample categories, products (with LIST & TEXT options), banners (one popup, one with video), vouchers for each applies_to variant (including SELECTED_ITEMS_DOUBLE).

One store with busy=true.

Testing (Pest)

Tenancy: attempts to access another store’s product via API must 404 or 403.

Soft delete visibility: client can’t see trashed items; superadmin can list & restore.

Voucher engine: matrix tests for (CART_TOTAL / SELECTED_ITEMS / SELECTED_ITEMS_DOUBLE) × (FIXED / PERCENT) with usage caps.

Price preview: correct deltas from options (LIST & TEXT) + discounts.

Deliverables

Migrations, Models (with relationships & casts), Factories, Seeders.

Middleware (SetCurrentStore), Global TenantScope, Policies & Gates.

Controllers (web + API), Form Requests, Resources (API transformers).

Blade views for Superdashboard and Dashboard (Bootstrap 5).

Storefront pages at /{storeSlug} with categories, product details, options, banners (popup + YouTube modal), cart with voucher field (mock checkout).

Swagger JSON via l5-swagger.

README with setup and env examples.

Representative Endpoints

Auth

POST /api/auth/login → {token, is_superadmin, roles}

POST /api/auth/logout

Stores

Superadmin: GET/POST/PATCH/DELETE /api/stores (soft delete + restore)

Public: GET /api/stores/{slug}/public → storefront config

Categories

GET /api/stores/{store}/categories (+includeHidden superadmin only)

POST /api/stores/{store}/categories

PATCH /api/stores/{store}/categories/{id}

DELETE /api/stores/{store}/categories/{id} (soft)

Products

Standard CRUD; image upload endpoints; (store_id, sku) unique.

POST /api/stores/{store}/products/{id}/options/link

POST /api/stores/{store}/products/{id}/price/preview

Banners

CRUD; popup + YouTube modal fields.

Vouchers

CRUD + linking to stores/products/categories.

POST /api/stores/{store}/vouchers/validate {code, cart, userId?}

Employees / Roles

POST /api/stores/{store}/roles (+ permissions)

POST /api/stores/{store}/employees (create/link user by email)

PATCH /api/stores/{store}/employees/{id}/role

Soft-Deleted Admin

Superadmin only: /api/admin/soft-deleted?entity=products|categories|... (+ restore)

Acceptance Criteria

Client users cannot access other stores’ data via API or web.

Soft-deleted entities invisible on storefront & client dashboard; visible & restorable on superdashboard.

Voucher engine passes all rule combinations, including SELECTED_ITEMS_DOUBLE stacking.

Price preview returns correct totals with options.

busy=true shows overlay & prevents checkout (stub).

All CRUD UIs responsive with Bootstrap 5.

Implementation Notes

Use Eloquent global scopes for tenancy; provide withoutGlobalScopes() in superadmin services.

Images: use spatie/laravel-medialibrary or simple disk storage with signed routes.

Add DB indexes: stores.slug, (store_id, sku), vouchers.code.

Audit every impersonation event by superadmin.

Prefer repository/service classes for voucher & pricing logic; keep controllers thin.

Build or refactor the Laravel app accordingly. Output changed files, scaffolding, and instructions to run seeds and tests.