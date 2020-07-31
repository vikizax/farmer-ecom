<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// Admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // get CMS Banner Form
    Route::get('/admin/CmsBanner', 'AdminCMSController@create')->name('admincms.banner');

    // get CMS Top Ad form
    Route::get('/admin/CmsTopAd', 'AdminCMSController@create')->name('admincms.topAd');

    // get CMS Customer Review Form
    Route::get('/admin/CmsCustomerReview', 'AdminCMSController@create')->name('admincms.customerReview');

    // get CMS Footer Form
    Route::get('/admin/CmsFooter', 'AdminCMSController@create')->name('admincms.footer');

    // get CMS Bottom Ad Form
    Route::get('/admin/CmsBottomAd', 'AdminCMSController@create')->name('admincms.bottomAd');

    // get All Banner List
    Route::get('/admin/Banner', 'AdminCMSController@index')->name('admincms.bannerAll');

    // get All Top Ad list
    Route::get('/admin/TopAd', 'AdminCMSController@index')->name('admincms.topAdAll');

    // get All Customer Review List
    Route::get('/admin/CustomerReview', 'AdminCMSController@index')->name('admincms.customerReviewAll');

    // get All Bottom Ad List
    Route::get('/admin/BottomAd', 'AdminCMSController@index')->name('admincms.bottomAdAll');

    // CMS Banner Form save
    Route::post('/admin/CmsBannerStore', 'AdminCMSController@store')->name('admincms.bannerStore');

    // CMS Top Ad Form save
    Route::post('/admin/CmsTopAdStore', 'AdminCMSController@store')->name('admincms.topAdStore');

    // CMS Customer Review save
    Route::post('/admin/CmsCustomerReviewStore', 'AdminCMSController@store')->name('admincms.customerReviewStore');

    // CMS Bottom Ad Form save
    Route::post('/admin/CmsBottomAdStore', 'AdminCMSController@store')->name('admincms.bottomAdStore');

    // CMS Banner remove
    Route::delete('/admin/CmsBannerDelete/{id}', 'AdminCMSController@destroy')->name('admincms.bannerDelete');

    // CMS Top Ad remove
    Route::delete('/admin/CmsTopAdDelete/{id}', 'AdminCMSController@destroy')->name('admincms.topAdDelete');

    // CMS Customer review remove
    Route::delete('/admin/CmsCustomerReviewDelete/{id}', 'AdminCMSController@destroy')->name('admincms.customerReviewDelete');

    // CMS Bottom Ad remove
    Route::delete('/admin/CmsBottomAdDelete/{id}', 'AdminCMSController@destroy')->name('admincms.bottomAdDelete');

    // get add  new product category form
    Route::get('/admin/addCategory', 'AdminDashboardController@create')->name('admin.addCategoryForm');

    // add new product category to db
    Route::post('/admin/addCategory', 'AdminDashboardController@store')->name('admin.addCategory');

    // get admin dashboard
    Route::get('/admin/{page}', 'AdminDashBoardController@index')->name('admin.index');

    // get more details | edit  on admin dashboard
    Route::get('/admin/{page}/{id}/{show?}', 'AdminDashBoardController@more')->name('admin.more');

    // update category
    Route::post('/admin/updateCategory/{id}', 'AdminDashboardController@update')->name('admin.updateCategory');

    // delete category
    Route::post('/admin/deleteCategory/{id}', 'AdminDashboardController@destroy')->name('admin.deleteCategory');

    // approve user registration as seller
    Route::post('/admin/approveSeller/{id}', 'AdminDashboardController@update')->name('admin.sellerApprove');

    // deny user registration as seller
    Route::post('/admin/rejectSeller/{id}', 'AdminDashboardController@destroy')->name('admin.sellerReject');

    // approve product approval
    Route::post('/admin/approveProduct/{id}', 'AdminDashboardController@update')->name('admin.productApprove');

    // reject product approval
    Route::post('/admin/rejectProduct/{id}', 'AdminDashboardController@destroy')->name('admin.productReject');


    // get seller proof image
    Route::get('/storage/seller_proof/{imageName}', [
        'as' => 'image.show',
        'uses' => 'ImageControllerAdmin@show',
        'middleware' => 'auth',
    ]);
});

