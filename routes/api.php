<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudenController;

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
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});


// POST: Login { correo, pass }
    // {  error: false, data: { mensaje: ok, token: token } } // 8hrs payload { idUser, nombre, rol }
// POST: NuevoEstudiante { nombrefoto: string, matricula:string, nombre: string, nivelAcedimico:string, nombrePlantel: string, clavePlantel: string  }
// {  error: false, data: { mensaje: ok} }
// POST: ResultadoValidacion { resultadoValidacion: , idValidando:number, matricula: string }
// {  error: false, data: { mensaje: ok} }
// POST: Listado de las validaciones,
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'student'
], function () {
    ///FUNCTIONS API
    Route::post('create', [StudenController::class, 'create']);
    Route::post('validation', [StudenController::class, 'validation']);
    Route::get('photo/{filename}', [StudenController::class, 'getPhotoStudent']);

    Route::post('sync-picture', [StudenController::class, 'syncronizePhoto']);
    Route::get('by-matricula/{matricula}', [StudenController::class, 'getStudent']);
});
