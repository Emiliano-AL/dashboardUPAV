@extends('layouts.app')

@section('title_content')
  <h1>Crear Usuario</h1>
@endsection

@section('content2')
<div class="card">
    <div class="card-body">
        {!! Form::open(['url' => 'dashboard/user']) !!}
            @include('dashboard.usuario.partials.form')
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('js2')
  <script>
    $('.rol_id').select2({
        language: {
          noResults: function() {
            return "No hay resultados";
          },
          searching: function() {
            return "Buscando..";
          }
        },
        placeholder: "Elija una opción",
    }).width("100%");
  </script>
@endsection