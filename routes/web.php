<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowBookController;
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

Route::get('new-borrow/{user}/{book}', [BorrowBookController::class, 'new']);
Route::get('list-books/{user}', [BorrowBookController::class, 'listBooks']);
Route::get('delete-borrow/{user}/{book}', [BorrowBookController::class, 'delete']);