# GameNova Laravel

GameNova is a bilingual (English/Bangla) game top-up storefront built with Laravel 13, Blade, Bootstrap and vanilla JavaScript.

## Features

- Responsive GameNova homepage
- Data-driven product pages for Free Fire, PUBG Mobile, Mobile Legends, Call of Duty Mobile and Valorant
- bKash, Nagad and Nova Wallet payment selection
- Server-side order validation with Laravel
- Login and registration controllers
- English/Bangla language switching
- Feature tests for core pages and order submission

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Open `http://127.0.0.1:8000`.

The authentication routes require a configured database and the matching PDO extension. File-based cache and sessions are enabled by default so the storefront can render without a database connection.

## Tests

```bash
php artisan test
```

## Main application files

- `routes/web.php` — storefront, authentication and order routes
- `config/games.php` — game details, packages and pricing
- `resources/views/home.blade.php` — homepage
- `resources/views/games/show.blade.php` — shared top-up page
- `app/Http/Controllers` — authentication, game and order logic
