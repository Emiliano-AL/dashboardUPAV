<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::paginate(10);
        return view('dashboard.rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rol.create');
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
            'name' => 'required|max:255|string|unique:rols',
        ]);
        $request['status'] = isset($request['status']) ? 1 : 0;
        $role = Rol::create($request->all());
        return redirect('dashboard/rol/'.encrypt($role->id).'/edit')->with('info', 'El rol se creo correctamente');
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
        $rol = Rol::find(decrypt($id));
        return view('dashboard.rol.edit', compact('rol'));
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
        $role = decrypt($id);
        $request->validate([
            'name' => 'required|max:255|string|unique:rols,name,'.$role->id,
        ]);
        $request['status'] = isset($request['status']) ? 1 : 0;
        $role->update($request->all());
        return redirect('dashboard/rol/'.encrypt($role->id).'/edit')->with('info', 'El rol se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('rol_id', decrypt($id))->count();
        if ($user >= 1) {
            return redirect()->back()->with('error', 'Debes eliminar primero los usuarios con este rol');
        }
        $rol = Rol::find(decrypt($id));
        $rol->user->delete();
        return redirect('dashboard/rol')->with('info', 'El rol se eliminó correctamente');
    }
}
