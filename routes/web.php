<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ValidationController;

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
});

Route::group([
    'prefix' => 'dashboard'
], function () {
    
    //DASHBOARD
    Route::get('home', [HomeController::class, 'dashboard']);

    //ADMINISTRATION
    Route::resource('rol', RolController::class);
    Route::resource('user', UserController::class);
    Route::resource('student', StudentController::class);
    Route::resource('validation', ValidationController::class);

});