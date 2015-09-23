<?php  $meses = array('Selecionar','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO', 'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'); $i=0;?>

@extends('Admin.layout') @section('content')
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
			{{link_to('admin/facturas',"Actual", $attributes = array(), $secure = null);}}
		</div>

		<div class="pull-right">
			{{ Form::submit("Buscar", ['class' => 'btn btn-success']) }}
		</div>
		{{ Form::close() }}
</div>


<div class="col-md-12 col-sm-12 list-group" id="campos">
		{{ Form::open(['method' => 'POST','url' => url('admin/facturas'), 'class' => 'form form-inline', "id" => "Facturas"]) }}
		<input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
		<input type="hidden" name="año" value="{{$año or $time->year}}" /> 
		@if (isset($array)) @forelse ($array as $element)
		<input type="hidden" name="id[]" value="{{$element->id}}">
		<div class="col-md-12 list-group-item">
			<div class=" form-group">
				<label>Activo: </label>
				<input id="nombre[]" name="nombre[]" value="{{$element->concepto}}" type="text" class="form-control">
			</div>
			<div class=" form-group">
				<label for="monto[]">Monto: </label>
				<input id="monto[]" name="monto[]" value="{{$element->monto}}" type="number" step="any" class="form-control">
			</div>
			<div class="form-group">
				<a href="{{url('admin/eliminarconcepto/'.$element->id)}}" title="Eliminar Activo"><i class="fa fa-trash fa-2x  text-danger"></i> </a>
			</div>
		</div>
		@empty
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
		</div>
		@endforelse 
		@endif
			<a class="btn btn-primary adder col-md-8 col-sm-8"> Agregar Campo <i class="fa fa-plus"></i></a>
			<button type="submit" class="btn btn-success col-sm-offset-1 col-md-offset-1 col-sm-3"> Actualizar <i class="fa fa-send"></i></button>
	</form>
</div>

<div class="col-md-12">
{{ Form::open(['method' => 'POST', 'target'=>'_blank' ,'url' => url('generar-factura'), 'class' => 'form-inline']) }}
	<div class="form-group">
	    {{ Form::label('persona_id', 'Ver Factura como:') }}
	    {{ Form::select('persona_id', $personas, null, ['class' => 'form-control', 'required' => 'required']) }}
	    <small class="text-danger">{{ $errors->first('persona_id') }}</small>
	</div>
	<input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
	<input type="hidden" name="año" value="{{$año or $time->year}}" /> 
    <div class="btn-group pull-right">
        {{ Form::submit("Generar", ['class' => 'btn btn-flat']) }}
    </div>
{{ Form::close() }}
</div>
<script>
	$(document).ready(function() {
		$('a.adder').click(function(e) {
			$(this).before('<div class="col-md-12 list-group-item">' +
				'<input type="hidden" name="id[]" value="-1">' +
				'<div class="form-group">' +
				'<label for="nombre[]"> Activo: </label>' +
				'<input id="nombre[]" name="nombre[]" type="text" class="form-control">' +
				'</div>' +
				'<div class="form-group">' +
				'<label for="monto[]"> Monto: </label>' +
				'<input id="monto[]" name="monto[]" step="any" type="number" class="form-control">' +
				'</div>' +
				'</div>');
		});
	});
</script>
@stop
