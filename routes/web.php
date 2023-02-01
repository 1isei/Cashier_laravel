<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/item', ItemController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/transaction', TransactionController::class);
Route::get('/history', [TransactionController::class, 'history']);
Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
// Route::delete('/item', ItemController::class, 'destroy');