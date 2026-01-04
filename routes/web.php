<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RepaymentController;
use App\Models\Customer;
use App\Models\Loan;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard with counts
Route::get('/dashboard', function () {
    return view('admin.dashboard', [
        'totalCustomers' => Customer::count(),
        'totalLoans' => Loan::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer routes (with route model binding)
Route::middleware('auth')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

// Loan routes
Route::middleware('auth')->group(function () {
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

    // Loan repayments
    Route::get('/loans/{loan}/repayments', [RepaymentController::class, 'index'])->name('repayments.index');
    Route::post('/loans/{loan}/repayments', [RepaymentController::class, 'store'])->name('repayments.store');
});

require __DIR__.'/auth.php';
