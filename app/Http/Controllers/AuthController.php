<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Validation;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status === 0 || Auth::user()->rol_id != 1) {
                auth()->logout();
                return redirect('/')->with('error', 'Error al acceder, consulta al administrador.');
            }
            request()->session()->regenerate();
            return redirect('/dashboard/home');
        }
        return redirect('/')->with('error', 'Correo electrónico o contraseña incorrecto.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $users = User::count();
        $student = Student::count();
        $validation = Validation::where('validationResult','RECONOCIDO')->count();
        $validationno = Validation::where('validationResult','NO_RECONOCIDO')->count();
        return view('home', compact('users','student','validation','validationno'));
    }

}
