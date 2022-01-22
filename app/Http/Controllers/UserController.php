<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Models\Validation;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Imports\UsersImport;
use Illuminate\Validation\Rule;

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

    public function excelupload()
    {
        $file = request()->file('fileexcel');
        $result = array();
        $result = Excel::toArray(new UsersImport(), $file);
        foreach($result as $row => $value){
          foreach($value as $row)
           {
                $value2[] = array('nombre' => $row['nombre'],
                    'email' => $row['email'],
                    'pass' => $row['pass'],
                    'rol1' => $row['rol1'],
                    'rol2' => @$row['rol2'],
                    'rol3' => @$row['rol3'],
                );
           }
        }
        $html='<form method="POST" action="/dashboard/userexceluploadadd"><input type="hidden" name="_token" value="'.Session::token().'">';
            $html.='<div class="table-responsive">
            <table class="table dataTable js-exportable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NOMBRE</th>
                  <th>EMAIL</th>
                  <th>CONTRASEÑA</th>
                  <th>ROL1</th>
                  <th>ROL2</th>
                  <th>ROL3</th>
                </tr>
              </thead>
              <tbody>';
            $cont = 1;
            $validator2 = Validator::make($value2, [
                '*.nombre' => 'required|string|max:255',
                '*.email' => 'required|string|email|max:255|unique:users',
                '*.pass' => 'required|min:8',
                '*.rol1' => 'required|string|'.Rule::in(['Administrador','Capturista','Validador']),
                '*.rol2' => 'nullable|string|'.Rule::in(['Administrador','Capturista','Validador']),
                '*.rol3' => 'nullable|string|'.Rule::in(['Administrador','Capturista','Validador']),
            ]);
            foreach ($value2 as $key => $value) {
                $validator = Validator::make($value, [
                    'nombre' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'pass' => 'required|min:8',
                    'rol1' => 'required|string|'.Rule::in(['Administrador','Capturista','Validador']),
                    'rol2' => 'nullable|string|'.Rule::in(['Administrador','Capturista','Validador']),
                    'rol3' => 'nullable|string|'.Rule::in(['Administrador','Capturista','Validador']),
                ]);
                if ($validator->fails()) {
                    $html.='<tr bgcolor="#F8D7DA">';
                }else{
                    $html.='<tr bgcolor="#D4EDDA">';
                }
                $html.='<th>'.$cont++.'</th>
                <td><input type="text" class="form-control" name="nombre[]" value="'.$value['nombre'].'" readonly></td>
                <td><input type="text" class="form-control" name="email[]" value="'.$value['email'].'" readonly></td>
                <td><input type="text" class="form-control" name="pass[]" value="'.$value['pass'].'" readonly></td>
                <td><input type="text" class="form-control" name="rol1[]" value="'.$value['rol1'].'" readonly></td>
                <td><input type="text" class="form-control" name="rol2[]" value="'.$value['rol2'].'" readonly></td>
                <td><input type="text" class="form-control" name="rol3[]" value="'.$value['rol3'].'" readonly></td>';
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $html.='<td>'.$errors->first().'</td>';
                }else{
                    $html.='<td><strong>Correcto</strong></td>';
                }
            }
            $html.= '</tbody></table></div>';
            if ($validator2->fails()) {
                $errors = $validator2->errors();
                $html.='<div class="row"><div class="col-md-12" align="center"><div class="alert alert-danger" role="alert"><strong>Verifique la información de su archivo</strong></div></div></div>';
            }else{
                  $html.='<div class="row"><div class="col-md-12" align="center"><button type="submit" class="btn btn-success upldus">Cargar</button></div></div>';
            }
            $html.='</form>';
            return $html;
    }

    public function exceluploadadd(Request $request)
    {
        $data = $request->all();
        $insert = array();
        foreach($data['nombre'] as $key => $detail) {
            $insert[$key]['nombre'] = $detail;
        }
        foreach($data['email'] as $key => $detail) {
            $insert[$key]['email'] = $detail;
        }
        foreach($data['pass'] as $key => $detail) {
            $insert[$key]['pass'] = $detail;
        }
        foreach($data['rol1'] as $key => $detail) {
            $insert[$key]['rol1'] = $detail;
        }
        foreach($data['rol2'] as $key => $detail) {
            $insert[$key]['rol2'] = $detail;
        }
        foreach($data['rol3'] as $key => $detail) {
            $insert[$key]['rol3'] = $detail;
        }
        foreach ($insert as $key) {
            $rols = [$key['rol1'],$key['rol2'],$key['rol3']];
            $rols2 = implode(', ', array_filter($rols));
            $newuser=new User;
            $newuser->rols= $rols2;
            $newuser->name= $key['nombre'];
            $newuser->email= $key['email'];
            $newuser->password= bcrypt($key['pass']);
            $newuser->status= true;
            $newuser->save();

        }
  
        return redirect()->back()->with('info', 'Archivo cargado con éxito');   
    }

}
