@extends('layouts.app')

@section('title_content')
  <h1>Editar Usuario</h1>
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
        {!! Form::model($user, ['url' => ['dashboard/user', encrypt($user)], 'method' => 'put']) !!}
            @include('dashboard.usuario.partials.form')
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('js2')
  <script>
    $( ".user" ).addClass( "active" );
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