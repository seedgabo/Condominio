@extends('admin.layout')
@section('header')

    <script type="text/javascript" src="{{asset('vendors/ckeditor/ckeditor.js')}}"></script>

@stop
@section('content')

<div>
    {{ Form::model(isset($documento) ? $documento : null,['method' => 'POST', 'class' => 'form-horizontal', 'name' => 'form1']) }}
        <div class="form-group">

            {{ Form::label('titulo', 'Titulo Del Documento:') }}

            {{ Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required']) }}

            <small class="text-danger">{{ $errors->first('titulo') }}</small>

        </div>



        <div class="col-md-9">
        <div class="form-group">

            {{ Form::label('contenido', 'Contenido del Documento:') }}

            {{ Form::textarea('contenido', null, ['id' => 'ckeditor', 'class' => 'ckeditor', 'required' => 'required']) }}

            <small class="text-danger">{{ $errors->first('contenido') }}</small>
        </div>

        </div>
        <div class="col-md-3">
            @include('comun.variablesDinamicas')
            <div class="form-group">
                <div class="checkbox{{ $errors->has('morosos') ? ' has-error' : '' }}">
                    <label for="morosos">
                        {{ Form::checkbox('morosos', true, null, ['id' => 'morosos']) }} <b> Disponible para {{Lang::choice('literales.moroso', 10)}} </b>
                    </label>
                </div>
                <small class="text-danger">{{ $errors->first('morosos') }}</small>
            </div>
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Subir</button>
        </div>





        {{ Form::close() }}

</div>

@endsection
