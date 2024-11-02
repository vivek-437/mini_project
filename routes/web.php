<?php

use App\Http\Controllers\Admin\CategoriesController;
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



Route::controller(CategoriesController::class)->group(function(){
    Route::get('categories','index')->name('categories.list');
    Route::get('categories/create','create')->name('categories.create');
    Route::post('categories/store','store')->name('categories.store');


});