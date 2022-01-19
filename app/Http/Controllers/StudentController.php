<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('dashboard.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:255|string|unique:students,fullname',
            'matricula' => 'required|max:255|string|unique:students,matricula',
        ]);
        $student = Student::create($request->all());
        return redirect('dashboard/student')->with('info', 'El estudiante se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find(decrypt($id));
        return view('dashboard.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = decrypt($id);
        $request->validate([
            'fullname' => 'required|max:255|string|unique:students,fullname,'.$student->id,
            'matricula' => 'required|max:255|string|unique:students,matricula,'.$student->id,
        ]);
        $student->update($request->all());
        return redirect('dashboard/student/'.encrypt($student->id).'/edit')->with('info', 'El estudiante se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find(decrypt($id));
        $student->validations()->delete();
        $student->delete();
        return redirect('dashboard/student')->with('info', 'El estudiante se eliminó correctamente');
    }
}
