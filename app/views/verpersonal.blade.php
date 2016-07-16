
@extends('layout')
@section('contenido')
<div class="container row">

	<div class="col m6 l6 s12">
		<ul class="collection with-header">
			<li class="collection-header center"> <h4>Tu Personal</h4></li>
			@forelse ($tupersonal as $persona)
			<li class="collection-item">
				<strong>{{$persona->nombre}}</strong>  <br>
				{{"Telefono: ".$persona->telefono}} <br>
				<small> {{$persona->cargo}}</small>
				<span class="secondary-content">
					@if ($persona->residencia_id == Auth::user()->residencia_id)
					<a href="{{url("eliminar-personal/".$persona->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
					@else
					{{Residencias::find($persona->residencia_id)->nombre }} <br>
					@endif
				</span>
			</li>
			@empty
			<li class="collection-item">
				No Posees Personal
			</li>
			@endforelse
		</ul>
		<a class="waves-effect blue waves-light btn modal-trigger" href="#modal1">Agregar Personal</a>
	</div>
	<div class="col m6 l6 s12" id="personal">
		<ul class="collection with-header">
			<li class="collection-header center"> <h4>Todo El Personal</h4></li>
			<input type="search" v-model="modelo" placeholder=" &#xf002; Buscar..." style="font-family: FontAwesome, Roboto">
			<li v-for="(index,persona) in personal | filterBy  modelo | recordLength 'productCount'"  class="collection-item">
				<span class="secondary-content" v-if="persona.residencia_id == {{Auth::user()->residencia_id}}">
					<a href="{{url("eliminar-personal/".$persona->id)}}"><i class="fa fa-trash fa-2x red-text"></i></a>
				</span>
				<span class="secondary-content" v-else>
					@{{persona.residencia.nombre}}
				</span>
				<b>@{{ persona.nombre}}</b> <br>
				Placa:  @{{ persona.telefono }}  <br>
				<small> @{{ persona.cargo}}</small>
			</li>
			<div v-if="!productCount" id="cf" class="shake center">
				   <img class="bottom" src="{{asset('images/logo-happy.png')}}" />
				   <img class="top" src="{{asset('images/logo-sad.png')}}" />
				   <h4 text-center>No se encontró personal</h4>
			</div>
		</ul>
	</div>

</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Agregar Personal</h4>
		{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal']) }}
		<div class="input-field">
			{{Form::label('nombre', "Nombre Completo de la Persona")}}
			{{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
			<small class="red-text">{{ $errors->first('nombre') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('cedula', "Cedula de la Persona")}}
			{{Form::number('cedula',null,['required' => 'required'])}}
			<small class="red-text">{{ $errors->first('cedula') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('telefono', "Telefono de la Persona")}}
			{{Form::text('telefono',null,['required' => 'required','min' => '7'])}}
			<small class="red-text">{{ $errors->first('telefono') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('cargo', "Cargo o Trabajo de la Persona")}}
			{{Form::text('cargo',null,['required' => 'required', 'min' => '6', 'length' => '30'])}}
			<small class="red-text">{{ $errors->first('cargo') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('email', "Email de la Persona si posee")}}
			{{Form::email('email',null,[])}}
			<small class="red-text">{{ $errors->first('email') }}</small>
		</div>
	</div>
	<div class="modal-footer">
		<div class="btn-group pull-right">
			{{ Form::submit("Agregar Personal", ['class' => 'btn']) }}
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
	el: '#personal',
	data: {
		personal : {{ $personal->toJson() }}
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
