<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return view('home');
});
Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

// Custom Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [App\Http\Controllers\CustomAuthController::class, 'login'])->name('login.submit')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', [App\Http\Controllers\CustomAuthController::class, 'register'])->name('register.submit')->middleware('guest');

Route::post('/logout', [App\Http\Controllers\CustomAuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/account', function () {
    return view('auth.account');
})->name('account')->middleware('auth');

// Main
Route::get('/contact', function () {
    return view('main.contact');
})->name('contact');

// Flappy Bird game route
Route::get('/flappybird', function () {
    return redirect('/flappbird_finaltest/flappybird.html');
})->name('flappybird');

// Store and Products
Route::get('/store', [ProductController::class, 'index'])->name('store');
Route::post('/store', [ProductController::class, 'index'])->name('store.filter');

// Product routes
for ($i = 1; $i <= 12; $i++) {
    Route::get('/product' . $i, [ProductController::class, 'show'])->name('product' . $i)->defaults('id', $i);
}

// Comments
Route::middleware('auth')->group(function () {
    Route::post('/product/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
});

// Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');
});

Route::get('/checkout', function () {
    return view('checkout.checkout');
})->name('checkout')->middleware('auth');

// We're using custom authentication routes instead of Laravel's built-in ones
// Auth::routes();


// ez product id szerint bővítendő
Route::get('/product', function () {
    return view('main.product');
})->name('product');
