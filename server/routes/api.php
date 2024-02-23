<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($routes) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::get('/send-verify-mail/{email}', [AuthController::class, 'sendVerifyMail']);
    // Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
});

Route::group(['middleware' => 'api', 'prefix' => 'category'], function ($routes) {
    Route::post('', [CategoryController::class, 'createCategory']);
});

Route::group(['middleware' => 'api', 'prefix' => 'genre'], function ($routes) {
});

Route::group(['middleware' => 'api', 'prefix' => 'country'], function ($routes) {
});

Route::group(['middleware' => 'api', 'prefix' => 'movie'], function ($routes) {
});

Route::group(['middleware' => 'api', 'prefix' => 'episode'], function ($routes) {
});
