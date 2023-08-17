<?php

use App\Http\Controllers\DeliveredOrdersController;
use App\Http\Controllers\ProcessingOrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreatedOrdersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/created_orders', [CreatedOrdersController::class, 'index'])->name('created_orders.index');
    Route::patch('/created_orders/prepare/{id}', [CreatedOrdersController::class, 'prepare'])->name('created_orders.prepare');

    Route::get('/processing_orders', [ProcessingOrdersController::class, 'index'])->name('processing_orders.index');
    Route::patch('/processing_orders/complete/{order_id}', [ProcessingOrdersController::class, 'complete'])->name('processing_orders.complete');

    Route::get('/delivered_orders', [DeliveredOrdersController::class, 'index'])->name('delivered_orders.index');
});

require __DIR__.'/auth.php';
