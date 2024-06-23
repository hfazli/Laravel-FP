<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::put('user/{user}', [UserController::class, 'updateProfile']);

    // Product Routes
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{product}', [ProductsController::class, 'show']);
    Route::post('/products', [ProductsController::class, 'store']); // Admin only
    Route::put('/products/{product}', [ProductsController::class, 'update']); // Admin only
    Route::delete('/products/{product}', [ProductsController::class, 'destroy']); // Admin only

    // Category Routes
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::post('categories', [CategoryController::class, 'store']); // Admin only
    Route::put('categories/{category}', [CategoryController::class, 'update']); // Admin only
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']); // Admin only

    // Cart Routes
    Route::get('carts', [CartController::class, 'index']);
    Route::get('carts/{cart}', [CartController::class, 'show']);
    Route::post('carts', [CartController::class, 'store']);
    Route::put('carts/{cart}', [CartController::class, 'update']);
    Route::delete('carts/{cart}', [CartController::class, 'destroy']);

    // CartItem Routes
    Route::post('cart-items', [CartItemController::class, 'addToCart']);
    Route::put('cart-items/{cartItem}', [CartItemController::class, 'update']);
    Route::delete('cart-items/{cartItem}', [CartItemController::class, 'remove']);

    // Order Routes (Transactions)
    Route::get('orders', [OrderController::class, 'index']); // Admin only
    Route::get('orders/user', [OrderController::class, 'userOrders']); // Current user orders
    Route::get('orders/{order}', [OrderController::class, 'show']); // Admin and user who owns the order
    Route::post('orders', [OrderController::class, 'store']);
    Route::put('orders/{order}', [OrderController::class, 'update']); // Admin only
    Route::delete('orders/{order}', [OrderController::class, 'destroy']); // Admin only

    // OrderItem Routes
    Route::get('order-items', [OrderItemController::class, 'index']); // Admin only
    Route::get('order-items/{orderItem}', [OrderItemController::class, 'show']); // Admin only
    Route::post('order-items', [OrderItemController::class, 'store']);
    Route::put('order-items/{orderItem}', [OrderItemController::class, 'update']); // Admin only
    Route::delete('order-items/{orderItem}', [OrderItemController::class, 'destroy']); // Admin only
});