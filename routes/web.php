<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Dashboard\UpdateUserController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ManageItemsController;
use App\Http\Controllers\dashboard\ManageBzTransactionsController;
use App\Http\Controllers\dashboard\ManageProfileController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialAuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Custom
Route::get('/', [CustomAuthController::class,'login'])->name('login')->middleware('alreadyLoggedIn');
Route::get('/login_account', [CustomAuthController::class,'loginCustomer'])->name('login_account')->middleware('alreadyLoggedIn');
Route::get('/register_user', [CustomAuthController::class,'registration'])->name('register_user');
Route::get('/create_account', [CustomAuthController::class,'createAccount'])->name('create_account');
Route::post('/submit_user', [CustomAuthController::class,'submitUser'])->name('submit_user');
Route::post('/submit_customer', [CustomAuthController::class,'submitCustomer'])->name('submit_customer');
Route::post('/login_user', [CustomAuthController::class,'loginUser'])->name('login_user');
Route::get('/logout_user', [CustomAuthController::class,'logoutUser'])->name('logout_user');
Route::get('/logout_account', [CustomAuthController::class,'logoutAccount'])->name('logout_account');
Route::get('/view_account', [CustomAuthController::class,'viewAccount'])->name('view_account');

// Cancel Orders
Route::put('/orders/{id}/cancel', [CartController::class, 'cancelOrder'])->name('orders.cancel');

// Profile
    Route::get('/edit_account', 
        [ManageProfileController::class, 'editAccount']
    )->name('edit_account')->middleware('alreadyLoggedIn');

    Route::post('/update_account', 
        [ManageProfileController::class, 'updateAccount']
    )->name('update_account');


// Update User Avatar
Route::post('/update_user_avatar', [UpdateUserController::class, 'updateUser'])->name('updateUser');

// Dasboard
// Route::get('/login', 'App\Http\Controllers\Dashboard\DashboardController@login');
// Route::get('/dashboard', 'App\Http\Controllers\Dashboard\DashboardController@dashboard')->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', 'App\Http\Controllers\dashboard\DashboardController@dashboard')->middleware('isLoggedIn')->name('dashboard');

// Route::get('/dashboard', function(){
//     return view('/dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// Manage Applicants
Route::get('/manage_applicants', 'App\Http\Controllers\Dashboard\ManageApplicantsController@index');
Route::get('/applicants_datatables', 'App\Http\Controllers\Dashboard\ManageApplicantsController@applicantsDataTable');

// Rivers
// Route::get('/', 'App\Http\Controllers\Main\MainPageController@index');
//Route::get('/checkout', 'App\Http\Controllers\Main\MainPageController@checkout')->name('checkout');

// Store
// Route::get('/', 'App\Http\Controllers\Main\StorePageController@index')->name('store.index');
Route::post('/search_item', 'App\Http\Controllers\Main\StorePageController@searchItem')->name('search_item');

// Events
Route::get('/events', 'App\Http\Controllers\Main\StorePageController@events')->name('store.events');

// View Cart
Route::get('/view_cart/{itemId}', 'App\Http\Controllers\Main\MainPageController@viewCart');
Route::get('/view_cart', 'App\Http\Controllers\Main\MainPageController@viewCart')->name('view_cart');

// Payment
Route::post('/submit_buyer_details', 'App\Http\Controllers\Payments\PaymentsController@submitBuyerDetails')->name('submit_buyer_details');

// Add To Cart
Route::post('/add_item_to_cart', 'App\Http\Controllers\Cart\CartController@addItemToCart')->name('add_item_to_cart');
Route::post('/delete_item', 'App\Http\Controllers\Cart\CartController@deleteItem')->name('delete_item');
Route::get('/flush_cart', 'App\Http\Controllers\Cart\CartController@flushCart')->name('flush_cart');

// Update Cart
Route::post('/update_cart', 'App\Http\Controllers\Cart\CartController@updateCart')->name('update_cart');

// Checkout
Route::post('/checkout', 'App\Http\Controllers\Cart\CartController@checkout')->name('checkout');
Route::post('/confirm_order', 'App\Http\Controllers\Cart\CartController@confirmOrder')->name('confirm_order');

// Place Order
Route::get('/place_order', 'App\Http\Controllers\Cart\CartController@placeOrder')->name('place_order');
Route::get('/order_completed/{oId}', 'App\Http\Controllers\Cart\CartController@orderCompleted')->name('order_completed');

// Page Expired
Route::get('/page_expired', 'App\Http\Controllers\Cart\CartController@pageExpired')->name('page_expired');

// Get Images per Item and Display to Modal
Route::get('/get_images_per_item/{itemIdNoVal}', 'App\Http\Controllers\Main\MainPageController@getImagesPerItem');

