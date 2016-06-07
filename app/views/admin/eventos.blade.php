
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
<div id="table"></div>

<script type="text/javascript" src="{{url('ajax/calendar/areas')}}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#table').jtable({
			title: 'Eventos',
			jqueryuiTheme: true,
			actions: {
				listAction:   "{{url('ajax/calendar/list')}}",
				createAction: "{{url('ajax/calendar/create')}}",
				updateAction: "{{url('ajax/calendar/edit')}}",
				deleteAction: "{{url('ajax/calendar/remove')}}",
			},
			fields: {
				id: {
					title: 'ID',
					key: true,
					list: false
				},
				razon: {
					title: 'Razon',
				},
				fecha_ini: {
					title: 'Fecha de Ini',
					type: 'date',
				},
				tiempo_ini:
				{
					title: 'Tiempo de Ini',
					input: function(data)
					{
						if (data.record)
							return '<input type ="time" required="" name="tiempo_ini" class="time" value='+ data.record.tiempo_ini +' >';
						else
							return '<input type ="time" required="" name="tiempo_ini" class="time">';
					}
				},
				fecha_fin: {
					title: 'Fecha de Final',
					type: 'date',
				},
				tiempo_fin:
				{
					title: 'Tiempo de Final',
						input: function(data)
					{
							if (data.record)
							return '<input type ="time" required="" name="tiempo_fin" class="time" value='+ data.record.tiempo_fin +' >';
						else
							return '<input type ="time" required="" name="tiempo_fin" class="time">';
					}
				},
				persona:
				{
					title:"Persona",
				},
				areas:{
					title: 'Areas',
					type :'radiobutton',
                    display : function(data)
                    {
                        return  data.record.area;
                    },
                    input: function (data){
                        if (data.record){
                        var salida ="";
                        for(var i=0; i< opciones.length; i++)
                        salida += '<input type="checkbox" name="areas[]" value="'+ opciones[i]["Value"] +'" '+
                         (data.record.area!= undefined && data.record.area.indexOf(opciones[i]["DisplayText"]) >= 0 ? "checked": "" )+
                         '>' + opciones[i]["DisplayText"] +"<br>";
                         return salida;
                     }
                     else{
                         var salida ="";
                         for(var i=0; i< opciones.length; i++)
                         salida += '<input type="checkbox" name="areas[]" value="'+ opciones[i]["Value"] +'">' + opciones[i]["DisplayText"] +"<br>";
                         return salida;
                     }
                    },
					options : opciones
				}
			},
	    recordsLoaded: function()
    {
        var tabla=  $('table.jtable').DataTable
        ({
            responsive: true,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ãšltimo",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
            }
        });
    $(".dataTables_paginate").removeClass("dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_simple_numbers");
     $(".dataTables_length").css("display", "inline").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
     $(".dataTables_filter").css("display", "inline");
    tabla.search("{{Input::get('query','')}}").draw();
}
		});
$('#table').jtable('load');
});
</script>
@stop
