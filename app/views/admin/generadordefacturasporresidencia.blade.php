<?php  
$meses = getMeses();
$i=0;
$query = "?" . http_build_query(Input::only('mes','año','residencia_id'));
$residencias_opt = Residencias::orderby("id")->lists("nombre","id");
?>
@extends('admin.layout') 

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-chosen.css')}}">
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
@stop




@section('content')

    <div id="info" class="jumbotron">
        <div class="container">
        <p><button class="btn btn-info" type="button" onclick="$('#info').toggle('fast')"><i class="fa fa-eye"></i></button>
            Este formulario permite agregar cuotas para las residencias de manera particular 
        </p>
            <ul>
                <li>Las cuotas aqui establecidas seran establecidas solo a residencia a la que se asignó</li>
                <li>El cobro sera por el monto total</li>
            </ul>
        </div>
    </div>


    {{-- Form de Busqueda --}}
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
            {{ Form::label('residencia_id', 'Residencia:') }} 
            {{ Form::select('residencia_id[]', $residencias_opt ,$residencia_id, ['id' => 'residencia_id', 'class' => 'chosen-select form-control', 'multiple']) }} 
            <small class="text-danger">{{ $errors->first('residencia_id') }}</small>
        </div>

        <div class="form-group">
            {{ Form::submit("Buscar", ['class' => 'btn btn-success']) }}
            {{link_to('admin/Finanzas/cuotasPorResidencia',"Limpiar", $attributes = array(), $secure = null);}}
        </div>
        {{ Form::close() }}
    </div>

    {{-- Form para campos --}}
    <div class="col-md-12 col-sm-12 list-group" id="campos">
        {{ Form::open(['method' => 'POST','url' => url('admin/Finanzas/cuotasPorResidencia'), 'class' => 'form form-inline', "id" => "Facturas"]) }}
        {{-- agregando todos los campos del mes --}}
        <input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
        <input type="hidden" name="año" value="{{ $año or $time->year}}" /> 

        @if (isset($array)) 
        @forelse ($array as $element) 
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

            <div class="form-group @if($errors->first('residencia_id')) has-error @endif">
                <label for="residencia_id[]">Residencia: </label>
                    {{ Form::select('residencia_id[]',Residencias::lists("nombre","id"),$element->residencia_id, ['id' => 'residencia_id', 'class' => 'form-control chosen-select', 'required' => 'required']) }} 
            </div>

            <div class="form-group">
                <a href="{{url('admin/Finanzas/eliminarconcepto/'.$element->id).$query}}" title="Eliminar Activo"><i class="fa fa-trash fa-2x  text-danger"></i> </a>
            </div>
        </div>

        @empty {{-- Si no hay campos agregados a al factura muesta uno vacio --}}
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
            <div class="form-group @if($errors->first('residencia_id')) has-error @endif">
                <label for="residencia_id[]">Residencia: </label>
                    {{ Form::select('residencia_id[]',Residencias::orderby("id")->lists("nombre","id"),null, ['id' => 'residencia_id', 'class' => 'form-control chosen-select', 'required' => 'required']) }} 
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
            {{ Form::label('persona_id', 'Ver Factura como:') }} {{ Form::select('persona_id', $personas, null, ['class' => 'chosen-select form-control', 'required' => 'required']) }}
            <small class="text-danger">{{ $errors->first('persona_id') }}</small>
        </div>
        <input type="hidden" name="mes" value="{{ $mes or $time->month}}" />
        <input type="hidden" name="año" value="{{ $año or $time->year}}" />
        <div class="btn-group pull-right">
            {{ Form::submit("Generar", ['class' => 'btn btn-flat']) }}
        </div>
        {{ Form::close() }}
    </div>


    <script>
        $(document).ready(function()
        {
            $('a.adder').click(function(e)
            {
                $(this).before('<div class="col-md-12 list-group-item">' +
                    ' <input type="hidden" name="id[]" value="-1">' +
                    ' <div class="form-group">' +
                    ' <label for="nombre[]"> Activo: </label>' +
                    ' <input id="nombre[]" name="nombre[]" type="text" class="form-control">' +
                    ' </div>' +
                    ' <div class="form-group">' +
                    ' <label for="monto[]"> Monto: </label>' +
                    ' <input id="monto[]" name="monto[]" step="any" type="number" class="form-control">' +
                    ' </div> ' +
                    ' <div class="form-group">' +
                    '<label for="residencia_id[]"> Residencia: </label> ' +
                     ' {{ Form::select("residencia_id[]",Residencias::orderby("id")->lists("nombre","id"), null, ["id" => "residencia_id", "class" => "chosen-select form-control", "required" => "required"]) }}' +
                    ' </div>' +
                    ' </div>');
                $(".chosen-select").chosen({disable_search_threshold: 10});
            });
        });
    </script>
    
    <script >
        $(".chosen-select").chosen({disable_search_threshold: 10});
    </script>
    @stop
