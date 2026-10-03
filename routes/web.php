<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\SpeciesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [PetController::class, 'index'])->name('dashboard');

    // Pet CRUD Routes
    Route::get('/dashboard/add-new-pet', [PetController::class, 'create'])->name('pets.create');
    Route::post('/dashboard/add-new-pet', [PetController::class, 'store'])->name('pets.store');

    Route::get('/dashboard/pets/{pet}', [PetController::class, 'show'])->name('pets.show');

    Route::get('/dashboard/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/dashboard/pets/{pet}', [PetController::class, 'update'])->name('pets.update');

    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');

    // Species Routes
    Route::get('/dashboard/add-new-species', [SpeciesController::class, 'create'])->name('species.create');
    Route::post('/dashboard/add-new-species', [SpeciesController::class, 'store'])->name('species.store');
    Route::delete('/species/{species}', [SpeciesController::class, 'destroy'])->name('species.destroy');
});
