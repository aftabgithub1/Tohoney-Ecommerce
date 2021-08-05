<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMultipleImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\StripePaymentController;

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

/**
 * TEST
 */
Route::get('test', function(){
  return view('test');
})->name('test');

/**
 * FRONTEND
 */
Route::get('', [FrontendController::class, 'home'])->name('home');
Route::get('contact', [FrontendController::class, 'contact']);
Route::get('faq', [FrontendController::class, 'faq']);
Route::get('cart', [FrontendController::class, 'cart']);
Route::get('cart/{coupon_name}', [FrontendController::class, 'apllyCoupon']);
Route::get('shop', [FrontendController::class, 'shop']);
Route::match(['get', 'post'], 'checkout', [FrontendController::class, 'checkout'])->name('checkout');


/**
 * ADMIN
 */
Route::get('admin_panel', [AdminController::class, 'adminPanel']);
Route::get('user_list', [AdminController::class, 'userList']);

/**
 * CUSTOMER
 */
Route::get('customer_panel', [CustomerController::class, 'customerPanel']);
Route::get('product_orders', [CustomerController::class, 'productOrders']);

/**
 * USER
 */
Route::get('profile', [UserController::class, 'profile']);
Route::get('change_password', [UserController::class, 'changePassword']);
Route::post('edit_profile_post/{id}', [UserController::class, 'editProfilePost'])
  ->name('change_password_post');
Route::post('change_password_post/{id}', [UserController::class, 'changePasswordPost'])
  ->name('change_password_post');

/**
 * FAQ
 */
Route::get('add_faq', [AdminController::class, 'addFaq']);
Route::post('add_faq_post', [AdminController::class, 'addFaqPost']);
Route::get('delete_faq/{id}', [AdminController::class, 'deleteFaq']);
Route::get('edit_faq/{id}', [AdminController::class, 'editFaq'])
  ->name('edit_faq');
Route::post('edit_faq_post', [AdminController::class, 'editFaqPost']);

/**
 * TRASH
 */
Route::get('trash', [TrashController::class, 'trashIndex']);
Route::get('restore/{id}', [TrashController::class, 'restore'])
  ->name('restore');
Route::get('force_delete/{id}', [TrashController::class, 'forceDelete'])
  ->name('force_delete');

/**
 * CART
 */
Route::post('add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::post('update_cart', [CartController::class, 'updateCart'])->name('update_cart');
Route::get('delete_cart_item/{product_id}', [CartController::class, 'deleteCartItem']);

/**
 * PRODUCT MULTIPAL IMAGES
 */
Route::get('edit_multiple_images/{product_id}', [ProductMultipleImageController::class, 'editMultiImages']);
Route::post('upload_multiple_images', [ProductMultipleImageController::class, 'uploadImages'])->name('upload_multiple_images');
Route::get('multiple_images_delete/{id}', [ProductMultipleImageController::class, 'delete']);

/**
 * ORDER
 */
Route::post('order', [OrderController::class, 'order'])->name('order');
Route::get('order_invoice/{id}', [OrderController::class, 'orderInvoice'])->name('order_invoice');
Route::get('order_pdf/{id}', [OrderController::class, 'orderPdf'])->name('order_pdf');
Route::get('send_sms/{id}', [OrderController::class, 'sendSms'])->name('send_sms');

/** 
 * STRIPE
 */
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

/* Routes for resource controller :

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('coupon', CouponController::class);

or, we can use array as follows, */

Route::resources([
  'category' => CategoryController::class,
  'product' => ProductController::class,
  'coupon' => CouponController::class
]);

