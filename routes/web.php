<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;


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
    //user profile logout
    Route::get('/user/profile/logout' , [UserController::class, 'UserProfileLogout'])->name('user.profile.logout');
    //user update password
    Route::post('/user/update/password' , [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});


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
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');
//become a vendor
Route::get('become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
//vendor register
Route::post('vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');


Route::middleware(['auth','role:admin'])->group(function() {
    //Backend all brand
    Route::controller(BrandController::class)->group(function() {
        //all brand 
        Route::get('all/brand', 'AllBrand')->name('all.brand');
        //brand add
        Route::get('add/brand', 'AddBrand')->name('add.brand');
        //save brand
        Route::post('store/brand', 'StoreBrand')->name('store.brand');
        // edit brand
        Route::get('edit/brand/{id}', 'EditBrand')->name('edit.brand');
        //update brand
        Route::post('update/brand', 'UpdateBrand')->name('update.brand');
        // delete brand
        Route::get('delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

});

//admin category
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::controller(CategoryController::class)->group(function() {
        //all catecory
        Route::get('all/category', 'AllCategory')->name('all.category');
        //add category
        Route::get('add/category', 'AddCategory')->name('add.category');
        //store category
        Route::post('store/category', 'StoreCategory')->name('store.category');
        //edit category
        Route::get('edit/category/{id}', 'EditCategory')->name('edit.category');
        //pudate category
        Route::post('update/category', 'UpdateCategory')->name('update.category');
        //delete category
        Route::get('delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });
});

//admin subcategory
Route::middleware(['auth', 'role:admin'])->group(function() {
    
    Route::controller(SubcategoryController::class)->group(function() {
        //all subcategories
        Route::get('all/subcategory', 'AllSubcategory')->name('all.subcategory');
        //add subcategories
        Route::get('add/subcategory' , 'AddSubcategory')->name('add.subcategory');
        //store subcategory
        Route::post('store/subcategory' , 'StoreSubcategory')->name('store.subcategory');
        //edit subcategory
        Route::get('edit/subcategory/{id}', 'EditSubcategory')->name('edit.subcategory');
        //update subcategory
        Route::post('update/subcategory', 'UpdateSubcategory')->name('update.subcategory');
        //delete subcategory
        Route::get('delete/subcategory/{id}', 'DeleteSubcategory')->name('delete.subcategory');
        // subcategory automatically load in admin add product page,
        // when category is selected 
        Route::get('/subcategory/ajax/{category_id}', 'GetSubcategory');

    });
});


//Vendor inactive and active all route
Route::controller(AdminController::class)->group(function() {
    //inactive vendor
    Route::get('inactive/vendor' , 'InactiveVendor')->name('inactive.vendor');
    //active vendor
    Route::get('active/vendor' , 'ActiveVendor')->name('active.vendor');
    //inactive vendor details
    Route::get('inactibe/vendor/details/{id}', 'InactiveVendorDetails')->name('inactibe.vendor.details');
    //inactive vendor approve
    Route::post('inactive/vendor/approve' , 'InactiveVendorApprove')->name('inactive.vendor.approve');
    //active vendor details page
    Route::get('active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
    //active vendor disapprove
    Route::post('active/vendor/disapprove' , 'ActiveVendorDisapprove')->name('active.vendor.disapprove');

});

//Admin product all route
Route::controller(ProductController::class)->group(function() {
    //all product
    Route::get('all/product', 'AllProduct')->name('all.product');
    //add product
    Route::get('add/product', 'AddProduct')->name('add.product');
    //store product
    Route::post('store/product', 'StoreProduct')->name('store.product');
    //edit product
    Route::get('edit/product/{id}', 'EditProduct')->name('edit.product');
    //update product
    Route::post('/update/product', 'UpdateProduct')->name('update.product');
    //update product main thambnail
    Route::post('update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
    //update product multi imgae
    Route::post('update/product/multiimg', 'UpdateProductMultiImg')->name('update.product.multiimg');
    //delete product multi image
    Route::get('delete/product/multiimg/{id}', 'DeleteProductMultiImg')->name('delete.product.multiimg');
    //product status active to inactive
    Route::get('product/inactive/{id}', 'ProductInactive')->name('product.inactive');
    //product status inactive to active
    Route::get('product/active/{id}', 'ProductActive')->name('product.active');
    //delete admin poduct
    Route::get('delete/product/{id}', 'DeleteProduct')->name('delete.product');



});