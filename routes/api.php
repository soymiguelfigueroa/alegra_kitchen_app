<?php

use App\Http\Controllers\CreatedOrdersController;
use App\Http\Controllers\ReceiptsController;
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

Route::get('/ingredients', [CreatedOrdersController::class, 'getUndeliveredIngredients']);
Route::get('/ingredients/undelivered', [CreatedOrdersController::class, 'getUndeliveredIngredients']);
Route::get('/ingredients/delivered', [CreatedOrdersController::class, 'getDeliveredIngredients']);
Route::patch('/ingredients/deliver', [CreatedOrdersController::class, 'deliverIngredients']);

Route::get('/receipts', [ReceiptsController::class, 'getReceipts']);
Route::get('/ingredients', [ReceiptsController::class, 'getIngredients']);
