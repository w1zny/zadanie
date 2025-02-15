<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders/{order_id}/products', [OrderController::class, 'getProducts']);
Route::get('/orders', [OrderController::class, 'getOrders']);
