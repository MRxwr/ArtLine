# Coeo App Store API – Internal Audit (2025-08-14)

This document captures the current architecture, endpoint behaviors, helper conventions, data flow, issues, and actionable recommendations for the PHP Store API under `requests/store`.


## 1) High-level architecture

- Entry point: `requests/store/index.php`
  - Selects language context from `?language=en|ar` and sets field aliases:
    - `titleDB`: `enTitle|arTitle`
    - `detailsDB`: `enDetails|arDetails`
    - `preorderDB`: `preorderText|preorderTextAr`
    - `aboutDB`, `termsDB`, `policyDB` similarly
  - Auth: pulls bearer token from `Authorization` header (strips `Bearer `) to `$token`.
  - Routing: loads `views/api{Endpoint}.php` via `searchFile('views', 'api{$_GET["endpoint"]}.php')`.
- Includes: `../../admin/includes/config.php`, `functions.php`, `translate.php` provide DB and utility helpers.
- Conventions:
  - Responses: `outputData(array)` for success, `outputError(array)` for errors, often with i18n using `errorResponse($lang, en, ar)`.
  - DB helpers (observed): `selectDB`, `selectDB2`, `selectDBNew`, `selectDB2New`, `selectJoinDB`, `selectJoinDBNew`, `insertDB`, `updateDB`, `deleteDB`.
  - Tokens: `users.keepMeAlive` stores a long-lived token (no expiry design observed).


## 2) Endpoints reviewed

Files in `requests/store/views` and behaviors:

- `apiUser.php`
  - Actions: `register`, `login` (`registrationType`: 1 email/pass, 2 token, 3 guest), `forgot`, `reset`, `profile` (get/update), `delete`, `logout`, `wallet`, `notifications`.
  - Key flows:
    - Register: validates fields; for `registrationType=2` expects `registrationToken`. Uses SHA1 to hash password. On success, generates `keepMeAlive` token and registers Firebase device via cURL.
    - Login: Type 1 checks email+SHA1 password; Type 2 checks `registrationToken`; Type 3 creates guest user.
    - Forgot: generates numeric password and emails via `forgetPass()`, then sets SHA1(newPassword).
    - Profile: GET returns profile fields; UPDATE allows image upload via `uploadProfileImage()` and updates basic info.
    - Notifications: returns per-user notifications; marks read.

- `apiHome.php`
  - If token present, computes counts: `notifications` (unread), `cartItems` (sum of quantities). Else zero.
  - Banners: active + visible banners, adds full image URL via imgix.
  - Categories: derived from `category_products` join, with imgix 400x400.
  - Brands: deduped by product brand, with imgix 400x400.
  - Sections: `bestSellers`, `recent` products with joined category/brand/image/attribute, favorites flag, pricing and image URLs.

- `apiProduct.php`
  - Requires POST `id`.
  - Returns product core fields including `images` (builds array), `category`, `brand`, attributes (with computed `finalPrice` and stringified 3-decimal prices), a combined `variant` name from attributes variants, and `releated` (sic) products (similar structure to home sections).

- `apiSearch.php`
  - Filters by optional `categoryId`, `brandId`, keyword, and paginates using `page` as offset multiplier (`page*10`).
  - Joins to present a product card format with image URL (prefers `imageurl3` via imgix, falls back accordingly), favorites flag, base price and final discounted price.

- `apiCategories.php`
  - Returns category list (id/title/image/header) discovered via `category_products`, image via imgix 400x400.

- `apiCart.php`
  - Requires an authenticated user (`Authorization: Bearer ...`).
  - Actions:
    1. Add (validates productId/attributeId/quantity; merges if existing; checks stock against attribute quantity).
    2. Update (sets quantity for a given product+attribute).
    3. Delete a single product+attribute; returns updated cart count.
    4. Clear all cart for the user; returns updated cart count.
    5. List: returns items with product/brand/category titles, image URL, price, finalPrice, totalPrice per line.


## 3) Data and helpers behavior

- Favorites list: parsed from `users.favo` JSON array, converted to CSV for `FIND_IN_SET` in SQL to compute `isLiked`.
- Image URLs:
  - Common pattern: imgix base `https://coeo-102070017.imgix.net/` with `?w=400&h=400` or similar.
  - In `apiProduct.php`, a different base `https://coeoapp.com/logos/` is used, not unified with imgix.
- Discount calculation:
  - `discountType=0`: percentage. `finalPrice = price * ((100 - discount)/100)`
  - `discountType=1`: flat amount. `finalPrice = price - discount`
  - Often stringified to 3 decimals via `CAST(ROUND(..., 3) AS CHAR)` or `numTo3Float()` when post-processing.


## 4) Issues and inconsistencies (prioritized)

P1 – Functional bugs
- Firebase registration cURL param mismatch in `apiUser.php`:
  - Calls `.../requests/store/index.php?a=FirebaseNotification&action=register`.
  - Router expects `endpoint=FirebaseNotification`. Current call likely does not hit the endpoint.
