<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
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

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');



Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index')->name('categories.list');
    Route::get('categories/create', 'create')->name('categories.create');
    Route::post('categories/store', 'store')->name('categories.store');
    Route::get('categories/children', 'getChildren')->name('categories.children');
});


Route::controller(ProductsController::class)->group(function () {
    Route::get('products', 'index')->name('products.list');
    Route::get('product/create', 'create')->name('products.create');
    Route::post('product/store', 'store')->name('products.store');
});

Route::controller(ProductVariantsController::class)->group(function () {
    Route::get('product_variants', 'index')->name('product-variants');
    Route::get('product-variant/create', 'create')->name('product-variants.create');
    Route::post('product-variant/store', 'store')->name('product-variants.store');
});

Route::controller(VariantAttributesController::class)->group(function () {
    Route::get('/variant_attributes', 'index')->name('variant-attributes');
    Route::get('/variant_attrubute/create', 'create')->name('variant-attributes.create');
    Route::post('/varaint_attribute/store', 'store')->name('variant-attributes.store');
});

Route::controller(VariantAttributeValuesController::class)->group(function () {
    Route::get('/variant_attribute_values', 'index')->name('variant-attribute-values');
    Route::get('/variant_attribute_values/create', 'create')->name('variant-attribute-values.create');
    Route::post('/variant_attribute_values/store', 'store')->name('variant-attribute-values.store');
});
