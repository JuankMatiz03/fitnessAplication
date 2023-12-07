<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CaloriesController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum', 'cors')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api', 'cors')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/register', [RegisterController::class, 'createUser'])->name('register');
    Route::get('/getProfiles', [RegisterController::class, 'getProfiles'])->name('getProfiles');

    Route::get('user/{number_document}', [UserController::class, 'getUserByNumberDocument'])->name('user');
    Route::put('/update/{id}', [UserController::class, 'update']);

    Route::post('calories/add', [CaloriesController::class, 'addCalories'])->name('add');
    Route::get('calories/{number_document}', [CaloriesController::class, 'getCalories']);
});
