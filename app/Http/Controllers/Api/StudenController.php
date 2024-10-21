<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Validation;
use Illuminate\Support\Facades\Storage;

class StudenController extends Controller
{
    public function getPhotoStudent($filename){
        $path = 'uploaded/students/' . $filename;
        if (Storage::disk('public')->exists($path)) {
            return response()->file(storage_path('app/public/' . $path));
        }
        return response()->json(['error' => 'Image not found'], 404);
    }

    /**
     * Registro de estudiante
     */
    public function create(Request $request)
    {
        try{
            $request->validate([
                'matricula' => 'required|max:255|string|unique:students,matricula',
                'fullname' => 'required|max:255|string|unique:students,fullname',
                'picture' => 'required|image|max:2048',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'data' => $e->errors()
            ]);
        }

        $nombreDeAlmacenaje = $request->matricula.'.';
        $tipo = $request->file('picture')->getClientOriginalExtension();
        $nombreDeAlmacenaje .= $tipo;
        $request->file('picture')->storeAs('/', $nombreDeAlmacenaje, 'upload_students');

        Student::create([
            'matricula' => $request->matricula,
            'fullname' => $request->fullname,
            // 'namePicture' => $request->namePicture,
            'namePicture' => $nombreDeAlmacenaje,
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
        $info = Student::where('matricula', $matricula)->first();
        // dd($info);
        if(!is_null($info)){
            return response()->json([
                'error' => false,
                'data' => $info
            ]);
        }else {
            return response()->json([
                'error' => true,
                'data' => []
            ]);
        }
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
