@extends('layout')
@section('contenido')
{{Form::open(['method' => 'POST', 'class' => 'row container'])}}


<div class="input-field">
    {{Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'tucorreo@correo.com']) }}
    {{Form::label('email', 'Correo Electronico') }}
    <small class="red-text">{{ $errors->first('email') }}</small>
</div>

<div class="input-field">
    {{ Form::password('password', ['class' => 'form-control', 'required' => 'required' ,"min-length" => "8", "length" => "32"]) }}
    {{ Form::label('password', 'Contraseña:') }}
    <small class="red-text">{{ $errors->first('password') }}</small>
</div>

<div class="input-field">
    {{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length' => '50']) }}
    {{ Form::label('nombre', 'Nombre Completo:') }}
    <small class="red-text">{{ $errors->first('nombre') }}</small>
</div>


<div class="input-field">
    {{ Form::text('keycode', null, ['class' => 'form-control', 'required' => 'required']) }}
    {{ Form::label('keycode', 'Codigo de Condominio') }}
    <small class="red-text">{{ $errors->first('keycode') }}</small>
</div>

 <label> Datos de Residencia</label>

 <div class="">
     {{ Form::label('residencia_id', 'Residencia:') }}
     {{ Form::select('residencia_id', $residencias, null,['class' => '', 'required' => 'required',]) }}
     <small class="red-text">{{ $errors->first('residencia_id') }}</small>
 </div>

    <div class="">
        {{ Form::reset("Reset", ['class' => 'btn red col s12 m3']) }}
        {{ Form::submit("Registrarse", ['class' => 'btn green col s12 m3']) }}
    </div>
{{ Form::close() }}

 <script>
    $(document).ready(function() {
    $('select').material_select();
  });
 </script>
@stop