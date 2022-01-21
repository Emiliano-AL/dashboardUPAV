<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Models\Validation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('status', true)->paginate(100);
        $usuariosno = User::where('status', false)->paginate(100);
        return view('dashboard.usuario.index', compact('usuarios','usuariosno'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolquery = Rol::select('name', 'name')->where('status', true);
        $roles = $rolquery->pluck('name', 'name')->toArray();
        return view('dashboard.usuario.create', compact('roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rols' => 'required',
        ]);
        $request['status'] = isset($request['status']) ? 1 : 0;
        $request['password'] = bcrypt($request['password']);
        $request['rols'] = implode(', ',$request['rols']);
        $usuario = User::create($request->all());
        return redirect('dashboard/user/'.encrypt($usuario->id).'/edit')->with('info', 'El usuario se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find(decrypt($id));
        $usuario->status = true;
        $usuario->save();
        return redirect('dashboard/user')->with('info', 'El usuario se habilitó correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(decrypt($id));
        $rolquery = Rol::select('name', 'name')->where('status', true);
        $roles = $rolquery->pluck('name', 'name')->toArray();
        $user->rols = explode(", ", $user->rols);
        return view('dashboard.usuario.edit', compact('user', 'roles'));
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
        $usuario = decrypt($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$usuario->id,
            'password' => 'nullable',
            'rols' => 'required',
        ]);
        if(isset($request->password)){
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
        }
        $request['status'] = isset($request['status']) ? 1 : 0;
        $inf = User::find($usuario->id);
        $inf->name = $request->name;
        $inf->email = $request->email;
        if(isset($request->password)){
            $request['password'] = bcrypt($request['password']);
        }
        $inf->rols = implode(', ',$request['rols']);
        $inf->status = $request['status'];
        $inf->save();
        return redirect('dashboard/user/'.encrypt($usuario->id).'/edit')->with('info', 'El usuario se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find(decrypt($id));
        $usuario->status = false;
        $usuario->save();
        return redirect('dashboard/user')->with('info', 'El usuario se ha inhabilitado correctamente');
    }
}
