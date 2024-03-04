<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
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

// Frontend Route
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-submit', [HomeController::class, 'loginSubmit'])->name('login.submit');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
Route::post('/signup-submit', [HomeController::class, 'signupSubmit'])->name('signup.submit');

// User Dashboard Route
Route::middleware(['auth', 'user.type:user'])->group(function () {
    Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
    Route::get('/property/details/{id}', [HomeController::class, 'propertyDetails'])->name('property_details');
    Route::post('/search', [HomeController::class, 'search'])->name('search');
    Route::prefix('dashboard')->group(function () {
        Route::get('/panel', [DashboardController::class, 'dashboard'])->name('dashboard.dashboard');
        Route::get('/change-email', [DashboardController::class, 'changeEmail'])->name('dashboard.change-email');
        Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('dashboard.change-password');
        Route::post('/change-password-submit', [DashboardController::class, 'changePasswordSubmit'])->name('dashboard.change-password-submit');
        Route::post('/change-email-submit', [DashboardController::class, 'changeEmailSubmit'])->name('dashboard.change-email-submit');
        // User Dashboard properties Route
        Route::prefix('properties')->group(function () {
            Route::get('/upload-csv', [DashboardController::class, 'uploadCsv'])->name('dashboard.properties.csv-upload');
            Route::post('/submit-csv', [DashboardController::class, 'submitCsv'])->name('dashboard.properties.csv-submit');
            Route::get('/add', [DashboardController::class, 'add'])->name('dashboard.properties.add');
            Route::post('/add-submit', [DashboardController::class, 'addSubmit'])->name('dashboard.properties.add.submit');
            Route::get('/edit/{id}', [DashboardController::class, 'editProperty'])->name('dashboard.properties.edit');
            Route::post('/update/{id}', [DashboardController::class, 'updateProperty'])->name('dashboard.properties.update');
            Route::get('/delete/{id}', [DashboardController::class, 'deleteProperty'])->name('dashboard.properties.delete');
            Route::get('/all', [DashboardController::class, 'all'])->name('dashboard.properties.all');
            Route::get('/pending', [DashboardController::class, 'pending'])->name('dashboard.properties.pending');
            Route::get('/approved', [DashboardController::class, 'approved'])->name('dashboard.properties.approved');
            Route::get('/declined', [DashboardController::class, 'declined'])->name('dashboard.properties.declined');
        });
    });
});

// Admin Route
Route::middleware(['auth', 'user.type:admin'])->group(function () {
    Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
    Route::get('/property/details/{id}', [HomeController::class, 'propertyDetails'])->name('property_details');
    Route::post('/search', [HomeController::class, 'search'])->name('search');
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
        Route::get('/disapprove-user/{id}', [AdminController::class, 'disapproveUser'])->name('admin.disapprove-user');
        Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
        Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
        Route::get('/change-email', [AdminController::class, 'changeEmail'])->name('admin.change-email');
        Route::get('/change-logo', [AdminController::class, 'changeLogo'])->name('admin.change-logo');
        Route::post('/change-email-submit', [AdminController::class, 'changeEmailSubmit'])->name('admin.change-email-submit');
        Route::post('/change-password-submit', [AdminController::class, 'changePasswordSubmit'])->name('admin.change-password-submit');
        Route::post('/change-logo-submit', [AdminController::class, 'changeLogoSubmit'])->name('admin.change-logo-submit');
        // Admin properties Route
        Route::prefix('properties')->group(function () {
            Route::get('/upload-csv', [AdminController::class, 'uploadCsv'])->name('admin.properties.csv-upload');
            Route::post('/submit-csv', [AdminController::class, 'submitCsv'])->name('admin.properties.csv-submit');
            Route::get('/add', [AdminController::class, 'add'])->name('admin.properties.add');
            Route::post('/add-submit', [AdminController::class, 'addSubmit'])->name('admin.properties.add.submit');
            Route::get('/edit/{id}', [AdminController::class, 'editProperty'])->name('admin.properties.edit');
            Route::post('/update/{id}', [AdminController::class, 'updateProperty'])->name('admin.properties.update');
            Route::get('/delete/{id}', [AdminController::class, 'deleteProperty'])->name('admin.properties.delete');
            Route::get('/all', [AdminController::class, 'all'])->name('admin.properties.all');
            Route::get('/pending', [AdminController::class, 'pending'])->name('admin.properties.pending');
            Route::get('/approved', [AdminController::class, 'approved'])->name('admin.properties.approved');
            Route::get('/declined', [AdminController::class, 'declined'])->name('admin.properties.declined');
        });
    });
});
