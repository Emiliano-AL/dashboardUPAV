@extends('layouts.app')

@section('title_content')
  <h1>Crear Rol</h1>
@endsection

@section('content2')
<div class="card">
    <div class="card-body">
        {!! Form::open(['url' => 'dashboard/rol']) !!}
            @include('dashboard.rol.partials.form')
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection