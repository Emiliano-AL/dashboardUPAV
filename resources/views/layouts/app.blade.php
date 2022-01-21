@extends('adminlte::page')

@section('content_header')
    @yield('title_content')
@stop

@section('content')
    @yield('content2')
@stop

@section('footer')
    <strong>Copyright &copy; 2021 UPAV.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    <b>V.</b> 1.0
    </div>
@stop

@section('js')
    
    @yield('js2')
    <script>
        $(function () {
            $('#all, #all2').DataTable({
            dom: 'lBfrtip',
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": true,
            buttons: [{
                extend: 'excel',
                exportOptions: {columns: ':not(.notexport)'}
            },
            {
                extend: 'colvis',
                exportOptions: {columns: ':not(.notexport)'}
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            },
            });
        });
    </script>
@stop
