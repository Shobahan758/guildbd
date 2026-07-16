# GameNova Laravel

GameNova is a bilingual (English/Bangla) game top-up storefront built with Laravel 13, Blade, Bootstrap and vanilla JavaScript.

## Features

- Responsive GameNova homepage
- Data-driven product pages for Free Fire, PUBG Mobile, Mobile Legends, Call of Duty Mobile and Valorant
- bKash, Nagad and Nova Wallet payment selection
- Server-side order validation with Laravel
- Persistent orders with payment and transaction details
- Protected Bootstrap admin dashboard and order fulfilment workflow
- Order search, status filters, internal notes and revenue summary
- Admin game/package catalogue
- Login and registration controllers
- English/Bangla language switching
- Feature tests for core pages and order submission

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
docker compose up -d
php artisan migrate --seed
php artisan serve
```

Open `http://127.0.0.1:8000`.

The included Docker Compose service starts MySQL on port `3308`, matching `.env.example`. File-based cache and sessions remain enabled by default.

Authentication includes registration with a Bangladesh phone number, throttled login attempts, secure logout, authenticated header state and email password reset. In local development reset emails are written to `storage/logs/laravel.log` by the configured log mailer.

## Admin dashboard

Open `http://127.0.0.1:8000/admin` after migrating and seeding. Configure the initial administrator before running the seeder:

```dotenv
ADMIN_NAME="GameNova Admin"
ADMIN_EMAIL=admin@gamenova.test
ADMIN_PASSWORD=use-a-strong-password
```

For local demo setup, the `.env.example` values create `admin@gamenova.test` with password `Admin@12345`. Change these values outside local development.

## Tests

```bash
php artisan test
```

## Main application files

- `routes/web.php` — storefront, authentication, order and protected admin routes
- `config/games.php` — game details, packages and pricing
- `resources/views/home.blade.php` — homepage
- `resources/views/games/show.blade.php` — shared top-up page
- `app/Http/Controllers` — authentication, game and order logic
- `resources/views/admin` — Bootstrap admin dashboard views
