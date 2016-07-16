@extends('layout')
@section('contenido')
<div class="container row">

	<div class="col m6 l6 s12">
		<ul class="collection with-header" >
            <li class="collection-header center"> <h5>Tus Vehiculos</h5></li>
            @forelse ($tusvehiculos as $vehiculo)
                <li class="collection-item">
                    <strong>{{$vehiculo->nombre}}</strong>  <br>
                    {{"Placa: ".$vehiculo->placa}} <br>
                    <small> {{$vehiculo->residencia->nombre}}</small>
                    <span class="secondary-content">
                        @if ($vehiculo->residencia_id == Auth::user()->residencia_id)
                            <a href="{{url("eliminar-vehiculo/".$vehiculo->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
                        @else
                            {{$vehiculo->residencia->nombre}} <br>
                        @endif
                    </span>
                </li>
            @empty
                <li class="collection-item">
                    No Posees Vehiculos Registrados
                </li>
            @endforelse
        </ul>
        <a class="waves-effect blue waves-light btn modal-trigger" href="#modalAuto"> <i class="fa fa-car left"></i> Agregar Vehiculo</a>
	</div>
	<div class="col m6 l6 s12" id="vehiculos">
		<ul class="collection with-header">
			<li class="collection-header center"> <h4>Todos los vehiculos</h4></li>
			<input type="search" v-model="modelo" placeholder=" &#xf002; Buscar..." style="font-family: FontAwesome, Roboto">
			<li v-for="(index,vehiculo) in vehiculos | filterBy  modelo | recordLength 'productCount'"  class="collection-item">
				<span class="secondary-content" v-if="vehiculo.residencia_id == {{Auth::user()->residencia_id}}">
					<a href="{{url("eliminar-vehiculo/".$vehiculo->id)}}"><i class="fa fa-trash fa-2x red-text"></i></a>
				</span>
				<span class="secondary-content" v-else>
					@{{vehiculo.residencia.nombre}}
				</span>
				<b>@{{ vehiculo.nombre}}</b> <br>
				Placa:  @{{ vehiculo.placa }}  <br>
			</li>
			<div v-if="!productCount" id="cf" class="shake center">
				   <img class="bottom" src="{{asset('images/logo-happy.png')}}" />
				   <img class="top" src="{{asset('images/logo-sad.png')}}" />
				   <h4 text-center>No se encontraron vehiculos</h4>
			</div>
		</ul>
	</div>

</div>

<!-- Modal Vehiculo Estructura -->
<div id="modalAuto" class="modal">
    <div class="modal-content">
        <h4>Agregar Vehiculo</h4>
        {{ Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'url' => 'ver-vehiculos']) }}
        <div class="input-field">
            {{Form::label('', "Nombre o Clase del Vehiculo")}}
            {{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
            <small class="red-text">{{ $errors->first('nombre') }}</small>
        </div>
        <div class="input-field">
            {{Form::label('color', 'Color del Vehiculo')}}
            {{Form::text('color',null,['required' => 'required'])}}
            <small class="red-text">{{ $errors->first('color') }}</small>
        </div>
        <div class="input-field">
            {{Form::label('placa', "Placa del Vehiculo")}}
            {{Form::text('placa',null,['required' => 'required','min' => '3', 'length' => '20'])}}
            <small class="red-text">{{ $errors->first('placa') }}</small>
        </div>
    </div>
    <div class="modal-footer">
        <div class="btn-group pull-right">
            {{ Form::submit("Agregar Vehiculo", ['class' => 'btn']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>

<script src="{{asset('js/vue.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script>
	moment.locale("es");
	$.ajaxSetup({
		headers: { 'Auth-Token': "{{ Crypt::encrypt(Auth::user()->id) }}" }
	});

	var Vue = new Vue({
	el: '#vehiculos',
	data: {
		vehiculos : {{ $vehiculos->toJson() }}
	},
	methods: {

	},
	filters: {
		moment: function (date) {
			return moment(date).format('llll');
		},
		calendar: function (date) {
			return moment(date).calendar();
		},
		fromNow: function (date) {
			return moment(date).fromNow();
		},
		format : function(number) {
			number = parseInt(number);
			var re = '\\d(?=(\\d{' + (3 || 3) + '})+' + (0 > 0 ? '\\D' : '$') + ')',
			num = number.toFixed(Math.max(0, ~~0));

			return ("," ? num.replace('.', ",") : num).replace(new RegExp(re, 'g'), '$&' + ("." || ','));
		},
		count: function(value){
		  return value.length;
	  },
	  recordLength: function (result, key){
		  this.$set(key, result.length);
		  return result;
	  }
	}
});
</script>
@stop
