<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExcelController;

/*
Login & Register
*/

Route::get('/', [AuthController::class, 'loginPage']);

Route::get('/login', [AuthController::class, 'loginPage'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/register', [AuthController::class, 'register']);

/*
User
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth');

// Route untuk menambah menu ke keranjang
Route::post('/add-to-cart/{id}', [DashboardController::class, 'addToCart'])
    ->name('cart.add')
    ->middleware('auth');

Route::post('/remove-from-cart/{id}', [DashboardController::class, 'removeFromCart'])
    ->name('cart.remove')
    ->middleware('auth');

Route::post('/checkout', [TransactionController::class, 'checkout'])
    ->name('checkout')
    ->middleware('auth');

Route::get('/history', [HistoryController::class, 'index'])
    ->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

/*
Admin
*/

Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/admin/menu', [MenuController::class, 'index']);
Route::get('/admin/report', [ReportController::class, 'index']);
Route::get('/admin/report/pdf', [PdfController::class, 'export']);
Route::get('/admin/report/excel', [ExcelController::class, 'export']);
