<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
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
        Route::get('/agents', [AdminController::class, 'agents'])->name('admin.agents');
        Route::get('/agent-add', [AdminController::class, 'agentAdd'])->name('admin.add-agent');
        Route::post('/agent-submit', [AdminController::class, 'agentSubmitAgent'])->name('admin.submit-agent');
        Route::get('/agent/{id}', [AdminController::class, 'agentEdit'])->name('admin.edit-agent');
        Route::post('/agent-update/{id}', [AdminController::class, 'agentUpdate'])->name('admin.update-agent');
        Route::get('/agent-delete/{id}', [AdminController::class, 'agentDelete'])->name('admin.delete-agent');
        Route::get('/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
        Route::get('/disapprove-user/{id}', [AdminController::class, 'disapproveUser'])->name('admin.disapprove-user');
        Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
        Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
        Route::get('/change-email', [AdminController::class, 'changeEmail'])->name('admin.change-email');
        Route::get('/change-logo', [AdminController::class, 'changeLogo'])->name('admin.change-logo');
        Route::get('/change-icon', [AdminController::class, 'changeIcon'])->name('admin.change-icon');
        Route::get('/change-image', [AdminController::class, 'changeImage'])->name('admin.change-image');
        Route::get('/change-color', [AdminController::class, 'changeColor'])->name('admin.change-color');
        Route::post('/change-email-submit', [AdminController::class, 'changeEmailSubmit'])->name('admin.change-email-submit');
        Route::post('/change-password-submit', [AdminController::class, 'changePasswordSubmit'])->name('admin.change-password-submit');
        Route::post('/change-logo-submit', [AdminController::class, 'changeLogoSubmit'])->name('admin.change-logo-submit');
        Route::post('/change-icon-submit', [AdminController::class, 'changeIconSubmit'])->name('admin.change-icon-submit');
        Route::post('/change-image-submit', [AdminController::class, 'changeImageSubmit'])->name('admin.change-image-submit');
        Route::post('/change-color-submit', [AdminController::class, 'changeColorSubmit'])->name('admin.change-color-submit');
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


// Agent Route
Route::middleware(['auth', 'user.type:agent'])->group(function () {
    Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
    Route::get('/property/details/{id}', [HomeController::class, 'propertyDetails'])->name('property_details');
    Route::post('/search', [HomeController::class, 'search'])->name('search');
    Route::prefix('agent')->group(function () {
        Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
        Route::get('/users', [AgentController::class, 'users'])->name('agent.users');
        Route::get('/approve-user/{id}', [AgentController::class, 'approveUser'])->name('agent.approve-user');
        Route::get('/disapprove-user/{id}', [AgentController::class, 'disapproveUser'])->name('agent.disapprove-user');
        Route::get('/delete-user/{id}', [AgentController::class, 'deleteUser'])->name('agent.delete-user');
        Route::get('/change-password', [AgentController::class, 'changePassword'])->name('agent.change-password');
        Route::get('/change-email', [AgentController::class, 'changeEmail'])->name('agent.change-email');
        Route::post('/change-email-submit', [AgentController::class, 'changeEmailSubmit'])->name('agent.change-email-submit');
        Route::post('/change-password-submit', [AgentController::class, 'changePasswordSubmit'])->name('agent.change-password-submit');
        // Admin properties Route
        Route::prefix('properties')->group(function () {
            Route::get('/upload-csv', [AgentController::class, 'uploadCsv'])->name('agent.properties.csv-upload');
            Route::post('/submit-csv', [AgentController::class, 'submitCsv'])->name('agent.properties.csv-submit');
            Route::get('/add', [AgentController::class, 'add'])->name('agent.properties.add');
            Route::post('/add-submit', [AgentController::class, 'addSubmit'])->name('agent.properties.add.submit');
            Route::get('/edit/{id}', [AgentController::class, 'editProperty'])->name('agent.properties.edit');
            Route::post('/update/{id}', [AgentController::class, 'updateProperty'])->name('agent.properties.update');
            Route::get('/delete/{id}', [AgentController::class, 'deleteProperty'])->name('agent.properties.delete');
            Route::get('/all', [AgentController::class, 'all'])->name('agent.properties.all');
            Route::get('/pending', [AgentController::class, 'pending'])->name('agent.properties.pending');
            Route::get('/approved', [AgentController::class, 'approved'])->name('agent.properties.approved');
            Route::get('/declined', [AgentController::class, 'declined'])->name('agent.properties.declined');
        });
    });
});
