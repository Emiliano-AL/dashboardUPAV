<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController;

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
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
            'middleware' => 'auth:api'
        ], function() { 
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group([
    'prefix' => 'dashboard'
], function () {
    
    //DASHBOARD
    Route::get('home', [HomeController::class, 'dashboard']);

    //ROLES
    Route::get('rol', [RolController::class, 'index']);
    Route::post('rol', [RolController::class, 'store']);
    Route::put('rol/{id}', [RolController::class, 'update']);
    Route::delete('rol/{id}', [RolController::class, 'destroy']);

});

/*Route::post('register', [AuthController::class, 'register']);*/