// Manage Items
Route::get('/manage_items', 'App\Http\Controllers\dashboard\ManageItemsController@index')->name('manage_items');
Route::get('/items_datatables', 'App\Http\Controllers\dashboard\ManageItemsController@itemsDataTable')->name('items.datatables');
Route::get('/add_item_form', 'App\Http\Controllers\dashboard\ManageItemsController@addItemForm')->name('add_item_form');
Route::post('/add_item', 'App\Http\Controllers\dashboard\ManageItemsController@addItem')->name('add_item');
Route::get('/update_item_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@updateItemForm')->name('update_item_form');
Route::post('/update_item/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@updateItem')->name('update_item');
Route::get('/add_image_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@addImageForm');
Route::post('/add_item_image', 'App\Http\Controllers\dashboard\ManageItemsController@addItemImage')->name('add_item_image');
Route::post('/delete_item_image','App\Http\Controllers\dashboard\ManageItemsController@deleteItemImage')->name('delete_item_image');

// Manage Studios
Route::get('/manage_units', 'App\Http\Controllers\dashboard\ManageItemsController@units')->name('manage_units');
Route::get('/units_datatables', 'App\Http\Controllers\dashboard\ManageItemsController@unitsDataTable')->name('units.datatables');
Route::get('/add_unit_form', 'App\Http\Controllers\dashboard\ManageItemsController@addUnitForm')->name('add_unit_form');
Route::post('/add_unit', 'App\Http\Controllers\dashboard\ManageItemsController@addUnit')->name('add_unit');
Route::get('/update_unit_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@updateUnitForm')->name('update_unit_form');
Route::post('/update_unit/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@updateUnit')->name('update_unit');
Route::get('/add_image_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@addImageForm');
Route::post('/add_item_image', 'App\Http\Controllers\dashboard\ManageItemsController@addItemImage')->name('add_item_image');
Route::post('/delete_item_image', 'App\Http\Controllers\dashboard\ManageItemsController@deleteItemImage')->name('delete_item_image');

// Add Faciity
Route::get('/add_facility_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@addFacilityForm');
Route::post('/add_facility', 'App\Http\Controllers\dashboard\ManageItemsController@addFacility')->name('add_facility');
Route::post('/delete_facility', 'App\Http\Controllers\dashboard\ManageItemsController@deleteFacility')->name('delete_facility');

// Add Amenity
Route::get('/add_amenity_form/{itemIdNo}', 'App\Http\Controllers\dashboard\ManageItemsController@addAmenityForm');
Route::post('/add_amenity', 'App\Http\Controllers\dashboard\ManageItemsController@addAmenity')->name('add_amenity');
Route::post('/delete_amenity', 'App\Http\Controllers\dashboard\ManageItemsController@deleteAmenity')->name('delete_amenity');

// CHeck Orders
Route::get('/check_orders', 'App\Http\Controllers\dashboard\ManageItemsController@checkOrders')
    ->name('check_orders');

Route::post('/mark_order_checked', 'App\Http\Controllers\dashboard\ManageItemsController@markOrderChecked')
    ->name('mark_order_checked');

// Manage Orders
Route::get('/manage_bz_transactions', 'App\Http\Controllers\dashboard\ManageBzTransactionsController@index')->name('manage_bz_transactions');
Route::get('/bztrans_datatables', 'App\Http\Controllers\dashboard\ManageBzTransactionsController@bzTransDataTable')->name('bztrans_datatables');

// Viewing the Item before Adding to Cart
Route::get('/view_item_store/{itemIdNo}', 'App\Http\Controllers\Main\StorePageController@viewItemStore');

// About
Route::get('/about', 'App\Http\Controllers\Main\StorePageController@about')->name('about');
// Buyer Central
Route::get('/buyer_central', 'App\Http\Controllers\Main\StorePageController@buyer_central')->name('buyer_central');
// Route::get('/create_account', 'App\Http\Controllers\Main\StorePageController@create_account')->name('create_account');
Route::get('/contacts', 'App\Http\Controllers\Main\StorePageController@contacts')->name('contacts');

// Socialite
Route::get('/socialite-test', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login/google', [SocialAuthController::class, 'redirectGoogle']);
Route::get('/login/google/callback', [SocialAuthController::class, 'callbackGoogle']);

Route::get('/login/facebook', [SocialAuthController::class, 'redirectFacebook']);
Route::get('/login/facebook/callback', [SocialAuthController::class, 'callbackFacebook']);

Route::get('/download-app', function () {
    $file = public_path('downloads/application-77bd6e36-d303-44c4-a27a-8e828087f4d0.apk'); // Make sure this is your APK path

    if (!file_exists($file)) {
        abort(404, 'APK file not found.');
    }

    return response()->download($file, 'buzytown.apk', [
        'Content-Type' => 'application/vnd.android.package-archive'
    ]);
});

// Page Fallback
Route::fallback(function () {
    return view('online.page_error');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
