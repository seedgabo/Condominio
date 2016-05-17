
@extends('admin.layout')
@section('header')
    @include('admin.headerTables')
@stop
@section('content')
<div id="table" class=""></div>
<script type="text/javascript" src="{{url('ajax/vehiculos/residencia')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').jtable({
            title: 'Vehiculos',
            columnSelectable : false,
            jqueryuiTheme: true,
            actions: {
                listAction: "{{url('ajax/vehiculos/list')}}",
                createAction: "{{url('ajax/vehiculos/create')}}",
                updateAction: "{{url('ajax/vehiculos/edit')}}",
                deleteAction: "{{url('ajax/vehiculos/remove')}}",
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
                color:{
                    title: 'Color',
                },
                placa:{
                	title: 'Placa',
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
