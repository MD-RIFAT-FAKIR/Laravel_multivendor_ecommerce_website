<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('frontend.index');
});

//user dashboard
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    //user profile store
    Route::post('/user/profile/store' , [UserController::class, 'UserProfileStore'])->name('user.profile.store');
});
// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin dash_board
Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    //admin logout
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    //admin profile
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    //admin profile save changes
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileSaveChange'])->name('admin.profile.store');
    //admin change password
    Route::get('admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    //admin update password
    Route::post('admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});
//admin login 
Route::get('/admin/login', [AdminController::class,'AdminLogin']);

//Vendor dash_board
Route::middleware(['auth','role:vendor'])->group(function() {
    //vendor dashboard
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    //vendor logout
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    //vendor profile
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfie'])->name('vendor.profile');
    //vendor profile store
    Route::post('vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    //vendor change password
    Route::get('vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    //vendor update password
    Route::post('vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
});
//vendor login
Route::get('/vendor/login', [VendorController::class, 'VendorLogin']);
