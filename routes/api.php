<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\FrontStore\CartController;
use App\Http\Controllers\FrontStore\HomeController;
use App\Http\Controllers\FrontStore\SearchController;
use App\Http\Controllers\FrontStore\ProductController;
use App\Http\Controllers\Dashboard\Admin\BuyerController;
use App\Http\Controllers\Dashboard\Admin\SupplierController;

// for home page routes and urls
Route::controller(HomeController::class)
    ->prefix('/home')
    ->name('home.')
    ->group(function(){
        Route::get('/tab/category/{category_id}','tabCategoryProducts')->name('tabCategoryProducts');
        Route::get('/recommended','recommendedProducts')->name('recommended');
        
        // only for tetings purposes routes
        Route::get('/home','home')->name('home.testing');
        Route::get('/featuredProducts','featuredProducts')->name('featuredProducts.testing');
        Route::get('/newArrivalProducts','newArrivalProducts')->name('newArrivalProducts.testings');
    }
);

Route::post('frontstore/cart',[CartController::class,'addOrDeleteItemToBuyerCart']);

Route::get('admin/buyer/{buyer_id}', [BuyerController::class, 'getBuyerDetail'])->name('admin.buyer');
Route::get('admin/supplier/{supplier_id}', [SupplierController::class, 'getSupplierDetail'])->name('admin.supplier');

// only for tetings purposes routes
Route::get('product/{product_id}',[ProductController::class, 'index']);
Route::get('product/getCommentsAndRatings/{product_id}',[ProductController::class, 'getCommentsAndRatings']);

Route::get('search/',[SearchController::class, 'searchFilterByLocation']);

Route::get('/cart',[CartController::class,'index']);
Route::get('/updateColumnsOfStarsRatingsOrdersOfProduct',[TestingController::class,'updateColumnsOfStarsRatingsOrdersOfProduct']);
