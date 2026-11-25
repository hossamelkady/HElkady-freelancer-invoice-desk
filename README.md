# Freelancer Invoice Desk

A client and invoicing dashboard for independent freelancers.

Track clients and invoices in one small workspace. Create and update client records, draft invoices with totals, due dates, currencies, and payment states, and review outstanding work from the dashboard.

## Features
- User registration and sign-in with session security.
- Authenticated dashboard and responsive Blade UI.
- CRUD workflows with server-side validation.
- SQLite-ready local setup and feature tests.

## Requirements and setup
PHP 8.2+, Composer 2.
```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```
Open `/register` to create a demo user. Clients and invoices are scoped to the signed-in user (run `php artisan migrate:fresh` if you set this up before the user_id columns were added). Use fictional data only. This portfolio sample is not hardened for production use.

## Tests
```bash
php artisan test
```

The preview is illustrative static SVG, not a screenshot of a running application.
