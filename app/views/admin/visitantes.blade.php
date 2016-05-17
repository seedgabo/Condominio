
@extends('admin.layout')
@section('header')
    @include('admin.headerTables')
@stop
@section('content')
<div id="table" class=""></div>
<script type="text/javascript" src="{{url('ajax/visitantes/residencia')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').jtable({
            title: 'Visitantes',
            columnSelectable : false,
            jqueryuiTheme: true,
            actions: {
                listAction: "{{url('ajax/visitantes/list')}}",
                createAction: "{{url('ajax/visitantes/create')}}",
                updateAction: "{{url('ajax/visitantes/edit')}}",
                deleteAction: "{{url('ajax/visitantes/remove')}}",
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
                cedula:{
                    title: 'Cedula',
                },
                telefono:{
                	title: 'Telefono',
                },
                email:{
                	title: 'Email',
                },
                residencia_id:{
                	title: 'Residencia',
                   options: opciones,
              },
       },
         recordsLoaded: function()
        {
            @include('tables.datatable')
        }
});
$('#table').jtable('load');

});
</script>
@stop
