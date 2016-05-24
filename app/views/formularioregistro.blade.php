@extends('layout')
@section('contenido')
<br>
<div class="row container">

    <div class="center-align">

        <a href="{{url('register/facebook')}}" class="waves-effect waves-light btn blue darken-2"><i class="left fa fa-facebook"></i> Registrate con tu cuenta de facebook</a>
        <a href="{{url('register/google')}}" class="waves-effect waves-light btn red"><i class="left fa fa-google"></i> Registrate con tu cuenta de  Google</a>

    </div>
    <br>

    {{Form::open(['method' => 'POST', 'class' => ''])}}


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
        {{ Form::text('cedula', null, ['class' => 'form-control','length'=>'30']) }}
        {{ Form::label('cedula', Lang::get('literales.cedula') ) }}
        <small class="red-text">{{ $errors->first('cedula') }}</small>
    </div>
    <div class="input-field">
        {{ Form::text('telefono', null, ['class' => 'form-control','length' => '50']) }}
        {{ Form::label('telefono', 'Telefono:') }}
        <small class="red-text">{{ $errors->first('telefono') }}</small>
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

 <div class="row">
    {{ Form::submit("Registrarse", ['class' => 'btn col l12 m12 s12']) }}
</div>
{{ Form::close() }}

</div>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
@stop
