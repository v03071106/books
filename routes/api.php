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
        'middleware' => ['verify.jsonResponse'],
        'prefix' => 'v1'
    ], function ($router) {
        $router->post('/login', [Admin\AuthController::class, 'login'])->name('login');
        $router->post('/register', [Admin\AuthController::class, 'register'])->name('register');
        $router->group([
            'middleware' => ['verify.bearer', 'auth:api']
        ], function($router) {
            $router->post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');
            $router->resource('/books', Admin\BooksController::class)
                ->parameters(['books' => 'id'])
                ->only(['index', 'show', 'store', 'update', 'destroy']);
        });
});

Route::any('{any}', function(){
    return response()->json([], 404);
})->where('any', '.*');
