<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
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



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');


Route::get('/details/{id}', [App\Http\Controllers\HomeController::class, 'details'])->name('details');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('verify-order-payment/{reference}', [CartController::class, 'OrderPayment'])->name('payment.verify');
Route::get('/paymentSuccess', [CartController::class, 'paymentSuccess'])->name('paymentSuccess');

Route::get('/payments', [PaymentController::class, 'payments'])->name('payments')->middleware('auth');
Route::get('/orders', [OrderController::class, 'orders'])->name('orders')->middleware('auth');
Route::get('/orderlist/{id}', [OrderController::class, 'orderlist'])->name('orderlist')->middleware('auth');

