<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReplayController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
// use Illuminate\Support\Facades\Route;

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
// use Illuminate\Http\Request;

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
Route::apiResource('Post', PostController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('Post', PostController::class);
Route::apiResource('likes',LikeController::class);
Route::apiResource('media', MediaController::class);
Route::apiResource('replay',ReplayController::class);
Route::apiResource('subscription', SubscriptionController::class);
Route::apiResource('thread', ThreadController::class);
Route::apiResource('user', UserController::class);


