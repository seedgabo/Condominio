@extends('layout')
 @section('contenido')
<div class="container">
    {{ Form::open(['method' => 'POST','files'=>true]) }}
    <h2>Agregar Recibo</h2>
    <div class="input-field col s12">
        <input id="concepto" type="text" name="concepto" length="30" required="" class="validate">
        <label for="concepto">Concepto</label>
        <small class="red-text">{{ $errors->first('concepto') }}</small>
    </div>
    <div class="input-field col s12">
        <input type="number" id="" name="monto"  step="0.001" required="" placeholder="COP." class="validate"></input> 
        <label for="monto">Monto</label> 
        <small class="red-text">{{ $errors->first('monto') }}</small>
    </div>
    <input type="file" name="archivo" accept="image/*" />
    <small class="red-text">{{ $errors->first('archivo') }}</small>
    <br>
    <br>
    <button type="submit" class="btn waves-effect waves-light"> Enviar <i class="mdi-content-send right"></i></button>
    {{ Form::close() }}
</div>
@stop