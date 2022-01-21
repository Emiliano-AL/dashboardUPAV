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
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>
  <!-- /.card-header -->
  <div class="card-body">
      <div class="card">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Usuarios Habilitados</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Usuarios Inhabilitados</a>
              </li>
            </ul>
          @if ($usuarios->count())
          <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active table-responsive" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <table class="table table-striped" id="all">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Estatus</th>
                            <th>Rol</th>
                            <th class="notexport"></th>
                            <th class="notexport"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                @if($usuario->status == true)
                                  <td>Habilitado</td>
                                @else
                                  <td bgcolor="yellow">Inhabilitado</td>
                                @endif
                                <td>{{$usuario->rols}}</td>
                                <td width="10px">
                                    <a class="btn btn-sm btn-primary" href="{{ url('/dashboard/user/'.encrypt($usuario->id).'/edit') }}">Editar</a>
                                </td>
                                <td width="10px">
                                  @if($usuario->status == true)
                                    <form action="{{ url('/dashboard/user/'.encrypt($usuario->id).'') }}" method="post">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-danger">Inhabilitar</button>
                                    </form>
                                  @else
                                    <a href="{{ url('/dashboard/user/'.encrypt($usuario->id).'') }}" class="btn btn-sm btn-success">Habilitar</a>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade table-responsive" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <table class="table table-striped" id="all2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Estatus</th>
                            <th>Rol</th>
                            <th class="notexport"></th>
                            <th class="notexport"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuariosno as $usuariono)
                            <tr>
                                <td>{{$usuariono->id}}</td>
                                <td>{{$usuariono->name}}</td>
                                <td>{{$usuariono->email}}</td>
                                @if($usuariono->status == true)
                                  <td>Habilitado</td>
                                @else
                                  <td bgcolor="yellow">Inhabilitado</td>
                                @endif
                                <td>{{$usuariono->rols}}</td>
                                <td width="10px">
                                    <a class="btn btn-sm btn-primary" href="{{ url('/dashboard/user/'.encrypt($usuariono->id).'/edit') }}">Editar</a>
                                </td>
                                <td width="10px">
                                  @if($usuariono->status == true)
                                    <form action="{{ url('/dashboard/user/'.encrypt($usuariono->id).'') }}" method="post">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-danger">Inhabilitar</button>
                                    </form>
                                  @else
                                    <a href="{{ url('/dashboard/user/'.encrypt($usuariono->id).'') }}" class="btn btn-sm btn-success">Habilitar</a>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
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