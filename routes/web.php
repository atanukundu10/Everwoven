<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'home']);
Route::get('/shop', function () {
    return view('shop');
});

Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('/testimonial', function () {
    return view('testimonial');
});
Route::get('/404', function () {
    return view('404');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/admin-signin', [UserController::class, 'admin_signin']);
Route::get('/admin-display', [AdminController::class, 'admin_display']);
Route::get('/admin-show-sellers', [AdminController::class, 'admin_show_sellers']);
Route::get('/admin-show-all-items', [AdminController::class, 'admin_show_all_items']);
Route::get('/admin-approve-seller', [AdminController::class, 'admin_approve_seller']);
Route::get('/admin-approved-seller{seller_id}', [AdminController::class, 'admin_approved_seller']);
Route::get('/admin-rejected-seller{seller_id}', [AdminController::class, 'admin_rejected_seller']);
Route::get('/admin-delete-user{delete_id}', [AdminController::class, 'admin_delete_user']);
Route::get('/admin-block-user{block_id}', [AdminController::class, 'admin_block_user']);
Route::get('/admin-unblock-user{unblock_id}', [AdminController::class, 'admin_unblock_user']);
Route::get('/admin-delete-seller{unblock_id}', [AdminController::class, 'admin_delete_seller']);
Route::get('/admin-block-seller{block_id}', [AdminController::class, 'admin_block_seller']);
Route::get('/admin-unblock-seller{unblock_id}', [AdminController::class, 'admin_unblock_seller']);
Route::get('/admin-logout', [AdminController::class, 'admin_logout']);


Route::get('/login', [UserController::class, 'login']);
Route::post('/signin', [UserController::class, 'signin']);
Route::get('/signup', [UserController::class, 'signup']);
Route::post('/submit', [UserController::class, 'submit']);
Route::get('/display', [UserController::class, 'display']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/edit', [UserController::class, 'edit']);
Route::post('/save_changes', [UserController::class, 'save_changes']);
Route::get('/changepassword',[UserController::class,'changepassword']);
Route::post('/change_password', [UserController::class, 'change_password']);
Route::get('/add-cart-items{product_id}',[UserController::class,'add_cart_items']);
Route::get('/cart-details', [UserController::class,'cart_details']);
Route::get('/checkout', [UserController::class,'checkout']);


Route::get('/seller-portal', [SellerController::class, 'seller_portal']);
Route::get('/seller-login', [SellerController::class, 'seller_login']);
Route::post('/seller-signin', [SellerController::class, 'seller_signin']);
Route::get('/seller-home', [SellerController::class, 'seller_home']);
Route::get('/seller-signup', [SellerController::class, 'seller_signup']);
Route::post('/seller-submit', [SellerController::class, 'seller_submit']);
Route::get('/seller-logout', [SellerController::class, 'seller_logout']);
Route::get('/add-new-product', [SellerController::class, 'add_product']);
Route::post('/product-submit', [SellerController::class, 'product_submit']);
Route::get('/seller-view-products', [SellerController::class, 'seller_view_products']);
