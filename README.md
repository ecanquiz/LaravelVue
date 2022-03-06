# Laravel & Vue (with Inertia)

## MV(SPA)C

### Installation Steps 

Prerequisites:

PHP 8.1
Node 16.9.1
Create database MySQL (or PostgreSQL) called `db_name_laravel_vue` or whatever name you prefer.

Steps:

- 1° Run `git clone https://github.com/ejimenez123/LaravelVue.git`
- 2° Run `mv LaravelVue laravel-vue`
- 3° Run `cd laravel-vue`
- 4° Run `composer install -vvv`
- 5° Run `php artisan --version`
- 6° Run `cp .env.example .env`
- 7° Run `php artisan key:generate`
- 9° configure database in `.env` file.

Example:
```
DB_DATABASE=db_name_laravel_vue
DB_USERNAME=root
DB_PASSWORD='12345678'
```
- 10° Run `php artisan migrate:fresh --seed`
- 11° Run `npm install`
- 12° Run `npm run dev`
- 13° Run `php artisan storage:link`
- 14° Run `php artisan optimize`
