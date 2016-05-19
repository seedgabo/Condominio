
@extends('admin.layout')
@section('header')
 @include('admin.headerTables')
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
            columnSelectable : false,
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
                cedula:
                {
                    title:'Cédula',
                    type:'number'
                },
                residencia_id:
                {
                    title: 'Residencia',
                    options: opciones,
                    inputClass: "chosen-select",
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
