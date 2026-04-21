<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



///Admin
// Route::middleware(['admin'])->group(function () {
//     Route::resource('products',ProductController::class);
//     Route::resource('categories',CategoryController::class);
//        Route::get('/admin/dashboard', function () {
//     return 'Hi Admin';
// })->name('admin_dashboard');
// });


// Route::middleware(['editor'])->group(function () {
//    Route::get('/editor/dashboard', function () {
//     return 'Hi editor';
// })->name('editor_dashboard');
// });


//editor
Route::middleware(['editor'])->group(function () {
    Route::get('/editor/dashboard', [EditorController::class, 'index'])->name('editor_dashboard');
});

//Admin
Route::middleware(['admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
});



require __DIR__ . '/auth.php';

Route::get('/', [\App\Http\Controllers\StoreController::class, 'index'])->name('home_page');

Auth::routes();

