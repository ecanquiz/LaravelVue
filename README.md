# Laravel & Vue (with Inertia)

## MV(SPA)C

### Installation Steps 

Prerequisites, have installed:

- Git
- PHP 8.1
- Composer (Dependency Manager for PHP)
- Node 16.9.1
- npm (Package Manager)
- MySQL v>=8 (or PostgreSQL v>=13)
- Create database called `db_name_laravel_vue` or whatever name you prefer.

Steps:

- 1° Run `git clone https://github.com/ejimenez123/LaravelVue.git`
- 2° Run `mv LaravelVue laravel-vue`
- 3° Run `cd laravel-vue`
- 4° Run `composer install -vvv`
- 5° Run `php artisan --version`
- 6° Run `cp .env.example .env`
- 7° Run `php artisan key:generate`
- 9° Configure database in `.env` file. Example:
```
...
DB_DATABASE=db_name_laravel_vue
DB_USERNAME=root
DB_PASSWORD='12345678'
...
```
- 10° Run `php artisan migrate:fresh --seed`
- 11° Run `npm install`
- 12° Run `npm run dev`
- 13° Run `php artisan storage:link`
- 14° Run `php artisan optimize`
- 15° Run `php artisan serve`

And that's it, the app is now installed.
Now you can see the app running in your browser by `http://127.0.0.1:8000`

To login use the following credentials:
- E-mail: `admin@admin.com`
- Password: `asdf`
