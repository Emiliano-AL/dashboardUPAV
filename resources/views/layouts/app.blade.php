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
            $('#all').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            });
        });
    </script>
@stop
