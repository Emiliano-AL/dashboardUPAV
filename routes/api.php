<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// POST: Login { correo, pass }
    // {  error: false, data: { mensaje: ok, token: token } } // 8hrs payload { idUser, nombre, rol }
// POST: NuevoEstudiante { nombrefoto: string, matricula:string, nombre: string, nivelAcedimico:string, nombrePlantel: string, clavePlantel: string  }
// {  error: false, data: { mensaje: ok} }
// POST: ResultadoValidacion { resultadoValidacion: , idValidando:number, matricula: string }
// {  error: false, data: { mensaje: ok} }
// POST: Listado de las validaciones,