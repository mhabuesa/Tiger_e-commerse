<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Models\inventory;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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
Route::get('/about', function () {    return view('about');});
Route::get('/profile_view', [ProfileController::class, 'profile'])->name('profile');



Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/single/product/{slug}',[FrontendController::class, 'single_product'])->name('single.product');
Route::post('/getSize', [FrontendController::class,'getSize']);
Route::post('/getQuantity', [FrontendController::class,'getQuantity']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user
Route::get('/user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('user/info/update', [UserController::class, 'user_info_update'])->name('user.info.update');

Route::post('password/update', [UserController::class, 'password_update'])->name('password.update');
Route::post('photo/update', [UserController::class, 'photo_update'])->name('photo.update');




//User
Route::post('/user/add', [HomeController::class, 'user_add'])->name('user.add');
Route::get('/user/list', [HomeController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');


//Category
Route::get('/category/add', [CategoryController::class, 'add_category'])->name('add.category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash', [CategoryController::class, 'category_trash'])->name('trash.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'category_update'])->name('category.update');
Route::post('/checked/delete', [CategoryController::class, 'checked_delete'])->name('checked.delete');
Route::post('/checked/restore', [CategoryController::class, 'checked_restore'])->name('checked.restore');
Route::get('/checked/permanent/delete', [CategoryController::class, 'permanent_delete'])->name('permanent.delete');


//Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('sub.category');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('sub.category.store');
Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'subcategory_edit'])->name('sub.category.edit');
Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'subcategory_update'])->name('sub.category.update');
Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'subcategory_delete'])->name('sub.category.delete');


//Product
Route::get('/add/product',[ProductController::class, 'add_product'])->name('add.product');
Route::POST('/getSubcategory',[ProductController::class, 'getSubcategory']);
Route::POST('/product/store',[ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list',[ProductController::class, 'product_list'])->name('product.list');
Route::post('/getstatus',[ProductController::class, 'getstatus']);
Route::get('/product/details/{id}',[ProductController::class, 'product_details'])->name('product.details');
Route::post('/product/edit/{id}',[ProductController::class, 'product_edit'])->name('product.edit');
Route::get('/product/delete/{id}',[ProductController::class, 'product_delete'])->name('product.delete');

//Brand
Route::get('/brand',[BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store',[BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/delete/{id}',[BrandController::class, 'brand_delete'])->name('brand.delete');
Route::get('/brand/edit/{id}',[BrandController::class, 'brand_edit'])->name('brand.edit');
Route::post('/brand/update/{id}',[BrandController::class, 'brand_update'])->name('brand.update');

//variation
Route::get('/variation',[VariationController::class, 'variation'])->name('variation');
Route::post('/color/store',[VariationController::class, 'color_store'])->name('color.store');
Route::get('/color/delete/{id}',[VariationController::class, 'color_delete'])->name('color.delete');
Route::post('/size', [VariationController::class, 'size_store'])->name('size.store');
Route::get('/size/delete/{id}', [VariationController::class, 'size_delete'])->name('size.delete');

// inventory
Route::get('inventory/{id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('inventory/store/{id}', [InventoryController::class, 'inventory_store'])->name('inventory.store');
Route::get('inventory/delete/{id}', [InventoryController::class, 'inventory_delete'])->name('inventory.delete');






//Banner
Route::get('/banner',[FrontendController::class, 'banner'])->name('banner');
Route::post('/banner/store',[FrontendController::class, 'banner_store'])->name('banner.store');
Route::get('/banner/delete/{id}',[FrontendController::class, 'banner_delete'])->name('banner.delete');
Route::get('/banner/delete/{id}',[FrontendController::class, 'banner_delete'])->name('banner.delete');



//Exciting Offers
Route::get('/offer', [FrontendController::class, 'offer'])->name('offer');
Route::post('/offer1/store{id}', [FrontendController::class, 'offer1_store'])->name('offer1.store');
Route::post('/offer2/store{id}', [FrontendController::class, 'offer2_store'])->name('offer2.store');


//big Offer
Route::get('/big/offer', [FrontendController::class, 'big_offer'])->name('big.offer');
Route::Post('/big/offer/store', [FrontendController::class, 'big_offer_store'])->name('big.offer.store');

//Deals Of The Day
Route::get('/deals',[FrontendController::class, 'deals'])->name('deals');

//Subscribe
Route::get('/subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
Route::post('/subscribe/store', [SubscribeController::class, 'subscribe_store'])->name('subscribe.store');



//Customer
//login/Register
Route::get('/customer/login', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/store', [CustomerAuthController::class, 'customer_store'])->name('customer.store');
Route::post('/customer/logged', [CustomerAuthController::class, 'customer_logged'])->name('customer.logged');


//Cart
Route::post('/cart/store/{product_id}', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/remove/{id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart.update', [CartController::class, 'cart_update'])->name('cart.update');

//Customer/Logout
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::get('/customer/logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');


//Customer Profile Update
Route::post('/customer/update', [CustomerController::class, 'customer_update'])->name('customer.update');
