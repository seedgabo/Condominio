<?php  
$meses = getMeses();
$i=0;
$query = "?" . http_build_query(Input::only('mes','año'));
?>

@extends('admin.layout') 
@section('content')


<div id="info" class="jumbotron">
    <div class="container">
				<p><button class="btn btn-info" type="button" onclick="$('#info').toggle('fast')"><i class="fa fa-eye"></i></button>
        Este formulario permite agregar cuotas para todas las residencias de manera global </p>
        <ul>
            <li>Escoga <span class="text-danger">Porcentual</span> para establecer el cobro a traves del porcentaje asignado a cada Residencias</li>
            <li>Escoga <span class="text-danger">Residencial</span> para establecer el cobro como una cuota a todos por igual</li>
        </ul>
    <a target="_blank" href="{{url('admin/Finanzas/generarResumendeCobrosMes')}}" class="btn btn-success">Ver Resumen de Cobros Mensual</a>
    </div>
</div>


{{-- Form para buscar Cuotas  --}}
<div class="col-md-12 col-sm-12 well ">
	{{ Form::open(['method' => 'GET', 'class' => 'form form-inline']) }}
	<div class="form-group ">
		{{ Form::label('mes', 'Mes:') }}
		{{ Form::select('mes', $meses, $mes, ['class' => 'form-control', 'required' => 'required']) }}
		<small class="text-danger">{{ $errors->first('mes') }}</small>
	</div>
	<div class="form-group ">
		{{ Form::label('año', 'Año:') }}
		{{ Form::number('año', $año, ['class' => 'form-control', 'required' => 'required','min'=>'1999','max'=>'2099']) }}
		<small class="text-danger">{{ $errors->first('año') }}</small>
	</div>

	<div class="form-group">
		{{ Form::submit("Buscar", ['class' => 'btn btn-success']) }}
		{{link_to('admin/Finanzas/cuotas',"Actual", $attributes = array(), $secure = null);}}
	</div>
	{{ Form::close() }}
</div>


{{-- Form para colocar Cuotas --}}
<div class="col-md-12 col-sm-12 list-group" id="campos">
	{{ Form::open(['method' => 'POST','url' => url('admin/Finanzas/cuotas'), 'class' => 'form form-inline', "id" => "Facturas"]) }}
	<input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
	<input type="hidden" name="año" value="{{ $año or $time->year}}" /> 
	@if (isset($array)) 
	@forelse ($array as $element)

	{{-- agregando todos los campos del mes --}}
	<input type="hidden" name="id[]" value="{{$element->id}}">
	<div class="col-md-12 list-group-item">
		<div class=" form-group">
			<label>Activo: </label>
			<input id="nombre[]" name="nombre[]" value="{{$element->concepto}}" type="text" class="form-control">
		</div>

		<div class="form-group">
			<label for="monto[]">Monto: </label>
			<input id="monto[]" name="monto[]" value="{{$element->monto}}" type="number" step="any" class="form-control">
		</div>

		<div class="form-group">
      <label for="porcentual[]" data-toggle="tooltip" data-placement="right" title="PORCENTUAL: El  monto por el porcentaje de cobro de la residencia (Alicuota) <br> RESIDENCIAL: El monto divido entre el numero de Residencias">Tipo de Cobro: </label>
       {{Form::select('porcentual[]', array("1"=>"Porcentual", "0"=>"Residencial"), $element->porcentual, ["class" => "form-control", "required" => "Required"])}}
		</div>

		<div class="form-group">
			<a href="{{url('admin/Finanzas/eliminarconcepto/'.$element->id).$query}}" title="Eliminar Activo"><i class="fa fa-trash fa-2x  text-danger"></i> </a>
		</div>
	</div>

	@empty
	{{-- Si no hay campos agregados a al factura muesta uno vacio --}}
	<div class="col-md-12 list-group-item">
		<input type="hidden" name="id[]" value="-1">
		<div class="form-group">
			<label for="nombre[]">Activo: </label>
			<input id="nombre[]" name="nombre[]" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="monto[]">Monto: </label>
			<input id="monto[]" name="monto[]" type="number" step="any" class="form-control">
		</div>
		<div class="form-group">
      <label for="porcentual[]">Tipo de Cobro: </label>
       {{Form::select('porcentual[]', array("1"=>"Porcentual", "0"=>"Residencial"), 1, ["class" => "form-control", "required" => "Required"])}}
		</div>
		</div>
	
	@endforelse 
	@endif
	<a class="btn btn-primary adder col-md-8 col-sm-8"> Agregar Campo <i class="fa fa-plus"></i></a>
	<button type="submit" class="btn btn-success col-sm-offset-1 col-md-offset-1 col-sm-3"> Actualizar <i class="fa fa-send"></i></button>
</form>
</div>


{{-- Form para ver Factura por Usuario --}}
<div class="col-md-12">
	{{ Form::open(['method' => 'POST', 'target'=>'_blank' ,'url' => url('generar-factura'), 'class' => 'form-inline']) }}
	<div class="form-group">
		{{ Form::label('persona_id', 'Ver Factura como:') }}
		{{ Form::select('persona_id', $personas, null, ['class' => 'form-control', 'required' => 'required']) }}
		<small class="text-danger">{{ $errors->first('persona_id') }}</small>
	</div>
	<input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
	<input type="hidden" name="año" value="{{ $año or $time->year}}" /> 
	<div class="btn-group ">
      <button type="submit"  class="btn btn-info"><i class='fa fa-file-pdf-o'></i> Generar</button>
	</div>
	{{ Form::close() }}
</div>

<script>
	$(document).ready(function() {
		$('a.adder').click(function(e) {
			$(this).before('<div class="col-md-12 list-group-item">' +
				' <input type="hidden" name="id[]" value="-1">' +
				' <div class="form-group">' +
				' <label for="nombre[]"> Activo: </label>' +
				' <input id="nombre[]" name="nombre[]" type="text" class="form-control">' +
				' </div>' +
				' <div class="form-group">' +
				' <label for="monto[]"> Monto: </label>' +
				' <input id="monto[]" name="monto[]" step="any" type="number" class="form-control">' +
				' </div>' +
				' <div class="form-group">'+
	      ' <label for="porcentual[]"> Tipo de Cobro: </label>'+
	      ' {{Form::select('porcentual[]', array("1"=>"Porcentual", "0"=>"Residencial"), true, ["class" => "form-control", "required" => "Required"])}}'+
				' </div>' +
			  ' </div>');
		});

		$(function () {
			 $('[data-toggle="tooltip"]').tooltip({html:true})
		})
	});
</script>
@stop
