@extends('layout')
@section('contenido')
<div class="container row">
    {{ Form::open(['method' => 'POST','files'=>true]) }}
    <h2>Agregar Recibo</h2>
    <div class="input-field col s12">
        <input id="concepto" type="text" name="concepto" length="30" required="" class="validate">
        <label for="concepto">Concepto</label>
        <small class="red-text">{{ $errors->first('concepto') }}</small>
    </div>
    <div class="input-field col s12">
        <input type="number" id="" name="monto"  step="0.001" required="" placeholder="COP $" class="validate"></input> 
        <label for="monto">Monto</label> 
        <small class="red-text">{{ $errors->first('monto') }}</small>
    </div>

    <input class type="file" name="archivo" accept="image/*" />
    <small class="red-text">{{ $errors->first('archivo') }}</small>
    <br>
    <br>



    <div class="card yellow darken-3 white-text">
        <i class="fa fa-lg fa-warning"></i> Si es un recibo de pago de residencia active esta opción
    </div>

    <div class="switch">
        <label>
            General
            <input name="isFactura" checked onchange="toggleFecha(this)"  type="checkbox">
            <span class="lever"></span>
            Factura
        </label>
    </div>

    <div id="fecha" class="row">
        {{Form::select('mes', getmeses(), $time->month, ['class' => 'col m6', 'id'=>'mes'])}}
        <small class="red-text">{{ $errors->first('mes') }}</small>
        {{Form::number('año',$time->year,['step' => 1, 'min'=> 2000, 'max' => '2099', 'class'=> 'col m6'])}}
        <small class="red-text">{{ $errors->first('año') }}</small>
    </div>

    <br>

    <button type="submit" class="btn waves-effect waves-light"> Enviar <i class="mdi-content-send right"></i></button>
    {{ Form::close() }}

    <script>
     $(document).ready(function() {
        $('select').material_select();
    });

     function toggleFecha( element )
     {
       if (element.checked)
       {
        $('#fecha').show(300);
    }
    else
    {
        $('#fecha').hide(300);
        
    }
}
</script>
</div>
@stop