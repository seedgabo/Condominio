
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.8/js/dataTables.jqueryui.min.js"></script>

@stop
@section('content')
<div id="table" class=""></div>
<script type="text/javascript" src="{{url('ajax/personas/residencia')}}"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#table').jtable(
        {
            title: 'Personas',
            jqueryuiTheme: true,
            dialogShowEffect:'puff',
            dialogHideEffect:'slide',
            actions:
            {
                listAction: "{{url('ajax/personas/list')}}",
                createAction: "{{url('ajax/personas/create')}}",
                updateAction: "{{url('ajax/personas/edit')}}",
                deleteAction: "{{url('ajax/personas/remove')}}",
            },
            fields:
            {
                id:
                {
                    title: 'ID',
                    key: true,
                    list: false
                },
                nombre:
                {
                    title: 'Nombre',
                },
                email:
                {
                    title: 'Email',
                    type: 'email'
                },
                telefono:
                {
                    title: 'Telefono',
                    type: 'number'
                },
                residencia_id:
                {
                    title: 'Residencia',
                    options: opciones,
                },
                observaciones:
                {
                    title: 'Observaciones',
                    type: 'textarea'
                },
                avatar:
                {
                    title: "Avatar",
                    create: false,
                    edit: false,
                    display: function(data)
                    {
                        if (data.record.avatar)
                        {
                            return " <img width='32' class='avatar' src='" + data.record.avatar + "' alt=''>";
                        }
                        else
                        {
                            return "Sin imagen";
                        }
                    }
                },
                admin:
                {
                    title: "Administrador",
                    type: 'radiobutton',
                    options:
                    {
                        0: 'Usuario',
                        1: 'Admin'
                    },
                    defaultValue: 'false',
                },
                residencia_id:
                {
                    options: opciones,
                    title: "Residencia",
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