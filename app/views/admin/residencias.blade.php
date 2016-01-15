
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
<script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.8/js/dataTables.jqueryui.min.js"></script>
@stop

@section('content')
<div id="table" class=""></div> 
<script type="text/javascript" src="{{url('ajax/residencias/personas')}}"></script>
<script type="text/javascript">
  $(document).ready(function () 
  {
    $('#table').jtable
    ({
      title: 'Residencias',
      jqueryuiTheme: true,
      actions: {
        listAction: "{{url('ajax/residencias/list')}}",
        createAction: "{{url('ajax/residencias/create')}}",
        updateAction: "{{url('ajax/residencias/edit')}}",
        deleteAction: "{{url('ajax/residencias/remove')}}",
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
        cant_personas:{
         title: 'Cantidad De Personas',
         input: function (data) {
           if (data.record) {
             return '<input type="number" name="cant_personas" style="width:200px" value="' + data.record.cant_personas + '" />';
           } else {
             return '<input type="number" name="cant_personas" style="width:200px" value="" />';
           }
         }
       },
       alicuota:{
         title: 'Alicuota',
         display: function (data) {
           return data.record.alicuota + " %";
         },
         input: function (data) {
           if (data.record) {
             return '<input type="number" name="alicuota" style="width:200px" value="' + data.record.alicuota + '" />';
           } else {
             return '<input type="number" name="alicuota" style="width:200px" value="" />';
           }
         }
       },
       persona_id_propietario:{
         title : "Propietario",
         options : opciones,
       },
       solvencia: {
        title: "Solvencia",
        options: { 1 : 'Solvente', 0 : 'Moroso' },
        defaultValue: 1,
        display: function (data)
        {
          output= '<button class="btn btn-xs btn-block btn-'+ ((data.record.solvencia ==1 )? 'success': 'danger') +' id=solvencia'+data.record.id+'" onClick="cambiarsolvencia('+data.record.id+')">' ;
          output += ( data.record.solvencia ==1 ? 'Solvente':'Moroso') + "</button>";  
          return  output;
        }
      }
    },
    recordsLoaded: function()
    {
       @include('tables/datatable')
    }
});
$('#table').jtable('load');
});

function cambiarsolvencia(row_id)
{
  $.ajax({
   url: "{{url('ajax/cambiarsolvencia')}}",
   type: 'POST',
   data: {id: row_id},
   success: function (data) {
    console.log(data);
    $('#table').jtable('updateRecord', {
      record: data ,
      clientOnly : true,
    });
  }
})
  
}
</script>
@stop