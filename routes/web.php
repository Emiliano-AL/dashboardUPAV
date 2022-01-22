<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
            'middleware' => 'auth'
        ], function() { 
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
/*Route::post('register', [AuthController::class, 'register']);*/

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'auth',
], function () {
    
    //DASHBOARD
    Route::get('home', [AuthController::class, 'dashboard']);

    //ADMINISTRATION
    Route::resource('rol', RolController::class);
    Route::resource('user', UserController::class);
    Route::get('userexcel', function () {return view('dashboard.usuario.excel');});
    Route::post('userexcelupload', [UserController::class, 'excelupload']);
    Route::post('userexceluploadadd', [UserController::class, 'exceluploadadd']); 
    Route::resource('student', StudentController::class);
    Route::resource('validation', ValidationController::class);

});