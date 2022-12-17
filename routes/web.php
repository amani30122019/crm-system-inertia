<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

require __DIR__ . '/auth.php';
Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::prefix('reports')->group(function(){
            Route::get('/index', [HomeController::class, 'reportsIndex'])->name('reports.index');
            Route::get('/users', [HomeController::class, 'reportsUsers'])->name('reports.users');
            Route::get('/posts', [HomeController::class, 'reportsPosts'])->name('reports.posts');
        } );
        Route::resources([
            'users' => UserController::class,
            'roles' => RoleController::class,
            'permissions' =>  PermissionController::class,
            'posts' => PostController::class,
        ]);
    }
);