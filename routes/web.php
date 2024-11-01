<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected route (accessible only after login)
Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard'); // Render dashboard view
    // })->name('dashboard')->middleware([RoleMiddleware::class . ':admin,staff']);

    Route::prefix('dashboard')
        ->name('dashboard.')
        ->middleware(RoleMiddleware::class . ':admin,staff')
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::get('/books/create', [BookController::class, 'create'])->name('create');
            Route::get('/books', [DashboardController::class, 'books'])->name('books');
            Route::post('/books', [BookController::class, 'store'])->name('store');
            Route::get('/users', [DashboardController::class, 'users'])->name('users');
        });

    Route::middleware(RoleMiddleware::class . ':admin,staff')->group(function () {
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/', [BookController::class, 'store'])->name('books.store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    Route::post('/borrow', [BorrowingController::class, 'borrow'])->name('borrows.borrow');
    Route::put('/return/{id}', [BorrowingController::class, 'returnBook'])->name('borrows.return');
    Route::get('/borrows', [BorrowingController::class, 'userBorrows'])->name('borrows.index');

    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::get('/account/configure', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
});

// Redirect root URL to books index view
Route::get('/', [BookController::class, 'index'])->name('books.index');

// Other book CRUD operations
Route::get('/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
