@extends('layouts.app')

@section('title_content')
  <h1>Usuarios</h1>
@endsection

@section('content2')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6" align="left">
          <strong>
              Lista
          </strong>
      </div>
      <div class="col-md-6" align="right">
          <a href="{{ url('/dashboard/user/create') }}" class="btn btn-success btn-sm mb-2">Nuevo Usuario</a>
      </div>
    </div>
    @if(session('info'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif 
  </div>
  <!-- /.card-header -->
  <div class="card-body">
      <div class="card">
          @if ($usuarios->count())
          <div class="card-body table-responsive">
              <table class="table table-striped" id="all">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Correo electrónico</th>
                          <th>Estatus</th>
                          <th>Rol</th>
                          <th></th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($usuarios as $usuario)
                          <tr>
                              <td>{{$usuario->id}}</td>
                              <td>{{$usuario->name}}</td>
                              <td>{{$usuario->email}}</td>
                              @if($usuario->status == true)
                              <td>Activo</td>
                              @else
                              <td bgcolor="yellow">Inactivo</td>
                              @endif
                              <td>{{$usuario->rol->name}}</td>
                              <td width="10px">
                                  <a class="btn btn-sm btn-primary" href="{{ url('/dashboard/user/'.encrypt($usuario->id).'/edit') }}">Editar</a>
                              </td>
                              <td width="10px">
                                  <form action="{{ url('/dashboard/user/'.encrypt($usuario->id).'') }}" method="post">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                  </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          @else
          <div class="card-body">
              <strong>No hay registros</strong>
          </div>
          @endif
      </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection