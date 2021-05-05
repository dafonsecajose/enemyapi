<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EnemyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\LoginJwtController;
use App\Http\Controllers\Api\EnemySearchController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){

    Route::post('login', [LoginJwtController::class, 'login'])->name('login');
    Route::get('logout', [LoginJwtController::class, 'logout'])->name('logout');
    Route::get('refresh', [LoginJwtController::class, 'refresh'])->name('refresh');

    Route::prefix('search')->name('search.')->group(function (){
        Route::prefix('enemies')->name('enemies.')->group(function(){
            Route::get('/', [EnemySearchController::class, 'index'])->name('index');
            Route::get('/book', [EnemySearchController::class, 'book'])->name('book');
            Route::get('/search', [EnemySearchController::class, 'search'])->name('search');
            Route::get('/{slug}', [EnemySearchController::class, 'show'])->name('show');

        });
    });


    Route::group(['middleware' =>['jwt.auth']], function(){
            Route::apiResource('users', UserController::class,  ['parameters' => ['users' => 'id']]);

        Route::prefix('enemies')->name('enemies.')->group(function() {
            Route::get('/', [EnemyController::class, 'index'])->name('index');
            Route::get('/{id}', [EnemyController::class, 'show'])->name('show');
            Route::post('/', [EnemyController::class, 'store'])->name('save');
            Route::match(['PUT', 'POST'],'/{id}', [EnemyController::class, 'update'])->name('update');
            Route::delete('/{id}', [EnemyController::class, 'destroy'])->name('delete');
        });
    });
});




