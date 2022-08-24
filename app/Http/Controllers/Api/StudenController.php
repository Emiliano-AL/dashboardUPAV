<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Validation;

class StudenController extends Controller
{
    /**
     * Registro de estudiante
     */
    public function create(Request $request)
    {
        try{
            $request->validate([
                'matricula' => 'required|max:255|string|unique:students,matricula',
                'fullname' => 'required|max:255|string|unique:students,fullname',
                'namePicture' => 'required|max:255|string|unique:students,namePicture',
            ]);
        }catch(\Exception $e){
            return $e->errors();
        }

        Student::create([
            'matricula' => $request->matricula,
            'fullname' => $request->fullname,
            'namePicture' => $request->namePicture,
        ]);

        return response()->json([
            'error' => false,
            'data' => ['message' => 'ok']
        ]);
    }

    /**
     * Registro de validacion de estudiante
     */
    public function validation(Request $request)
    {
        try{
            $request->validate([
                'matricula' => 'required|max:255|string|unique:validations,matricula',
            ]);
        }catch(\Exception $e){
            return $e->errors();
        }

        Validation::create([
            'student_id' => $request->student_id,
            'user_id' => $request->user_id,
            'matricula' => $request->matricula,
            'validationResult' => $request->validationResult,
        ]);

        return response()->json([
            'error' => false,
            'data' => ['message' => 'ok']
        ]);
    }

    /**
     * Get By Matrícula
     */
    public function getStudent(Request $request, $matricula)
    {
        // dd($matricula);
        // try{
        //     $request->validate([
        //         'matricula' => 'required|max:255|string|exists:students,matricula',
        //     ]);
        // }catch(\Exception $e){
        //     return $e->errors();
        // }

        $info = Student::where('matricula', $matricula)->get();

        return response()->json([
            'error' => false,
            'data' => $info
        ]);
    }

    /**
     * Syncronize photo
     */
    public function syncronizePhoto(Request $request)
    {
        try{
            $request->validate([
                'matricula' => 'required|max:255|string|exists:students,matricula',
                'namePicture' => 'required|max:255|string|unique:students,namePicture',
            ]);
        }catch(\Exception $e){
            return $e->errors();
        }

        Student::where('matricula', $request->matricula)->update(['namePicture' => $request->namePicture]);

        return response()->json([
            'error' => false,
            'data' => ['message' => 'ok']
        ]);
    }


}
