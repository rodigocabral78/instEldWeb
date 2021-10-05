<?php

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
	'namespace' => '\App\Modules\Api\Controllers',
	'prefix' => 'v1',
], function () {
	Route::apiResource('categories', CategoryController::class);
});

/**
* Module Device
*/
Route::group([
	'namespace' => '\App\Modules\Api\Controllers',
	'prefix' => 'v1',
], function () {
	Route::apiResource('devices', DeviceController::class);
});
