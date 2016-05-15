
@extends('admin.layout')
@section('header')
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Include one of jTable styles. -->
    <link href="{{asset('jtable/themes/jqueryui/jtable_jqueryui.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Inclusion de jquery ui tema -->
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/flick/jquery-ui.css" />

    <!-- Include jTable script file. -->
    <script src="{{asset('jtable/jquery.jtable.min.js')}}" type="text/javascript"></script>

    <!-- Idioma Español para Jtable -->
    <script src="{{asset('jtable/localization/jquery.jtable.es.js')}}"></script>
    {{--Incluir datatables  --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/dataTables.jqueryui.min.js"></script>
@stop
@section('content')
    <div id="table" class=""></div>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#table').jtable({
            title: 'Directiva',
            jqueryuiTheme: true,
            actions: {
                listAction:   "{{url('ajax/directiva/list')}}",
                createAction: "{{url('ajax/directiva/create')}}",
                updateAction: "{{url('ajax/directiva/edit')}}",
                deleteAction: "{{url('ajax/directiva/remove')}}",
            },
            fields: {
                id: {
                    title: 'ID',
                    key: true,
                    list: false
                },
                nombre: {
                    title: 'Nombre',
                },
                cargo: {
                    title: 'Cargo',
                },
                email: {
                    title: 'Correo',
                    type: 'email'
                },
                telefono: {
                    title: 'Telefono',
                    type: 'number'
                }
            },
            recordsLoaded: function()
            {
                @include('tables/datatable')
            }
        });
        $('#table').jtable('load');
    });
    </script>
@stop
