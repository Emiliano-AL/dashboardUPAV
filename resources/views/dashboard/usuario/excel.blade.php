@extends('layouts.app')

@section('title_content')
  <h1>Cargar Usuarios</h1>
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
        @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('warning')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form method="POST" id="excelusers" enctype="multipart/form-data">
          @csrf
        <div class="col-sm-12">
            <div class="form-group">
                <b>Selecciona tu Archivo</b>
                <div class="form-line">
                    <input class="form-control" type="file" name="fileexcel" id="fileexcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12" align="right">
            <button type="submit" class="btn btn-primary" id="upload">Verificar</button>
        </div>
        </form>
        <div class="col-sm-12" id="loading"></div>
        <div class="col-sm-12" id="tableresponse"></div>
    </div>
</div>
@endsection

@section('js2')
<script>
  $(document).ready(function() {
    $("#excelusers").on("submit", function(event){
        event.preventDefault();
          if ($("#fileexcel").val()==="") {
          }else{
            $("#loading").html('<br><div class="alert alert-success" role="alert">Espere un momento...</div>');
            $.ajax({
                url: "/dashboard/userexcelupload",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  $('input[type="file"]').val('');
                  $("#loading").hide();
                  $("#tableresponse").html(data);
                  $.scrollTo(".upldus");
                }
            }).fail( function() {
            $("#loading").html('<br><div class="alert alert-danger" role="alert">Error al intentar cargar el archivo</div>');
            });
          }
    });
});
</script>
@endsection