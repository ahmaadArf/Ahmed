<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;


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

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('index');

    //categories
    Route::get('categories/trash', [CategoryController::class, 'trach'])->name('categories.trash');
    Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forcedelete'])->name('categories.forcedelete');
    Route::resource('categories',CategoryController::class);

    //sliders
    Route::get('sliders/trash', [SliderController::class, 'trach'])->name('sliders.trash');
    Route::get('sliders/{id}/restore', [SliderController::class, 'restore'])->name('sliders.restore');
    Route::delete('sliders/{id}/forcedelete', [SliderController::class, 'forcedelete'])->name('sliders.forcedelete');
    Route::resource('sliders',SliderController::class);

    //products
    Route::get('products/trash', [ProductController::class, 'trach'])->name('products.trash');
    Route::get('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{id}/forcedelete', [ProductController::class, 'forcedelete'])->name('products.forcedelete');
    Route::resource('products',ProductController::class);

    //colors
    Route::get('colors/trash', [ColorController::class, 'trach'])->name('colors.trash');
    Route::get('colors/{id}/restore', [ColorController::class, 'restore'])->name('colors.restore');
    Route::delete('colors/{id}/forcedelete', [ColorController::class, 'forcedelete'])->name('colors.forcedelete');
    Route::resource('colors',ColorController::class);

    //sizes
    Route::get('sizes/trash', [SizeController::class, 'trach'])->name('sizes.trash');
    Route::get('sizes/{id}/restore', [SizeController::class, 'restore'])->name('sizes.restore');
    Route::delete('sizes/{id}/forcedelete', [SizeController::class, 'forcedelete'])->name('sizes.forcedelete');
    Route::resource('sizes',SizeController::class);

     //images
     Route::get('images/trash', [ImageController::class, 'trach'])->name('images.trash');
     Route::get('images/{id}/restore', [ImageController::class, 'restore'])->name('images.restore');
     Route::delete('images/{id}/forcedelete', [ImageController::class, 'forcedelete'])->name('images.forcedelete');
     Route::resource('images',ImageController::class);
});

Route::get('/',[SiteController::class,'index'])->name('site.index');
Route::get('about',[SiteController::class,'about'])->name('site.about');
Route::get('product-detail/{id}',[SiteController::class,'product_detail'])->name('site.product_detail');
Route::get('category-detail/{id}',[SiteController::class,'category_detail'])->name('site.category_detail');
Route::get('contact',[SiteController::class,'contact'])->name('site.contact');
Route::get('product',[SiteController::class,'product'])->name('site.product');
Route::get('shoping_cart',[SiteController::class,'shoping_cart'])->name('site.shoping_cart');
Route::post('add_to_cart',[SiteController::class,'add_to_cart'])->name('site.add_to_cart');
Route::post('add_review',[SiteController::class,'add_review'])->name('site.add_review');
Route::get('search',[SiteController::class,'search'])->name('site.search');
Route::post('add_to_favorite',[SiteController::class,'add_to_favorite'])->name('site.add_to_favorite');






