@extends('layouts.app')

@section('title_content')
  <h1>Editar Rol</h1>
@endsection

@section('content2')
<div class="card">
    <div class="card-body">
        @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('info')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        {!! Form::model($rol, ['url' => ['dashboard/rol', encrypt($rol)], 'method' => 'put']) !!}
            @include('dashboard.rol.partials.form')
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection