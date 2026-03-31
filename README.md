# Cartify - Laravel E-commerce Website

Professional multi-category online shop inspired by Noon/Amazon style.

## Features

- Responsive modern UI (mobile, tablet, desktop)
- Home, Products, Product Details, Cart, Checkout, About, Contact pages
- Category filtering + product search
- Database-driven cart (`carts`, `cart_items`) with quantity updates and dynamic totals
- Order creation (`orders`, `order_items`) with fake checkout flow (no payment gateway)
- User authentication (login/register/logout)
- Reusable product card component
- Hover animations and smooth transitions
- Seeded demo categories and products with image placeholders

## Tech Stack

- Laravel 12 (PHP 8.2+)
- Blade templates
- Bootstrap 5 + Bootstrap Icons
- AOS animation library
- MySQL

## Project Structure

- `app/Models`: `User`, `Category`, `Product`, `Cart`, `CartItem`, `Order`, `OrderItem`
- `app/Http/Controllers`: `ProductController`, `CategoryController`, `CartController`, `OrderController`, `AuthController`
- `database/migrations`: users, categories, products, carts, cart_items, orders, order_items
- `database/seeders`: `ProductSeeder`, `DatabaseSeeder`
- `resources/views/layouts`: base layout
- `resources/views/store`: all pages + reusable `partials/product-card.blade.php`
- `resources/css/app.css`: custom styles and hover animations
- `resources/js/app.js`: AOS initialization
- `routes/web.php`: storefront + cart + checkout routes

## Setup Instructions (Step by Step)

1. Install dependencies:
   - `composer install`
   - `npm install`
2. Create environment file:
   - `copy .env.example .env`
3. Configure MySQL in `.env`:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=cartify`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
4. Generate app key:
   - `php artisan key:generate`
5. Run migrations fresh:
   - `php artisan migrate:fresh`
6. Seed demo data (products + demo user):
   - `php artisan db:seed`
7. Build frontend assets:
   - `npm run build`
8. Start local server:
   - `php artisan serve`

Open `http://127.0.0.1:8000`.

## Deployment (InfinityFree / 000webhost style)

1. Build production assets locally:
   - `npm run build`
2. Set `APP_ENV=production`, `APP_DEBUG=false` in `.env`.
3. Upload project files to hosting.
4. Move contents of `public/` to your host `public_html/` directory.
5. Update `index.php` paths in `public_html` to point to your Laravel app folder.
6. Configure database and import migrated tables (or run migrations via SSH if available).
7. Run (if terminal access exists):
   - `php artisan config:cache`
   - `php artisan route:cache`
   - `php artisan view:cache`
8. Ensure `storage/` and `bootstrap/cache/` are writable.

## Notes

- Product images are intentionally placeholders so you can add your own later.
- Checkout is demo only and does not process real payments.
- Demo login after seeding: `demo@cartify.test` / `password`
