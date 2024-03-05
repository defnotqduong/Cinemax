<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\AuthController;
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


// Auth

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/send-verify-mail/{email}', [AuthController::class, 'sendVerifyMail']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
});


// Admin

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('', [CategoryController::class, 'getAllCategory']);
        Route::post('', [CategoryController::class, 'createCategory']);
        Route::put('/{id}', [CategoryController::class, 'editCategory']);
        Route::get('/{id}', [CategoryController::class, 'getCategory']);
        Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
    });

    Route::group(['prefix' => 'region'], function () {
        Route::get('', [RegionController::class, 'getAllRegion']);
        Route::post('', [RegionController::class, 'createRegion']);
        Route::put('/{id}', [RegionController::class, 'editRegion']);
        Route::get('/{id}', [RegionController::class, 'getRegion']);
        Route::delete('/{id}', [RegionController::class, 'deleteRegion']);
    });

    Route::group(['prefix' => 'movie'], function () {
        Route::post('', [MovieController::class, 'createMovie']);
        Route::get('', [MovieController::class, 'getAllMovie']);
        Route::get('/filter', [MovieController::class, 'filterMovie']);
        Route::get('/{id}', [MovieController::class, 'getMovieOverview']);
        Route::put('/{id}', [MovieController::class, 'editMovie']);
        Route::get('/findByCategoryId/{id}', [MovieController::class, 'getMovieOfCategory']);
        Route::get('/findByRegionId/{id}', [MovieController::class, 'getMovieOfRegion']);
    });

    Route::group(['prefix' => 'episode'], function () {
    });
});
