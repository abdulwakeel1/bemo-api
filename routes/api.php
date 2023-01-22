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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [App\Http\Controllers\Api\AuthController::class, 'createUser']);
Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'loginUser']);


Route::post('/columns/create', [App\Http\Controllers\Api\ColumnController::class, 'store']);
Route::get('/columns', [App\Http\Controllers\Api\ColumnController::class, 'getColumns']);
Route::delete('/columns/{column}/delete', [App\Http\Controllers\Api\ColumnController::class, 'destroy']);


Route::get('/cards', [App\Http\Controllers\Api\CardController::class, 'getAllCards']);
Route::post('/card/create', [App\Http\Controllers\Api\CardController::class, 'store']);
Route::post('/card/move', [App\Http\Controllers\Api\CardController::class, 'processCardMovement']);


// Route::post('/auth/register', [AuthController::class, 'createUser']);
// Route::post('/auth/login', [AuthController::class, 'loginUser']);?

// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');