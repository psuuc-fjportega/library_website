<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Role-based dashboards: Member => /dashboard, Admin => /admin/dashboard, Librarian => /librarian/dashboard
Route::get('dashboard', DashboardController::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('admin/dashboard', DashboardController::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('librarian/dashboard', DashboardController::class)
    ->middleware(['auth', 'role:librarian'])
    ->name('librarian.dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function (): void {
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::get('borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::post('borrows', [BorrowController::class, 'store'])->name('borrows.store');
    Route::post('borrows/{borrow}/approve', [BorrowController::class, 'approve'])->name('borrows.approve');
    Route::post('borrows/{borrow}/reject', [BorrowController::class, 'reject'])->name('borrows.reject');
    Route::post('borrows/{borrow}/return', [BorrowController::class, 'markReturned'])->name('borrows.return');
    Route::get('reports', ReportController::class)->middleware('role:admin,librarian')->name('reports.index');
});

require __DIR__.'/auth.php';
