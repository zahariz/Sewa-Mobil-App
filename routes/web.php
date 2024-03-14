<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalTransactionController;
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
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cars
    Route::get('/master/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/master/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/master/cars/create', [CarController::class, 'store'])->name('cars.store');
    Route::get('/master/cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/master/cars/{id}/edit', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/master/cars/{id}/destroy', [CarController::class, 'destroy'])->name('cars.destroy');

    // Rental
    Route::get('/rental/cars', [RentalTransactionController::class, 'index'])->name('rental.cars.index');
    Route::get('/rental/cars/create', [RentalTransactionController::class, 'create'])->name('rental.cars.create');
    Route::post('/rental/cars/create', [RentalTransactionController::class, 'store'])->name('rental.cars.store');
});

require __DIR__.'/auth.php';
