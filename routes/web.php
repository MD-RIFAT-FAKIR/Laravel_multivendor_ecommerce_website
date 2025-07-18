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

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistConrtoller;
use App\Http\Controllers\User\CompareController;

use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;



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

// Route::get('/', function () {
//     return view('frontend.index');
// });
//index route
Route::get('/', [IndexController::class, 'Index']);

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
Route::get('/admin/login', [AdminController::class,'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

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

    //vendor product all route
    Route::controller(VendorProductController::class)->group(function() {
        //vendor all product 
        Route::get('vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        //vendor add product 
        Route::get('vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        //vendor store product in database
        Route::post('vendor/store/product' , 'VendorStoreProduct')->name('vendor.store.product');
        //vendor edit product
        Route::get('vendor/edit/product/{id}' , 'VendorEditProduct')->name('vendor.edit.product');
        //vendor update product
        Route::post('vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        //vendor update product thambnail
        Route::post('vendor/update/product/thambnail', 'VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        //vendor update product multi images
        Route::post('vendor/update/product/multiimg', 'VendorUpdateProductMultiImage')->name('vendor.update.product.multiimg');
        //vendor delete product multi images
        Route::get('vendor/delete/product/multiimg/{id}', 'VendorDeleteProductMultiImage')->name('vendor.delete.product.multiimg');
        //vendor product active to inactive
        Route::get('vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        //vendor product inactive to active
        Route::get('vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        //vendor product delete
        Route::get('vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');



         // subcategory automatically load in admin add product page,
        // when category is selected 
        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubcategory');
    });
});
//vendor login
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
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

});//End Backend all brand

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
});//End admin category

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
});//End admin subcategory


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

});//End Vendor inactive and active all route

//Admin product all route
Route::middleware(['auth', 'role:admin'])->group(function() {

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
    });// end Admin product all route

    //Slider all route
    Route::controller(SliderController::class)->group(function() {
        //all slider
        Route::get('all/slider', 'AllSlider')->name('all.slider');
        //add slider
        Route::get('add/slider', 'AddSlider')->name('add.slider');
        //store slider
        Route::post('store/slider', 'StoreSlider')->name('store.slider');
        //edit slider
        Route::get('edit/slider/{id}', 'EditSlider')->name('edit.slider');
        //update slider
        Route::post('update/slider', 'UpdateSlider')->name('update.slider');
        //delete category
        Route::get('delete/slider/{id}', 'DeleteSlider')->name('delete.slider');

    });//End Slider all route


    //banner all route
    Route::controller(BannerController::class)->group(function() {
        //all banner
        Route::get('all/banner', 'AllBanner')->name('all.banner');
        //add banner
        Route::get('add/banner', 'AddBanner')->name('add.banner');
        //store banner
        Route::post('store/banner', 'StoreBanner')->name('store.banner');
        //edit banner
        Route::get('edit/banner/{id}', 'EditBanner')->name('edit.banner');
        //update banner
        Route::post('update/banner', 'UpdateBanner')->name('update.banner');
        //delete banner
        Route::get('delete/banner/{id}', 'DeleteBanner')->name('delete.banner');

    });//End banner all route

});


//frontend product details all route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

//frontend vendor details all route
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

//frontend all vendor list
Route::get('vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

//frontend categorywise product display
Route::get('product/category/{id}/{slug}', [IndexController::class, 'CatwiseProduct']);

//frontend subcategory wise product display
Route::get('product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatwiseProduct']);

//product quick view modal 
Route::get('/product/view/modal/{id}' , [IndexController::class, 'productViewAjax']);

//cart data store uinsg ajax
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

//product add to mini cart
Route::get('/product/mini/cart' , [CartController::class, 'AddMiniCart']);

//remove product mini cart 
Route::get('/minicart/product/remove/{rowId}' , [CartController::class, 'RemoveMiniCart']);

//add to cart from details page
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