- Image query typo in `apiCart.php` (list): `'?w=400&h400'` missing `=`; should be `&h=400`.

P2 – Inconsistencies / technical debt
- Duplicate `isLiked` fields in select lists in `apiHome.php` and `apiSearch.php` (appears twice).
- Mixed image domains between endpoints (`imgix` vs `coeoapp.com/logos`).
- Visibility flags semantics vary across tables (`hidden` 1 vs 0 as visible across entities). Working but confusing.
- `apiSearch.php` uses `page` as an offset multiplier rather than page-number; mismatch with common expectations.

P3 – Security / hardening
- Password hashing uses `sha1`; should migrate to `password_hash()`/`password_verify()`.
- Long-lived bearer token stored in `users.keepMeAlive` without expiry/rotation; consider session store with expiry and logout invalidation.
- `registrationType=2` fallback sets a static password when none provided; remove static secrets and simplify the flow.
- Rate limiting absent on `login` & `forgot`; consider throttling.
- Ensure `uploadProfileImage()` enforces file type/size and safe storage paths (not reviewed here).

P4 – Maintainability
- Several places embed SQL fragments with interpolated IDs; while values are DB-sourced ints, standardize on bound params throughout.
- Shared image URL builder helper would remove duplication and prevent typos.
- Add API-level docs for `page`, size (10), and sort orders.


## 5) Recommended immediate fixes (low-risk)

- Update `apiUser.php` cURL calls to use `?endpoint=FirebaseNotification&action=register`.
- Fix imgix height param in `apiCart.php` list: `&h=400`.
- Remove duplicate `isLiked` from select in `apiHome.php` and `apiSearch.php`.
- Standardize image building in `apiProduct.php` to use imgix base and same size params (e.g., `?w=400&h=400`).
- Clarify pagination in `API_DOCUMENTATION.md` (page is zero-based index, pageSize=10), or add `limit`/`offset` parameters.


## 6) Medium-term improvements

- Migrate to `password_hash()`/`password_verify()` and a one-way migration path:
  - On login, if SHA1 matches, re-hash with `password_hash()` and update.
- Introduce `sessions` table: token, userId, device info, createdAt, expiresAt, revokedAt; rotate token on login.
- Normalize visibility flags: choose a semantic (`status=0 active`, `hidden=0 visible`) project-wide and update queries gradually.
- Add basic rate limits at app or web server level for login/forgot/password reset.
- Create `buildImageUrl(record, size)` helper to centralize fallbacks and query params.


## 7) Endpoint contract snapshots

- User > register: POST body must include `fName`, `lName`, `email`, `password`, `confirmPassword`, `phone`, `countryCode`, `registrationType`, `firebaseToken`, and possibly `registrationToken` if type=2.
- User > login: POST requires `firebaseToken` and `registrationType` + the corresponding fields (email/password or registrationToken). Returns `token`.
- Home: GET. Optional bearer token influences `notifications` and `cartItems` counts. Returns `banners`, `categories`, `brands`, `bestSellers`, `recent`.
- Product: POST with `id`. Returns detailed product info with images, attributes, category, brand, and related products.
- Search: POST with optional `categoryId`, `brandId`, `keyword`, and `page` (zero-based). Returns 10 results per page.
- Categories: GET. Returns displayed categories.
- Cart: Requires bearer token. Actions 1..5 as described; list returns cart lines with computed prices.


## 8) Notable helpers (observed signatures)

- `outputData(array $payload)`, `outputError(array $payload)` – send JSON responses.
- `errorResponse($lang, $en, $ar)` – returns message in selected language.
- `selectDB*`, `insertDB`, `updateDB`, `deleteDB` – data access wrappers; variants with `New` usually take parameters array and where placeholders.
- `numTo3Float($n)` – format to 3 decimals.
- `searchFile($dir, $pattern)` – returns a matching filename for routing.
- `generateRandomToken()` – used for `keepMeAlive`.


## 9) Open questions and follow-ups

- What is the intended public image CDN? imgix vs `coeoapp.com/logos` – standardize choice and update endpoints consistently.
- Confirm `FirebaseNotification` endpoint file name and actions to ensure corrected cURL calls work.
- Define product page size (currently 10) as a constant and expose in docs/API responses.
- Validate and sanitize user-input fields for profile update (email/phone formats, max lengths).


## 10) Next actions (suggested order)

1) Apply quick fixes across 3–4 files (safe, low-risk).
2) Update `API_DOCUMENTATION.md` to reflect current behavior (pagination; cart attribute requirement; product id param).
3) Plan the authentication migration (hashing + sessions) and roll out gradually.
4) Centralize image URL construction and migrate endpoints.
5) Add rate limiting and field validation.

— Document maintained by engineering. Update when endpoints change.
