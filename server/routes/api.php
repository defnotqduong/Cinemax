<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
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
    Route::get('', [CategoryController::class, 'getAllCategory']);
    Route::post('', [CategoryController::class, 'createCategory']);
    Route::get('/{id}', [CategoryController::class, 'getCategory']);
    Route::put('/{id}', [CategoryController::class, 'editCategory']);
    Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
});

Route::group(['middleware' => 'api', 'prefix' => 'genre'], function ($routes) {
    Route::get('', [GenreController::class, 'getAllGenre']);
    Route::post('', [GenreController::class, 'createGenre']);
    Route::get('/{id}', [GenreController::class, 'getGenre']);
    Route::put('/{id}', [GenreController::class, 'editGenre']);
    Route::delete('/{id}', [GenreController::class, 'deleteGenre']);
});

Route::group(['middleware' => 'api', 'prefix' => 'country'], function ($routes) {
    Route::get('', [CountryController::class, 'getAllCountry']);
    Route::post('', [CountryController::class, 'createCountry']);
    Route::get('/{id}', [CountryController::class, 'getCountry']);
    Route::put('/{id}', [CountryController::class, 'editCountry']);
    Route::delete('/{id}', [CountryController::class, 'deleteCountry']);
});

Route::group(['middleware' => 'api', 'prefix' => 'movie'], function ($routes) {
    Route::get('', [MovieController::class, 'getAllMovie']);
    Route::post('', [MovieController::class, 'createMovie']);
    Route::get('/{id}', [MovieController::class, 'getMovie']);
    Route::put('/{id}', [MovieController::class, 'editMovie']);
    Route::delete('/{id}', [MovieController::class, 'deleteMovie']);
});

Route::group(['middleware' => 'api', 'prefix' => 'episode'], function ($routes) {
});
