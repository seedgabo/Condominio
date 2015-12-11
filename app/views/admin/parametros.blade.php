@extends('admin/layout')
@section('header')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap2/bootstrap-switch.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/5.3.0/css/bootstrap-slider.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/5.3.0/bootstrap-slider.min.js"></script>
@stop

@section('content')
<div class="col-md-8">
	
	{{Form::open(['method' => 'POST', 'class' => 'form-inline']) }}
		<div class="well"> 	

			 <div class="form-group">
			     <div class="checkbox @if($errors->first('is_fondo')) has-error @endif">
			         <label for="is_fondo">
			         		Activar fondo de Reserva: 
			             <input type="checkbox" name="is_fondo" @if($maestra['is_fondo']) checked @endif value="true" class="switch" id="switch">
			         </label>
			     </div>
			     <small class="text-danger">{{ $errors->first('is_fondo') }}</small>
			 </div>

	     <div id="slider" class="form-group @if($errors->first('fondo_%')) has-error @endif">
	         {{Form::label('fondo_%', 'Cantidad establecida para el fondo de reserva:') }}
						<input id="ex1" name="fondo_%" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value={{$maestra["fondo_%"]}} /> %
	         <small class="text-danger">{{ $errors->first('fondo_%') }}</small>
	     </div>
		</div>

		

			<br>
      {{Form::submit("Guardar", ['class' => 'btn btn-primary']) }}
	{{Form::close() }}
</div>
<script>
   $(".switch").bootstrapSwitch({size:"small", offText:"Desactivado",  onText:"Activado"});
   $('#ex1').slider({
			formatter: function(value) {
				return '%: ' + value;
			}
		});

   	$(document).ready(function()
   	{
   		if($("input#switch").prop("checked") == false)
   			$("#slider").hide('fast');	
   	})


    $("input#switch").on('switchChange.bootstrapSwitch',function()
    {   	
    	if($(this).prop("checked") === false) 
	    	$("#slider").hide('fast');	    	
	    else
	    	$("#slider").show('fast');	    	
    });
</script>
@stop