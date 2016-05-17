<?php
$message = Session::get('message');
// $residencias = Residencias::leftjoin("personas","personas.id","=","residencias.persona_id_propietario")->select("residencias.*","personas.nombre as dueño")->get();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="nCYyxZBXHh47-5gKHv0E7QcyyOYPihhituEsGQttmgU" />
	<title>@yield('title', Config::get('var.nombre', 'Tu Condominio Online'))</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- Estilos css propios --}}
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
	<!-- Libreria de Iconos -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Latest compiled and minified CSS & JS -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="{{asset('js/materialize.min.js')}}"></script>
	{{-- Link a FAVICON --}}
	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />

	{{-- Librerias adicionales por plantillas hijas --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

	@yield('head', ' ')
	{{-- Estilo para Footer siempre debajo --}}
	<style type="text/css">
	body {
		display: flex;
		min-height: 100vh;
		flex-direction: column;
		background-color: #fafafa;
	}

	main {
		flex: 1 0 auto;
	}
	</style>
</head>
<body>

	{{-- Menu Bar --}}
	<div class="navbar-fixed">
		<nav>
			<header id="header" class="">
				<nav>
					<div class="nav-wrapper ">
						<a href="{{ url('/') }}" class="brand-logo center"><img id="brand-logo" src="{{asset('images/favicon.png')}}" width="55"></a>
						<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
						<ul class="left hide-on-med-and-down">
						@if(Auth::check())
							<li>
								<a class="dropdown-button valign-wrapper" href="#!" data-beloworigin="true" data-hover="true" data-activates="dropdown1" data-constrainwidth="false" data-alignment="right">
									@if (Auth::check() && Auth::user()->avatar != null)
										<img class="left avatar circle valign" src="{{Auth::user()->avatar}}" alt="">
									@endif
									{{explode(' ',trim(Auth::user()->nombre))[0]}}
									<i class="right fa fa-caret-down"></i>
								</a>
							</li>
						@endif
						</ul>
						<ul class="right hide-on-med-and-down">
							@if (!Auth::check())
								<li><a href="#modallogin" class="modal-trigger" data-target="#modallogin"><i class="left fa fa-user"></i> Iniciar Sesión</a></li>
								<li><a href="{{url('registro')}}"><i class="left fa fa-sign-in"></i> Registrate</a></li>
							@else
								<li class="tooltipped" data-delay="10" data-tooltip="Encuestas"><a href="{{url('ver-encuestas')}}"><i class="fa fa-list-alt"></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Pagos y Facturas"><a href="{{url('ver-recibos')}}"><i class="fa fa-credit-card"></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Condominio"><a href="{{url('directiva')}}"><i class="fa fa-info"></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Galeria"><a href="{{url('ver-galeria')}}"><i class="fa fa-picture-o "></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Documentos"><a href="{{url('ver-documentos')}}"><i class="fa fa-paperclip "></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Calendario"><a href="{{url('ver-eventos')}}"><i class="fa fa-calendar "></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip="Personal" ><a href="{{url('ver-personal')}}"><i class="fa fa-users"></i></a></li>
								<li class="tooltipped" data-delay="10" data-tooltip=Vehiculos ><a href="{{url('ver-vehiculos')}}"><i class="fa fa-car"></i></a></li>
							@endif
						</ul>

						<ul class="side-nav" id="mobile-demo">
							@if (!Auth::check())
								<li><a href="#modallogin" class="modal-trigger" data-target="#modallogin">Iniciar Sesión</a></li>
								<li><a href="{{url('registro')}}">Registrate</a></li>
							@else
								<li><a href="{{url('logout')}}">Cerrar Sesión</a> </li>
								<li><a href="{{url('ver-encuestas')}}">Encuestas</a></li>
								<li><a href="{{url('ver-recibos')}}">Pagos</a></li>
								<li><a href="{{url('directiva')}}"> @lang('literales.condominio')</a></li>
								<li><a href="{{url('ver-galeria')}}">Galeria</a></li>
								<li><a href="{{url('ver-documentos')}}">Documetación</a></li>
								<li><a href="{{url('ver-residencia')}}">Mi Residencia</a></li>
								<li><a href="{{url('Usuario-Edit')}}">Mi Perfil</a></li>
								@if (Auth::user()->admin)
									<li><a href="{{url('admin')}}" title="Entrar como Administrador">Admin</a></li>
								@endif
							@endif
							</ul>
						</div>
					</nav>
				</header>
			</nav>
		</div>

		{{-- Contenido Principal --}}
		<main>
			@yield('contenido', '')
		</main>

		<!-- Modal de iniciar session -->
		<div id="modallogin" class="modal">
			<div class="modal-content">
				<a href="#" class=" pull-right waves-effect waves-green btn-flat modal-action modal-close">X</a>
				<h4>Iniciar Sessión</h4>
				<form action="{{url('user')}}" method="post">
					<div class="input-field">
						<i class="material-icons prefix">account_circle</i>
						<input id="correo" type="text" name="email" class="validate">
						<label for="correo">Correo</label>
					</div>
					<div class="input-field col s6">
						<i class="material-icons prefix">lock_outline</i>
						<input id="contraseña" type="password" name="password" class="validate">
						<label for="contraseña">Contraseña</label>
					</div>
					<div class="pull-right">
						<a href="{{url('login/facebook')}}" class="waves-effect waves-light btn btn-small blue darken-2"><i class="fa fa-facebook"></i></a>
						<a href="{{url('login/google')}}" class="waves-effect waves-light btn btn-small red"><i class="fa fa-google-plus"></i></a>
						<button type="submit" class="btn waves-effect waves-light"><i class="right fa fa-sign-in"></i> Iniciar Sesión</button>
					</div>
					<br>
				</form>
			</div>
		</div>


		{{-- Footer --}}
		<footer  style="background-image: url(http://www.img.lirent.net/2014/10/Android-Lollipop-wallpapers-Download.jpg)" class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h6 class="black-text">¿Quieres tu propio servicio de Condominio online?</h6>
						<form action="{{url('contacto')}}" method="GET">
							<input type="email" name="emailContact" class="form-control col s12 m8 l8" id="" placeholder="Deja tu Correo">
							<button type="submit" class="btn col s12 offset-l1 offset-m1 m3 l3">Enviar</button>
						</form>
					</div>
					<div class="col l4 offset-l2 s12">
						<ul>
							<li class="big-hover">
								<a href="mailto:seedgabo@gmail.com" class="black-text"> <i class="fa fa-send-o"></i> Correo</a>
							</li>
							<li class="big-hover">
								<a href="https://ve.linkedin.com/pub/gabriel-bejarano/98/817/711" class="black-text text-lighten-3"> <i class="fa fa-linkedin"></i> Linkendin</a>
							</li>
							<li class="big-hover">
								<a href="tel:+573212441949" class="black-text text-lighten-3"> <i class="fa fa-phone"></i> Llamanos: 321 244 1949</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="footer-copyright">
				<div class="container black-text">
					© 2015 Copyright , Derechos de Autor Reservados a SeeD Ltda. ResidenciasOnline Ltda es una división de Seed Ltda.
				</div>
			</div>
		</footer>

		{{--  boton FAB --}}
		<div id="fab" class="fixed-action-btn" style="bottom: 45px; right: 28px;">
			<a type="button" class="btn-floating btn-large  blue accent-3"><i id="fab-btn" class="material-icons">add</i></a>
			<ul>
				<li>
					<a href="{{url("agregar-noticia")}}" type="button" class="btn-floating red tooltipped" data-position="left" data-delay="10" data-tooltip="Nueva Noticia"><i class="fa fa-newspaper-o"></i></a>
				</li>
				<li><a href="{{url("agregar-recibo")}}" type="button" class="btn-floating blue tooltipped" data-position="left" data-delay="10" data-tooltip="Registrar Pago"><i class="fa fa-money"></i></a></li>
				<li><a href="{{url("agregar-evento")}}" type="button" class="btn-floating green tooltipped" data-position="left" data-delay="10" data-tooltip="Agregar Evento al Calendario"><i class="fa fa-calendar-plus-o"></i></a></li>
				<li><a href="{{url("agregar-imagen")}}" type="button" class="btn-floating yellow tooltipped" data-position="left" data-delay="10" data-tooltip="Subir una imagen"><i class="fa fa-picture-o"></i></a></li>
			</ul>
		</div>

		<ul id="dropdown1" class="dropdown-content">
			@if (Auth::check() &&Auth::user()->admin)
				<li class="tooltipped" data-delay="10" data-position="right" data-tooltip="Entrar Como Administrador"><a href="{{url('admin')}}" title="Entrar como Administrador"><i class="left fa fa-unlock-alt"></i>Administrar</a></li>
			@endif
			<li><a href="{{url('ver-residencia')}}"><i class="left fa fa-home "></i>Mi Residencia</a></li>
			<li><a href="{{url('Usuario-Edit')}}"><i class="left fa fa-pencil"></i>Mi Perfil</a></li>
			<li class="divider"></li>
			<li><a href="{{url('logout')}}"><i class="left fa fa-sign-out"></i>Cerrar Sessión</a></li>
		</ul>

		<script>
		$(document).ready(function () {
			$(".button-collapse").sideNav();
			$('select').material_select();
			$('.modal-trigger').leanModal();
			if ("{{$message or ''}}".length != 0) {
				Materialize.toast("{{$message or ''}}", 15000, "rounded");
			}

			$("#fab").hover(
				function(){$("#fab-btn").css('transform', 'rotate(405deg)')},
				function(){$("#fab-btn").css('transform', 'rotate(0deg)');
			});
		});
		</script>
	</body>

	</html>
