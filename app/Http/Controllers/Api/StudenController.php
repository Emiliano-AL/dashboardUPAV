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
    public function newstudent(Request $request)
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
     * Registro de estudiante
     */
    public function newvalidation(Request $request)
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

}
