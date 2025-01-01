<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductVariantImagesController;
use App\Http\Controllers\Admin\ProductVariantsController;
use App\Http\Controllers\Admin\VariantAttributesController;
use App\Http\Controllers\Admin\VariantAttributeValuesController;
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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');


// ----------------------------------Admin----------------------------------------------------
Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index')->name('categories.list');
    Route::get('categories/create', 'create')->name('categories.create');
    Route::post('categories/store', 'store')->name('categories.store');
    Route::get('categories/children', 'getChildren')->name('categories.children');
});


Route::controller(ProductsController::class)->group(function () {
    Route::get('products', 'index')->name('products.list');
    Route::get('products/create', 'create')->name('products.create');
    Route::post('products/store', 'store')->name('products.store');
});

Route::controller(ProductVariantsController::class)->group(function () {
    Route::get('product_variants', 'index')->name('product-variants');
    Route::get('product-variants/create', 'create')->name('product-variants.create');
    Route::post('product-variants/store', 'store')->name('product-variants.store');
});

Route::controller(VariantAttributesController::class)->group(function () {
    Route::get('/variant_attributes', 'index')->name('variant-attributes');
    Route::get('/variant_attrubutes/create', 'create')->name('variant-attributes.create');
    Route::post('/varaint_attributes/store', 'store')->name('variant-attributes.store');
});

Route::controller(VariantAttributeValuesController::class)->group(function () {
    Route::get('/variant_attribute_values', 'index')->name('variant-attribute-values');
    Route::get('/variant_attribute_values/create', 'create')->name('variant-attribute-values.create');
    Route::post('/variant_attribute_values/store', 'store')->name('variant-attribute-values.store');
});

Route::controller(ProductVariantImagesController::class)->group(function () {
    Route::get('/product_variant_images', 'index')->name('product-variant-images');
    Route::get('product_variant_images/create', 'create')->name('product-variant-images.create');
    Route::post('product_variant_images/store', 'store')->name('product-variant-images.store');
    Route::get('/product_variant_images/attribute-values/{id}', 'getAttributeValues')->name('product-variant-images.attribute-values');
});


// ----------------------------------customer--------------------------------------------------
Route::get('/', function () {
    return view('cutomer.404');
})->name('dashboard');