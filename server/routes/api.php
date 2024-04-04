<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController as GuestCategoryController;
use App\Http\Controllers\MenuController as GuestMenuController;
use App\Http\Controllers\MovieController as GuestMovieController;
use App\Http\Controllers\RegionController as GuestRegionController;
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

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/send-verify-mail/{email}', [AuthController::class, 'sendVerifyMail']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
});


// Guest

Route::group([], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('', [GuestCategoryController::class, 'getAllCategory']);
    });

    Route::group(['prefix' => 'region'], function () {
        Route::get('', [GuestRegionController::class, 'getAllRegion']);
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('', [GuestMenuController::class, 'getMenu']);
    });

    Route::group(['prefix' => 'movie'], function () {
        Route::get('/forSlide', [GuestMovieController::class, 'getMovieForSlide']);
        Route::get('/findByCatalog', [GuestMovieController::class, 'getMoviesByCatalog']);
        Route::get('/findByCategory', [GuestMovieController::class, 'getMovieByCategory']);
        Route::get('/findByRegion', [GuestMovieController::class, 'getMovieByRegion']);
        Route::get('/{slug}', [GuestMovieController::class, 'getMovie']);
    });
});


// Admin

Route::group(['prefix' => 'cms'], function () {

    Route::group(['prefix' => 'menu'], function () {
        Route::get('', [MenuController::class, 'getMenu']);
    });

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
        Route::get('/{id}', [MovieController::class, 'getMovieOverview']);
        Route::put('/{id}', [MovieController::class, 'editMovie']);
        Route::get('/findByCategoryId/{id}', [MovieController::class, 'getMovieOfCategory']);
        Route::get('/findByRegionId/{id}', [MovieController::class, 'getMovieOfRegion']);
    });

    Route::group(['prefix' => 'episode'], function () {
    });
});
