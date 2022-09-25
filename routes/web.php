<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontStore\CartController;
use App\Http\Controllers\FrontStore\HomeController;
use App\Http\Controllers\FrontStore\OrderController;
use App\Http\Controllers\FrontStore\SearchController;
use App\Http\Controllers\FrontStore\ProductController;

use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\LogoutController;
use App\Http\Controllers\authentication\RegisterController;

use App\Http\Controllers\Dashboard\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Dashboard\Buyer\ProfileController as BuyerProfileController;
use App\Http\Controllers\Dashboard\Buyer\DashboardController as BuyerDashboardController;

use App\Http\Controllers\Dashboard\Supplier\OrderController as SupplierOrderController;
use App\Http\Controllers\Dashboard\Supplier\ProfileController as SupplierProfileController;
use App\Http\Controllers\Dashboard\Supplier\DashboardController as SupplierDashboardController;
use App\Http\Controllers\Dashboard\Supplier\ProductController as SupplierProductController;
use App\Http\Controllers\Dashboard\Supplier\ShopController as SupplierShopController;

use App\Http\Controllers\Dashboard\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Dashboard\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dashboard\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Dashboard\Admin\SupplierController as AdminSupplierController;
use App\Http\Controllers\Dashboard\Admin\BuyerController as AdminBuyerController;
use App\Http\Controllers\Dashboard\Admin\CategoryController as AdminCategoryController;

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

Route::get('/',[HomeController::class, 'home'])->name('homePage');
Route::get('/product/{product_id}', [ProductController::class, 'index'])->name('productPage');
Route::get('/search', [SearchController::class, 'index'])->name('searchPage');
Route::get('/search/{state_city_query_category}', [SearchController::class, 'searchByStateCityQueryCategory'])->name('search_state_city_query_category');
Route::get('/search/category/{category_id}', [SearchController::class, 'searchByCategory'])->name('searchByCategory');


Route::get('/register',[RegisterController::class, 'registerPage'])->name('register');
Route::post('/register',[RegisterController::class,'register'])->name('register');


Route::get('/login',[LoginController::class,'loginPage'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login');



// authenticated routes for buyer
Route::middleware('auth:buyer')
    ->prefix('/buyer')
    ->name('buyer.')
    ->group(function(){
        // store frontend routes
        Route::post('/product/comment',[ProductController::class, 'createComment'])->name('product.comment');
        Route::get('/cart',[CartController::class, 'index'])->name('cart');
        Route::get('/order/product/{product_id}',[OrderController::class, 'index'])->name('order');
        Route::post('/product/placeorder',[OrderController::class, 'placeOrder'])->name('placeOrder');

        // dashboard routes
        Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [BuyerProfileController::class, 'index'])->name('profile');
        Route::post('/profile/updateInformation', [BuyerProfileController::class, 'updateInformation'])->name('profile.updateInformation');
        Route::post('/profile/updatePassword', [BuyerProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::get('/order', [BuyerOrderController::class, 'index'])->name('dashboard.order');
        Route::get('/order/{order_id}/cancel', [BuyerOrderController::class, 'cancel'])->name('dashboard.order.cancel');
        Route::get('/order/{order_id}/markAsCompleted', [BuyerOrderController::class, 'markAsCompleted'])->name('dashboard.order.markAsCompleted');

        Route::get('/logout',[LogoutController::class, 'buyerLogout'])->name('logout');
    }
);

// authenticated routes for supplier
Route::middleware('auth:supplier')
    ->prefix('/supplier')
    ->name('supplier.')
    ->group(function(){
        Route::get('/dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [SupplierProfileController::class, 'index'])->name('profile');
        Route::post('/profile/updateInformation', [SupplierProfileController::class, 'updateInformation'])->name('profile.updateInformation');
        Route::post('/profile/updatePassword', [SupplierProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        
        Route::get('/product', [SupplierProductController::class, 'index'])->name('dashboard.product');
        Route::get('/product/create', [SupplierProductController::class, 'createPage'])->name('dashboard.product.createPage');
        Route::post('/product/create', [SupplierProductController::class, 'create'])->name('dashboard.product.create');
        Route::get('/product/{product_id}/edit', [SupplierProductController::class, 'editPage'])->name('dashboard.product.editPage');
        Route::post('/product/edit', [SupplierProductController::class, 'edit'])->name('dashboard.product.edit');
        Route::get('/product/{product_id}/delete', [SupplierProductController::class, 'delete'])->name('dashboard.product.delete');
        
        Route::get('/order', [SupplierOrderController::class, 'index'])->name('dashboard.order');
        Route::get('/order/{order_id}/cancel', [SupplierOrderController::class, 'cancel'])->name('dashboard.order.cancel');
        Route::get('/order/{order_id}/approve', [SupplierOrderController::class, 'approve'])->name('dashboard.order.approve');

        Route::get('/shop', [SupplierShopController::class, 'index'])->name('shop');
        Route::post('/shop/update', [SupplierShopController::class, 'updateInformation'])->name('shop.updateInformation');

        Route::get('/logout',[LogoutController::class, 'supplierLogout'])->name('logout');
    }
);

// authenticated routes for admin
Route::middleware('auth:admin')
    ->prefix('/admin')
    ->name('admin.')
    ->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::post('/profile/updateInformation', [AdminProfileController::class, 'updateInformation'])->name('profile.updateInformation');
        Route::post('/profile/updatePassword', [AdminProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        
        Route::get('/product', [AdminProductController::class, 'index'])->name('dashboard.product');
        Route::get('/product/{product_id}/approve', [AdminProductController::class, 'approve'])->name('dashboard.product.approve');
        Route::get('/product/{product_id}/cancel', [AdminProductController::class, 'cancel'])->name('dashboard.product.cancel');

        Route::get('/supplier', [AdminSupplierController::class, 'index'])->name('dashboard.supplier');
        Route::get('/supplier/{supplier_id}/approve', [AdminSupplierController::class, 'approve'])->name('dashboard.supplier.approve');
        Route::get('/supplier/{supplier_id}/delete', [AdminSupplierController::class, 'delete'])->name('dashboard.supplier.delete');

        Route::get('/buyer', [AdminBuyerController::class, 'index'])->name('dashboard.buyer');
        Route::get('/buyer/{buyer_id}/approve', [AdminBuyerController::class, 'approve'])->name('dashboard.buyer.approve');
        Route::get('/buyer/{buyer_id}/delete', [AdminBuyerController::class, 'delete'])->name('dashboard.buyer.delete');

        Route::get('/category', [AdminCategoryController::class, 'index'])->name('dashboard.category');
        Route::post('/category/create', [AdminCategoryController::class, 'create'])->name('dashboard.category.create');        
        Route::get('/category/{category_id}/delete', [AdminCategoryController::class, 'delete'])->name('dashboard.category.delete');
        
        Route::get('/logout',[LogoutController::class, 'adminLogout'])->name('logout');
    }
);


// for tests only
Route::get('featuredProducts',[HomeController::class, 'featuredProducts']);
