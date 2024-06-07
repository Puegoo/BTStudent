<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Auth;

Route::get('/demo', [DemoController::class, 'demoDashboard'])->name('demo');
Route::get('/demo/transactions', [DemoController::class, 'demoTransactions'])->name('demo.demo_transactions');
Route::get('/demo/categories', [DemoController::class, 'demoCategories'])->name('demo.demo_categories');
Route::get('/demo/savings', [DemoController::class, 'demoSavings'])->name('demo.demo_savings');
Route::get('/demo/initialize', [DemoController::class, 'initializeDemoData'])->name('demo.initialize');
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'userDashboard'])->name('dashboard');
    Route::get('transactions', [HomeController::class, 'userTransactions'])->name('transactions.index');
    Route::get('transactions/create', [HomeController::class, 'createTransaction'])->name('transactions.create');
    Route::post('transactions', [HomeController::class, 'storeTransaction'])->name('transactions.store');
    Route::get('transactions/{transaction}/edit', [HomeController::class, 'editTransaction'])->name('transactions.edit');
    Route::put('transactions/{transaction}', [HomeController::class, 'updateTransaction'])->name('transactions.update');
    Route::delete('transactions/{transaction}', [HomeController::class, 'destroyTransaction'])->name('transactions.destroy');

    Route::get('categories', [HomeController::class, 'userCategories'])->name('categories.index');
    Route::get('categories/create', [HomeController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [HomeController::class, 'storeCategory'])->name('categories.store');
    Route::get('categories/{category}/edit', [HomeController::class, 'editCategory'])->name('categories.edit');
    Route::put('categories/{category}', [HomeController::class, 'updateCategory'])->name('categories.update');
    Route::delete('categories/{category}', [HomeController::class, 'destroyCategory'])->name('categories.destroy');

    Route::get('savings', [HomeController::class, 'userSavings'])->name('savings.index');
    Route::get('savings/create', [HomeController::class, 'createSaving'])->name('savings.create');
    Route::post('savings', [HomeController::class, 'storeSaving'])->name('savings.store');
    Route::get('savings/{saving}/edit', [HomeController::class, 'editSaving'])->name('savings.edit');
    Route::put('savings/{saving}', [HomeController::class, 'updateSaving'])->name('savings.update');
    Route::delete('savings/{saving}', [HomeController::class, 'destroySaving'])->name('savings.destroy');

    Route::get('profile', [HomeController::class, 'userProfile'])->name('profile');
    Route::get('profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/photo', [HomeController::class, 'updateProfilePhoto'])->name('profile.photo.update');

    Route::get('profile/chart-data', [HomeController::class, 'getChartData'])->name('profile.chartData');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('transactions', [AdminController::class, 'transactions'])->name('transactions.index');
    Route::get('transactions/create', [AdminController::class, 'createTransaction'])->name('transactions.create');
    Route::post('transactions', [AdminController::class, 'storeTransaction'])->name('transactions.store');
    Route::get('transactions/{transaction}/edit', [AdminController::class, 'editTransaction'])->name('transactions.edit');
    Route::put('transactions/{transaction}', [AdminController::class, 'updateTransaction'])->name('transactions.update');
    Route::delete('transactions/{transaction}', [AdminController::class, 'destroyTransaction'])->name('transactions.destroy');

    Route::get('categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('categories/{category}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    Route::get('savings', [AdminController::class, 'savings'])->name('savings.index');
    Route::get('savings/create', [AdminController::class, 'createSaving'])->name('savings.create');
    Route::post('savings', [AdminController::class, 'storeSaving'])->name('savings.store');
    Route::get('savings/{saving}/edit', [AdminController::class, 'editSaving'])->name('savings.edit');
    Route::put('savings/{saving}', [AdminController::class, 'updateSaving'])->name('savings.update');
    Route::delete('savings/{saving}', [AdminController::class, 'destroySaving'])->name('savings.destroy');

    Route::get('users', [AdminController::class, 'users'])->name('users.index');
    Route::get('users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('admin/chart-data', [AdminController::class, 'getAdminChartData'])->name('admin.chartData');
});
