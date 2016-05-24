@extends('layout')
@section('contenido')
	<div class="container">

		<div class="row">
			<br>
			<a class="btn red btn-block modal-trigger" href="#modalQr"><i class="fa fa-qrcode"></i> Generar Qr para Aplicación</a>


			{{-- Tu Perfil Card --}}
			<div class="card col m6">
				<h2 class="center">Tus Datos</h2>

				{{ Form::model(Auth::user(),['method' => 'Post', 'class' => 'form-horizontal row']) }}
				<div class="col l2 m2 s2">
					<img src="{{Auth::user()->avatar}}" alt="Sin imagen" class="circle big-avatar">
				</div>
				<div class="input-field col l10 s10 m10">
					{{ Form::label('nombre', 'Nombre Completo:') }}
					{{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length'=>'30']) }}
					<small class="red-text">{{ $errors->first('nombre') }}</small>
				</div>
				<div class="input-field col l12 m12 s12 ">
					{{ Form::label('email', 'Dirección de Correo') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'ej: foo@bar.com']) }}
					<small class="red-text">{{ $errors->first('email') }}</small>
				</div>
				<div class="input-field col l12 s12 m12">
					{{ Form::label('cedula', Lang::get('literales.cedula') ) }}
					{{ Form::text('cedula', null, ['class' => 'form-control','length'=>'30']) }}
					<small class="red-text">{{ $errors->first('cedula') }}</small>
				</div>
				<div class="input-field col l12 s12 m12">
					{{ Form::label('telefono', 'Teléfono:') }}
					{{ Form::text('telefono', null, ['class' => 'form-control','length'=>'30']) }}
					<small class="red-text">{{ $errors->first('telefono') }}</small>
				</div>
				<div class="input-field col l12 m12 s12">
					{{ Form::select('residencia_id', $residencias, null, ['class' => '', 'required' => 'required', 'disabled']) }}
					<small class="text-danger">{{ $errors->first('residencia_id') }}</small>
				</div>
				<div class="col m12 l12 s12 center-align">
					{{ Form::submit("Actualizar", ['class' => 'btn blue']) }}
				</div>
				{{ Form::close() }}
			</div>

			{{-- Residencia Card --}}
			<div class="card col m5 offset-m1 ">
				<h2 class="center">Tu Residencia</h2>
				{{ Form::model(Residencias::find(Auth::user()->residencia_id),['method' => 'Post','url' =>'editar-residencia', 'class' => 'form-horizontal row']) }}
				<div class="input-field">
					{{ Form::label('nombre', 'Nombre de Residencia:') }}
					{{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length'=>'30']) }}
					<small class="red-text">{{ $errors->first('nombre') }}</small>
				</div>
				<div class="input-field">
					{{ Form::label('cant_personas', 'Cantidad de Personas') }}
					{{Form::number('cant_personas', null, ['max' => '20' , 'min' => '0'])}}
					<small class="red-text">{{ $errors->first('cant_personas') }}</small>
				</div>

				{{ Form::label('persona_id_propietario', 'Propietario:') }}
				{{ Form::select('persona_id_propietario',User::where("residencia_id","=",Auth::user()->residencia_id)->lists('nombre','id'),Residencias::find(Auth::user()->residencia_id)->persona_id_propietario ,["class" => ""])}}
				<small class="red-text">{{ $errors->first('persona_id_propietario') }}</small>

				<div class="col m12 l12 s12 center-align">
					{{ Form::submit("Actualizar", ['class' => 'btn blue']) }}
				</div>
				{{ Form::close() }}
			</div>

			{{-- Otros Datos Card --}}
			<div class="card col m6 offset-m3 center-align">
				<h2 class="center"> Otros Datos</h2>
				<ul class="collection with-header">
					<li class="collection-header center"> <h5>Tu Personal</h5></li>
					@forelse ($tupersonal as $persona)
						<li class="collection-item">
							<strong>{{$persona->nombre}}</strong>  <br>
							{{"Telefono: ".$persona->telefono}} <br>
							<small> {{$persona->cargo}}</small>
							<span class="secondary-content">
								@if ($persona->residencia_id == Auth::user()->residencia_id)
									<a href="{{url("eliminar-personal/".$persona->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
								@else
									{{$persona->residencia->nombre}} <br>
								@endif
							</span>
						</li>
					@empty
						<li class="collection-item">
							No Posees Personal
						</li>
					@endforelse
				</ul>
				<a class="waves-effect blue waves-light btn modal-trigger" href="#modalPersonal"><i class="fa fa-users left"></i> Agregar Personal</a>



				<ul class="collection with-header">
					<li class="collection-header center"> <h5>Tus Vehiculos</h5></li>
					@forelse ($tusvehiculos as $vehiculo)
						<li class="collection-item">
							<strong>{{$vehiculo->nombre}}</strong>  <br>
							{{"Placa: ".$vehiculo->placa}} <br>
							<small> {{$vehiculo->color}}</small>
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
							No Posees Vehiculos
						</li>
					@endforelse
				</ul>
				<a class="waves-effect blue waves-light btn modal-trigger" href="#modalAuto"> <i class="fa fa-car left"></i> Agregar Vehiculo</a>




				<ul class="collection with-header">
					<li class="collection-header center"> <h5>Tus Visitantes Frecuentes</h5></li>
					@forelse ($tusvisitantes as $visitante)
						<li class="collection-item">
							<strong>{{$visitante->nombre}}</strong>  <br>
							{{ Lang::get('literales.cedula') . ": ". number_format($visitante->cedula,0,",",".") }} <br>
							<small class="left"> Telefono: {{$visitante->telefono}}</small>
							<small class="right"> {{$visitante->residencia->nombre}}</small>
							<span class="secondary-content">
								@if ($visitante->residencia_id == Auth::user()->residencia_id)
									<a href="{{url("eliminar-visitante/".$visitante->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
								@else
									{{$visitante->residencia->nombre}} <br>
								@endif
							</span>
						</li>
					@empty
						<li class="collection-item">
							No Posees Visitantes Frecuentes
						</li>
					@endforelse
				</ul>
				<a class="waves-effect blue waves-light btn modal-trigger" href="#modalVisitante"><i class="fa fa-hand-peace-o left"></i> Agregar Visitante</a>

			</div>


			<!-- Modal Personal Estructura -->
			<div id="modalPersonal" class="modal">
				<div class="modal-content">
					<h4>Agregar Personal</h4>
					{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'url' => 'ver-personal']) }}
					<div class="input-field">
						{{Form::label('', "Nombre Completo de la Persona")}}
						{{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
						<small class="red-text">{{ $errors->first('nombre') }}</small>
					</div>
					<div class="input-field">
						{{Form::label('cedula', Lang::get('literales.cedula'))}}
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


			<!-- Modal Visitante Estructura -->
			<div id="modalVisitante" class="modal">
				<div class="modal-content">
					<h4>Agregar Visitante</h4>
					{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'url' => 'ver-visitantes']) }}
					<div class="input-field">
						{{Form::label('', "Nombre del Visitante")}}
						{{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
						<small class="red-text">{{ $errors->first('nombre') }}</small>
					</div>
					<div class="input-field">
						{{Form::label('cedula', Lang::get('literales.cedula'))}}
						{{Form::number('cedula',null,['required' => 'required', 'min' => '3'])}}
						<small class="red-text">{{ $errors->first('nombre') }}</small>
					</div>
					<div class="input-field">
						{{Form::label('telefono', "Telefono")}}
						{{Form::text('telefono',null,['min' => '3', 'length' => '50'])}}
						<small class="red-text">{{ $errors->first('nombre') }}</small>
					</div>
					<div class="input-field">
						{{Form::label('email', "Email")}}
						{{Form::email('email',null,[ 'min' => '3', 'length' => '50'])}}
						<small class="red-text">{{ $errors->first('nombre') }}</small>
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn-group pull-right">
						{{ Form::submit("Agregar Visitante", ['class' => 'btn']) }}
					</div>
					{{ Form::close() }}
				</div>
			</div>

			<!-- Modal Qr Code -->
			<div id="modalQr" class="modal">
				<div class="modal-content">
					<h4>Escanea este codigo  con tu dispositivo</h4>
					<div class="row center-align">
						<div id="qrcode" class="col m6"></div>
						<script src="{{asset('js/qrcode.min.js')}}">
						</script>
						<script>
						   codigo  = { url : '{{url()}}' , user: '{{Auth::user()->email}}' , token : '{{Crypt::encrypt(Auth::user()->id)}}' }
							var qrcode = new QRCode("qrcode", {
								text: JSON.stringify(codigo)
							});
						</script>

						<div class="col m6">
							<a class="btn green btn-block  btn-large" href="https://play.google.com/store/apps/details?id=com.ionicframework.residenciasonline220562" target="_blank"><i class="fa fa-android"></i> Descargar para Android</a>
							<br>
							<a class="btn grey lighten-1 btn-block btn-large"><i class="fa fa-apple"></i> Descargar para Iphone</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@stop
