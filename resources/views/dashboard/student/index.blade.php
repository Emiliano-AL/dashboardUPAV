@extends('layouts.app')

@section('title_content')
  <h1>Estudiantes</h1>
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
        <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#addstudent">
            Nuevo Estudiante
        </button>
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
          @if ($students->count())
          <div class="card-body table-responsive">
              <table class="table table-striped" id="all">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Matrícula</th>
                          <th>Nombre</th>
                          <th>Fotografia</th>
                          <th></th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($students as $student)
                          <tr>
                              <td>{{$student->id}}</td>
                              <td>{{$student->matricula}}</td>
                              <td>{{$student->fullname}}</td>
                              <td> </td>
                              <td width="10px">
                                  <a class="btn btn-sm btn-primary" href="{{ url('/dashboard/student/'.encrypt($student->id).'/edit') }}">Editar</a>
                              </td>
                              <td width="10px">
                                  <form action="{{ url('/dashboard/student/'.encrypt($student->id).'') }}" method="post">
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

<div class="modal fade" id="addstudent">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Estudiante</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url' => 'dashboard/student']) !!}
        <div class="modal-body">
            @include('dashboard.student.partials.form')
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection