<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// access management
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
// end access management

// recipe management
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
// end recipe management


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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
//      access management
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
//      end access management

//      recipe management
        Route::resource('measures', MeasureController::class);
        Route::resource('ingredients', IngredientController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('products', ProductController::class);
        Route::resource('recipes', RecipeController::class);
        Route::get('product/info/{id}/{person}', 'App\Http\Controllers\RecipeController@productInfo');
        Route::get('searchStock', 'App\Http\Controllers\StockController@searchStock')->name('searchStock');
//      end recipe management


    });
