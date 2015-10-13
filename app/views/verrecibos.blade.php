<?php  $meses = array('Selecionar','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO', 'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'); $i=0;?>
@extends('layout') @section('contenido')
<div class="container  row center-align">
    <h2>MIS PAGOS </h2>
    <a href="{{url("agregar-recibo")}}" class=" col m12 l12 s12 btn blue black-text btn-block">Agrega un Recibo</a>
    @foreach ($recibos as $recibo)
    <div class="card col  m4 s12 l4" style=" overflow: visible;">
        <div class="card-image">
            <img class="materialboxed" src="{{asset("/images/recibos/".$recibo->path)}}">
        </div>
        <span class="card-title black-text">{{$recibo->concepto}}</span>
        <div class="card-content">
            <p>{{"Monto: " .  number_format($recibo->monto,3) . Config::get("var.moneda_abreviada")}} </p>
        </div>
        <div class="card-action">
            <a href="{{url("eliminar-recibo/".$recibo->id)}}">Borrar</a>
        </div>
    </div>
    @endforeach
</div>
<div class="container center-align">
    <h2>Recibos</h2>
    <div class="cardcol l12 m12 s12">
        <a href="{{'generar-factura'}}" target="_blank" class="btn" title="PDf del recibo cargado actualmente"> Ver Recibo Actual</a>
    </div>
</div>

{{ Form::open(['method' => 'GET','url'=> 'generar-factura', 'class' => 'container row']) }}

    {{ Form::label('mes', 'Mes:') }}
    {{ Form::select('mes', $meses, $time->month, ['class' => 'browser-default', 'required' => 'required']) }}
    <small class="text-danger">{{ $errors->first('mes') }}</small>

<div class="input-field col s12 ">
    {{ Form::label('año', 'Año:') }}
    {{ Form::number('año', $time->year, ['class' => 'form-control', 'required' => 'required','min'=>'1999','max'=>'2099']) }}
    <small class="text-danger">{{ $errors->first('año') }}</small>
</div>

<div class="">
    {{ Form::submit("Buscar", ['class' => 'btn btn-flat']) }}
</div>
{{ Form::close() }}

<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
});
</script>
@stop
