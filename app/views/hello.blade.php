@extends('Admin.layout')
@section('header')
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>     
    <!-- Include one of jTable styles. -->
    <link href="jtable/themes/jqueryui/jtable_jqueryui.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Inclusion de jquery ui tema -->
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/excite-bike/jquery-ui.css" />

    <!-- Include jTable script file. -->
    <script src="jtable/jquery.jtable.min.js" type="text/javascript"></script>
    
    <!-- Idioma Español para Jtable -->
    <script src="jtable/localization/jquery.jtable.es.js"></script>
@stop
@section('content')
	<div id="table" class=""></div>

	<script type="text/javascript">
    $(document).ready(function () {
        $('#table').jtable({
            title: 'AREAS',
            jqueryuiTheme: true,
            actions: {
                listAction: "{{url('ajax/areas/list')}}",
                createAction: "{{url('ajax/areas/create')}}",
                updateAction: "{{url('ajax/areas/edit')}}",
                deleteAction: "{{url('ajax/areas/remove')}}",
            },
            fields: {
                id: {
                    title: 'ID',
                    key: true,
                    // list: false
                },
                nombre: {
                    title: 'Nombre del Area',
                    width: '40%'
                },
                },
        });
        $('#table').jtable('load');
    });
	</script>
@stop