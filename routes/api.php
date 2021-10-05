<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

/**
 * Module Category
 */
Route::group([
	'prefix' => 'v1',
], function () {
	Route::apiResource('categories', '\App\Modules\Api\Controllers\CategoryController');
	// Route::apiResource(CategoryController::class);
});

/**
 * Module Device
 */
Route::group([
	'prefix' => 'v1',
], function () {
	Route::apiResource('devices', '\App\Modules\Api\Controllers\DeviceController');
	// Route::apiResource(DeviceController::class);
});
