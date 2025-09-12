# Frontend scaffold (local) – Do not commit

Date: 2025-08-14
Scope: temp/ Bootstrap e-commerce UI wired to requests/store APIs

## Files added/updated (temp/)
- index.html: Header/navbar, banners carousel, categories & brands sliders, best sellers and recent grids, footer.
- assets/css/styles.css: Responsive product grid (2/3/4), utilities.
- assets/js/app.js: API wrapper, auth token storage, product card renderer, header init.
- assets/js/home.js: Loads home sections via `endpoint=Home`.
- categories.html: Renders categories from `endpoint=Categories`.
- brands.html: Renders brands from `endpoint=Brands`.
- search.html: Filterable results using `endpoint=Search` (POST), supports brand/category/keyword, paging.
- product.html: Details + images/variants/related via `endpoint=Product` (POST id), add-to-cart via `endpoint=Cart&action=1`.
- login.html: `endpoint=User&action=login` with email/password.
- register.html: `endpoint=User&action=register` with required fields.
- forgot.html: `endpoint=User&action=forgot`.
- profile.html: View/update profile; addresses list/add/setDefault/delete via `endpoint=Address` actions.
- orders.html: List/filter orders via `endpoint=Order` actions.
- order-view.html: View order summary via `endpoint=Order&action=view`.
- checkout.html: Addresses, payment methods, voucher, submit order via `endpoint=SubmitOrder`.

## API endpoints used
- Home, Categories, Brands, Search, Product
- Cart (actions 1=add, 5=list)
- User (login, register, forgot, profile, logout)
- Address (list, add, setDefault, delete)
- PaymentMethods (list)
- Voucher (POST code)
- SubmitOrder (POST)
- Order (list, view, filter)

## Notes
- Responsive product grid: mobile 2, tablet 3, desktop 4 (CSS grid).
- Uses Bootstrap 5 + Bootstrap Icons CDN; no build step required.
- Token stored in localStorage `coeo_token`.
- Language param set to `en` in requests.
- Minimal SEO on pages (titles + meta descriptions).

## Follow-ups
- Add favorites (endpoint=Favo) toggles on cards.
- Add payment result pages (success/failure) using Order actions.
- Improve error/loading states and i18n.
