<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
// use Spatie\Permission\Middlewares\PermissionMiddleware;
app()->make('router')->aliasMiddleware('permission', Spatie\Permission\Middleware\PermissionMiddleware::class);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin Page
Route::prefix('admin')->middleware(['auth', 'verified', 'role:Administrator'])->group(function () {
    Route::get('/', function () {
        return 'Yey Anda berhasil mengakses halaman ini, berarti Anda adalah <b>Administrator</b>';
    });

    // route manajemen pengguna
    Route::get('/manajemen-pengguna', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/manajemen-pengguna/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/manajemen-pengguna', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/manajemen-pengguna/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/manajemen-pengguna/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/manajemen-pengguna/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // route manajemen menu
    Route::get('/manajemen-menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/manajemen-menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/manajemen-menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/manajemen-menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/manajemen-menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/manajemen-menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    // route manajemen role
    Route::get('/manajemen-role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/manajemen-role', [RoleController::class, 'store'])->name('role.store');
    Route::put('/manajemen-role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/manajemen-role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    // route manajemen permission
    Route::get('/manajemen-permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/manajemen-permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::put('/manajemen-permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/manajemen-permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
});

// Admin Page by Permission

// Route::middleware('auth')->prefix('admin')->group(function () {
//     // manajemen pengguna
//     Route::get('/manajemen-pengguna', [UserController::class, 'index'])->middleware('permission:read user')->name('admin.users.index');
//     Route::post('/manajemen-pengguna', [UserController::class, 'store'])->middleware('permission:create user')->name('admin.users.store');
//     Route::put('/manajemen-pengguna/{user}', [UserController::class, 'update'])->middleware('permission:update user')->name('admin.users.update');
//     Route::delete('/manajemen-pengguna/{user}', [UserController::class, 'destroy'])->middleware('permission:delete user')->name('admin.users.destroy');

//     // manajemen menu
//     Route::get('/manajemen-menu', [MenuController::class, 'index'])->middleware('permission:read menu')->name('menu.index');
//     Route::post('/manajemen-menu', [MenuController::class, 'store'])->middleware('permission:create menu')->name('menu.store');
//     Route::put('/manajemen-menu/{id}/edit', [MenuController::class, 'edit'])->middleware('permission:update menu')->name('menu.edit');
//     Route::put('/manajemen-menu/{id}', [MenuController::class, 'update'])->middleware('permission:update menu')->name('menu.update');
//     Route::delete('/manajemen-menu/{id}', [MenuController::class, 'destroy'])->middleware('permission:delete menu')->name('menu.destroy');

//     // manajemen role
//     Route::get('/manajemen-role', [RoleController::class, 'index'])->middleware('permission:read role')->name('role.index');
//     Route::post('/manajemen-role', [RoleController::class, 'store'])->middleware('permission:create role')->name('role.store');
//     Route::put('/manajemen-role/{id}', [RoleController::class, 'update'])->middleware('permission:update role')->name('role.update');
//     Route::delete('/manajemen-role/{id}', [RoleController::class, 'destroy'])->middleware('permission:delete role')->name('role.destroy');

//     // manajemen permission
//     Route::get('/manajemen-permission', [PermissionController::class, 'index'])->middleware('permission:read permission')->name('permission.index');
//     Route::post('/manajemen-permission', [PermissionController::class, 'store'])->middleware('permission:create permission')->name('permission.store');
//     Route::put('/manajemen-permission/{id}', [PermissionController::class, 'update'])->middleware('permission:update permission')->name('permission.update');
//     Route::delete('/manajemen-permission/{id}', [PermissionController::class, 'destroy'])->middleware('permission:delete permission')->name('permission.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
