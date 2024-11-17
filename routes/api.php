<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productController;

Route::post('/product', [productController:: class, 'createProduct']);

Route::get('/product', [productController:: class, 'getProducts']);

Route::get('/product/{id}', [productController:: class, 'getProductByID']);

Route::put('/product/{id}', [productController:: class, 'updateProductByID']);

Route::delete('/product/{id}', [productController::class, 'deleteProductByID']);