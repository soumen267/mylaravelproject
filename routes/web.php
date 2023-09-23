<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
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


Route::get('/confirm', function () {
    return view('mail/orderconfirm');
});
Route::get('/coupon-delete', function () {
    session()->forget('coupon');
});
Route::get('/ordercancel', function () {
    return view('mail/ordercancel');
});
// Route::get('/thank-you', function () {
//     return view('thank-you');
// });
Route::get('/about', function () {
    return view('about');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/checkout', function () {
    return view('checkout');
});
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/newsletter', [App\Http\Controllers\HomeController::class, 'newsletter'])->name('newsletter');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('wishstore');
Route::any('/settings', [App\Http\Controllers\SettingController::class, 'store'])->name('settings.index');
Route::post('/update', [App\Http\Controllers\SettingController::class, 'update'])->name('bannerupdate');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');
    Route::get('/owndetails', [AdminAuthController::class, 'getadminInfo'])->name('getadminInfo');
    Route::get('/edit/{id}', [AdminAuthController::class, 'editadmininfo'])->name('edit');
    Route::any('/update/{id}', [AdminAuthController::class, 'updateadmininfo'])->name('update');
    Route::get('forget-password', [AdminForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [AdminForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [AdminForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AdminForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/adminDashboard', function () {
            return view('admin/admindashboard');
        })->name('adminDashboard');
    });
});
Route::controller(UserController::class)->group(function(){
    Route::get('/userview', 'index')->name('userview');
    Route::get('/create', 'view')->name('create');
    Route::post('/adduser', 'createuser')->name('adduser');
    Route::get('/edituser/{id}', 'edituser')->name('edituser');
    Route::post('/updateuser/{id}', 'updateuser')->name('updateuser');
    Route::delete('/deleteuser/{id}', 'destroy')->name('deleteuser');
    Route::get('changeUserStatus', 'changeUserStatus')->name('changeUserStatus');
    Route::get('userprofileview', 'userprofileview')->name('userprofileview');
    Route::post('updateprofile', 'updateprofile')->name('updateprofile');
    Route::get('orderhistory', 'orderhistory')->name('orderhistory');
    Route::get('orderview/{id?}', 'orderview')->name('orderview');
    Route::post('orderview/cancelorder/{id}', 'cancelorder')->name('cancelorder');
    Route::get('/orders', 'orderdetails')->name('orders');
    Route::get('/orderdetails/{id}', 'orderdetailss')->name('ordersdetails');
    Route::post('/orderdetails/cancelorderadmin/{id}', 'cancelorderadmin')->name('admincancel');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('/categoryview', 'index')->name('categoryview');
    Route::get('/categorycreate', 'create')->name('createcategory');
    Route::post('/addcategory', 'store')->name('addcategory');
    Route::get('/editcategory/{id}', 'edit')->name('editcategory');
    Route::post('/updatcategory/{id}', 'update')->name('updatecategory');
    Route::delete('/deletecategory/{id}', 'destroy')->name('deletecategory');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('changeProductStatus', 'changeProductStatus')->name('changeProductStatus');
    Route::get('changeFeatureProductStatus', 'changeFeatureProductStatus')->name('changeFeatureProductStatus');
    Route::resource('products', ProductController::class);
});
Route::controller(CouponController::class)->group(function(){
    Route::get('changeStatus', 'changeStatus')->name('changeStatus');
    Route::post('/applycoupon', 'applyCoupon')->name('applyCoupon');
    Route::resource('coupons', CouponController::class);
});
Route::controller(CartController::class)->group(function(){
    Route::get('/shop', 'getshop')->name('shop');
    Route::get('/single/{id?}', 'getSingleProuctByID')->name('single');
    Route::post('/getProductById/{id}', 'getProductById')->name('getProductById');
    Route::any('/show', 'show')->name('show');
    Route::any('/cartshow', 'cartshow')->name('cartshow');
    Route::post('/addcart/{id}', 'addcart')->name('addcart');
    Route::post('/single/addcart/{id}', 'addcart')->name('addcart');
    Route::post('/cartUpdate/{id}', 'cartUpdate')->name('cartUpdate');
    Route::delete('/cartDelete/{id}', 'cartDeleteByID')->name('destroy');
    Route::delete('/deletecart', 'cartDelete')->name('deletecart');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/postorder', 'processOrder')->name('processOrder');
    Route::post('/getStatesByCountry/{id}', 'getStatesByCountry')->name('getStatesByCountry');
    Route::get('/thank-you', 'thankyou')->name('thank-you');
    Route::get('/cartCount', 'cartCount')->name('cartCount');
    Route::get('/wishCount', 'wishCount')->name('wishCount');
    Route::post('/recentview', 'recentView')->name('recentview');
});
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');
Route::post('/contactstore', [ContactUsController::class, 'store'])->name('contactstore');
Route::post('/cartadd', [WishlistController::class, 'cartadd'])->name('cartadd');
Route::resource('/wishlist', WishlistController::class);

Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});