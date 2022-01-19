@extends('adminlte::page')

@section('content_header')
    @yield('title_content')
@stop

@section('content')
    @yield('content2')
@stop

@section('footer')
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.1.0
    </div>
@stop

@section('js')
    @yield('js2')
    <script>
        $(function () {
            $('#all').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            });
        });
    </script>
@stop
