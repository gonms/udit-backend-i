<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Book routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Reservation routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/available', [ReservationController::class, 'availableBooks'])->name('reservations.available');
    Route::get('/books/{book}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/books/{book}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/books/{book}/return', [ReservationController::class, 'return'])->name('reservations.return');
});