// Seller routes
Route::middleware(['auth', 'verified', 'isSeller'])->group(function () {

    // get add product for approval form
    Route::get('/seller/addProduct', 'SellerDashboardController@create')->name('sellerDash.addProductForm');

    // add product for approval
    Route::post('/seller/addProduct', 'SellerDashboardController@store')->name('sellerDash.addProduct');

    // get seller dashboard
    Route::get('/seller/{page}', 'SellerDashboardController@index')->name('sellerDash.index');

    // get update product form
    Route::get('/seller/updateProduct/{id}', 'SellerDashboardController@edit')->name('sellerDash.updateProductForm');

    // get order details
    Route::get('/seller/orderDetails/{id}', 'SellerDashboardController@showOrderDetails')->name('sellerDash.orderDetails');

    // update product
    Route::post('/seller/updateProduct/{id}', 'SellerDashboardController@update')->name('sellerDash.updateApprovedProduct');

    // delete product
    Route::post('/seller/deleteProduct/{id}', 'SellerDashboardController@destroy')->name('sellerDash.deleteProduct');
});

// Regular auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    // get user cart item list page
    Route::get('/cart', 'UserCartController@index')->name('cart.index');
    // add product to user cart
    Route::post('/cart/{id}', 'UserCartController@store')->name('cart.store');
    // delete product from user cart
    Route::delete('/cart/{id}', 'UserCartController@destroy')->name('cart.destroy');
    // get user wishlist
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
    // add product to the wish list
    Route::post('/wishlist/{id}', 'WishlistController@store')->name('wishlist.store');
    // delete product to the wish list
    Route::delete('/wishlist/{id}', 'WishlistController@destroy')->name('wishlist.destroy');
    // get account setting
    Route::get('/setting/{page}', 'UserAccountController@index')->name('setting.index');
    // update account setting
    Route::post('/setting/{id}', 'UserAccountController@update')->name('setting.update');
    // get register as Seller form
    Route::get('/sellerRegister', 'SellerController@index')->name('seller.index');
    // register as Seller
    Route::post('/sellerRegister', 'SellerController@store')->name('seller.store');
    // go to check out page
    Route::get('/checkout/{id}', 'UserCheckoutController@create')->name('checkout');
    // instamojo payment
    Route::post('/pay/{id}', 'InstamojoController@createRequest')->name('pay');
    // thankyou page after purchase
    Route::get('/thankyou/{id}/{order_id}', 'InstamojoController@thankyou');

    // webhook
    Route::post('/webhook', 'InstamojoController@webhook');
});


// get home page | admin dashboard | seller dashboard
Route::get('/', 'UserHomePageController@index')->name('home');

// get products
Route::get('/product/{filter?}/{search?}', 'UserProductPageController@index')->name('product.index');

// get product details
Route::get('/productDetails/{id}', 'UserProductPageController@show')->name('product.show');

// filter product
Route::post('/productFilter', 'UserProductPageController@filter')->name('product.filter');

// get products image
Route::get('/storage/product_image/{imageName}', [
    'as' => 'productImage.show',
    'uses' => 'ImageControllerProduct@show',
]);

// get CMS Banner image
Route::get('/storage/banner_image/{imageName}', [
    'as' => 'cmsBannerImage.show',
    'uses' => 'ImageControllerCmsBanner@show',
]);

// get CMS Banner image
Route::get('/storage/topAd_image/{imageName}', [
    'as' => 'cmsTopAdImage.show',
    'uses' => 'ImageControllerCmsTopAd@show',
]);

// get CMS Customer Review image
Route::get('/storage/customer_review_image/{imageName}', [
    'as' => 'cmsCustomerReviewImage.show',
    'uses' => 'ImageControllerCmsCustomerReview@show',
]);

// get CMS Customer Review image
Route::get('/storage/bottomAd_image/{imageName}', [
    'as' => 'cmsBottomAdImage.show',
    'uses' => 'ImageControllerCmsBottomAd@show',
]);
