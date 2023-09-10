<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')
    ->name('categories.')->middleware('api')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [CategoryController::class, 'show'])
            ->name('show');
    });

Route::prefix('contact')->middleware('api')
    ->name('contact.')->middleware('api')
    ->group(function () {
        Route::get('/', [ContactController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [ContactController::class, 'show'])
            ->name('show');

        Route::post('/create', [ContactController::class, 'store'])
            ->name('store');

        Route::patch('/update/{id}', [ContactController::class, 'update'])
            ->name('update');

        Route::delete('/remove/{id}', [ContactController::class, 'destroy'])
            ->name('remove');
    });
