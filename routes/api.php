<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\BusRouteController;
use App\Http\Controllers\Api\SeatClassController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\BusCategoryController;
use App\Http\Controllers\Api\BusScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
});
