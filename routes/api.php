<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\StatusController as StatusControllerAlias;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserPaymentCardsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::apiResources([
    "categories" => CategoryController::class,
    "favorites" => FavoriteController::class,
    "categories.products" => CategoryProductController::class,
    'statuses' => StatusControllerAlias::class,
    'statuses.orders' => StatusOrderController::class,
    "products" => ProductController::class,
    'orders' => OrderController::class,
    'delivery-methods' => DeliveryMethodController::class,
    'payment-types' => PaymentTypeController::class,
    'user-addresses' => UserAddressController::class,
    'user-payment-card' => UserPaymentCardsController::class,
]);