//add to wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistConrtoller::class, 'addToWishlist']);
/// Add to Compare 
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

    //wishlist all route
    Route::middleware(['auth','role:user'])->group(function() {
        Route::controller(WishlistConrtoller::class)->group(function() {
            Route::get('/wishlist', 'AllWishlist')->name('wishlist');
            //get product
            Route::get('/get-wishlist-product', 'GetWishlistProduct');
            //remove product
            Route::get('/wishlist-remove/{id}', 'WishlistProductRemove');
        });
    });

    //Compare all route
    Route::middleware(['auth','role:user'])->group(function() {
        Route::controller(CompareController::class)->group(function() {
            Route::get('/compare', 'AllCompare')->name('compare');
            //get product
            Route::get('/get-compare-product', 'GetCompareProduct');
            //remove compare product
            Route::get('/compare-remove/{id}', 'CompareProductRemove');
        });
    });

    //cart all route
    Route::middleware(['auth','role:user'])->group(function() {
        Route::controller(CartController::class)->group(function() {
            Route::get('/mycart', 'MyCart')->name('mycart');
            Route::get('/get-cart-product', 'GetMyCart');
            Route::get('/cart-remove/{id}', 'CartRemove');
            //decrement product quantiry
            Route::get('/decrement-cart/{rowId}', 'DecrementCart');
            //increment product quantiry
            Route::get('/increment-cart/{rowId}', 'IncrementCart');
        });
    });


//coupn system all route
Route::middleware(['auth', 'role:admin'])->group(function() {
    
    Route::controller(CouponController::class)->group(function() {
        //all coupon
        Route::get('all/coupon', 'AllCoupon')->name('all.coupon');
        //add coupon
        Route::get('add/coupon' , 'AddCoupon')->name('add.coupon');
        //store coupon
        Route::post('store/coupon' , 'StoreCoupon')->name('store.coupon');
        //edit coupon
        Route::get('edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        //update coupon
        Route::post('update/coupon', 'UpdateCoupon')->name('update.coupon');
        //delete subcategory
        Route::get('delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });
});//End acoupn system


//Shipping Area all route
Route::middleware(['auth', 'role:admin'])->group(function() {
    //division 
    Route::controller(ShippingAreaController::class)->group(function() {
        //all division
        Route::get('all/division', 'AllDivision')->name('all.division');
        //add division
        Route::get('add/division' , 'AddDivision')->name('add.division');
        //store division
        Route::post('store/division' , 'StoreDivision')->name('store.division');
        //edit division
        Route::get('edit/division/{id}', 'EditDivision')->name('edit.division');
        //update division
        Route::post('update/division', 'UpdateDivision')->name('update.division');
        //delete division
        Route::get('delete/division/{id}', 'DeleteDivision')->name('delete.division');
    });//end division


    //district 
    Route::controller(ShippingAreaController::class)->group(function() {
        //all district
        Route::get('all/district', 'AllDistrict')->name('all.district');
        //add district
        Route::get('add/district' , 'AddDistrict')->name('add.district');
        //store district
        Route::post('store/district' , 'StoreDistrict')->name('store.district');
        //edit district
        Route::get('edit/district/{id}', 'EditDistrict')->name('edit.district');
        //update division
        Route::post('update/district', 'UpdateDistrict')->name('update.district');
        //delete division
        Route::get('delete/district/{id}', 'DeleteDistrict')->name('delete.district');
    });//end district


    //state
    Route::controller(ShippingAreaController::class)->group(function() {
        //all district
        Route::get('all/state', 'AllState')->name('all.state');
        //add district
        Route::get('add/district' , 'AddDistrict')->name('add.district');
        //store district
        Route::post('store/district' , 'StoreDistrict')->name('store.district');
        //edit district
        Route::get('edit/district/{id}', 'EditDistrict')->name('edit.district');
        //update division
        Route::post('update/district', 'UpdateDistrict')->name('update.district');
        //delete division
        Route::get('delete/district/{id}', 'DeleteDistrict')->name('delete.district');
    });//end district


});//Shipping Area system