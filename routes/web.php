<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ImageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showSignIn'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/image/upload', [ImageController::class, 'upload'])->name('image.upload');


Route::get('/test-upload-route', function() {
    if (Route::has('image.upload')) {
        return 'Upload route exists';
    } else {
        return 'Upload route does not exist';
    }
});

Route::get('/test-upload', function() {
    return view('test-upload');
});

Route::prefix('admin')->group(function () {
    // Public admin routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    
    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        
        // Image management
        Route::get('/images', [ImageController::class, 'index'])->name('admin.images.index');
        Route::get('/images/pending', [ImageController::class, 'pending'])->name('admin.images.pending');
        Route::get('/images/approved', [ImageController::class, 'approved'])->name('admin.images.approved');
        Route::get('/images/rejected', [ImageController::class, 'rejected'])->name('admin.images.rejected');
        Route::patch('/images/{image}/approve', [ImageController::class, 'approve'])->name('admin.images.approve');
        Route::patch('/images/{image}/reject', [ImageController::class, 'reject'])->name('admin.images.reject');
    });
});
