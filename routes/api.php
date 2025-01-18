<?php

use App\Http\Controllers\Api\Auth\AdminController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OperationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::controller(UserController::class)->group(function () {
    Route::post('user/register', 'register');
    Route::post('user/login', 'login');
    Route::get('balance', 'getBalance')->middleware(['auth:sanctum',]);
    Route::get('auth/user', 'user')->middleware(['auth:sanctum',]);
});

Route::controller(AdminController::class)->group(function () {
    Route::post('admin/register', 'register');
    Route::post('admin/login', 'login');
});

Route::controller(OperationController::class)->group(function () {
    Route::get('operation/delete-all', 'deleteAll')->middleware(['auth:admin_api']);
    Route::get('operation/count', 'countOperations');
});
Route::group(['middleware' => 'auth:admin_api'], function () {

    Route::controller(OfferController::class)->group(function () {
        Route::get('offer/', 'index');
        Route::post('offer/add', 'store');
        Route::get('offer/delete/{id}', 'destroy');
        Route::get('offer/update/{id}', 'update');
    });
});

Route::resource('operation', OperationController::class)->middleware(['auth:sanctum']);
