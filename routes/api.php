<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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

Route::group([
        'prefix' => 'v1'
    ], function ($router) {
        Route::post('/login', [Admin\AuthController::class, 'login'])->name('login');
        Route::post('/register', [Admin\AuthController::class, 'register'])->name('register');

        Route::group(['middleware' => ['auth:api']], function() {
            Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');
            Route::resource('/books', Admin\BooksController::class)
                ->parameters(['books' => 'id'])
                ->only(['index', 'show', 'store', 'update', 'destroy']);
        });
});

Route::any('{any}', function(){
    return response()->json([], 404);
})->where('any', '.*');
