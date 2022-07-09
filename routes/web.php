<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{ 
  GeneralSettingsController,
  MenuController,
  MyProfileController,
  PostController,
  RoleController,  
  UserController,
  SearchController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|resources/js/Pages/
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        //'laravelVersion' => Application::VERSION,
        //'phpVersion' => PHP_VERSION,
    ]);
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
     
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus');
        Route::get('/children/{menuId}', [MenuController::class, 'children']);
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');  
        Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/{id}', [MenuController::class,'destroy'])->name('menus.destroy');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}/show', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');  
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');  
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
    });

    Route::prefix('myprofile')->group(function () {
      Route::get('/edit', [MyProfileController::class, 'edit'])->name('myprofile.edit');      
      Route::put('/', [MyProfileController::class, 'update'])->name('myprofile.update');      
      Route::put('/password', [MyProfileController::class, 'updatePassword'])->name('myprofile-password.update');
    });
    
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');        
        Route::post('/', [PostController::class, 'store'])->name('posts.store');        
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });  
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'edit'])->name('settings');    
        Route::put('/', [GeneralSettingsController::class, 'update'])->name('settings.update');
    });
    
    //Route::prefix('users')->middleware(['role:admin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    Route::get('search', SearchController::class)->name('search');    
    
});

Route::prefix('error')->group(function () {
    Route::get('/', function(){ 
        abort(500);
    });
    Route::get('/custom', function(){
        throw new \App\Exceptions\CustomException('Levi Strauss', 501);
    });    
});

