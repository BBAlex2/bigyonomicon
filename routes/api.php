<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Product API Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductApiController::class, 'index']);
    Route::post('/', [ProductApiController::class, 'store']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
    Route::put('/{id}', [ProductApiController::class, 'update']);
    Route::delete('/{id}', [ProductApiController::class, 'destroy']);
});

// Category API Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryApiController::class, 'index']);
    Route::post('/', [CategoryApiController::class, 'store']);
    Route::get('/{id}', [CategoryApiController::class, 'show']);
    Route::put('/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/{id}', [CategoryApiController::class, 'destroy']);
    Route::get('/{id}/subcategories', [CategoryApiController::class, 'subcategories']);
});
