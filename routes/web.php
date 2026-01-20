<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\OrderController;

// Adoption
Route::post('/adopt', [AdoptionController::class, 'store'])->name('adopt');

// Authentication pages - Default route redirects to signIn
Route::get('/', function () {
    return redirect()->route('signIn.page');
});

Route::get('/signIn', function () {
    return view('signIn');
})->name('signIn.page');

// Home route (protected - only after successful login)
Route::get('/home', function () {
    return view('home');
})->name('home');

// Authentication logic
Route::post('/signIn', [UserController::class, 'signIn'])->name('signIn');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Cart routes
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
Route::post('/cart/update', [OrderController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [OrderController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/count', [OrderController::class, 'getCartCount'])->name('cart.count');

// Order success route
Route::get('/orders/success', [OrderController::class, 'orderSuccess'])->name('orders.success');

// Checkout routes
Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

Route::get('/products', function () {
    return view('products/index');
});

// RESTful resources
Route::resources([
    'pets' => PetController::class,
    'products' => ProductController::class,
    'users' => UserController::class,
    'adoption' => AdoptionController::class
]);

// API Routes (if you want to keep API functionality)
Route::prefix('api')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/signin', [UserController::class, 'signIn']);
    Route::post('/logout', [UserController::class, 'logout']);
});