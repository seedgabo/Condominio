<?php 
$message = Session::get('message');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adminitracion de {{Config::get('var.condominio')}}</title>
	<link rel="stylesheet" href=" {{ asset('css/simple-sidebar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	{{-- Font Awesome  --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	{{-- Link a FAVICON --}}
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
	@yield('header', '')
</head>

<body>

	<div id="wrapper">  
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand">
					<a href="{{url('admin')}}">
						<i class="fa fa-dashboard"></i> Dashboard
					</a> 
				</li>
				<br>
				<li data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
					<strong><a href="#">Administrar<i class="fa fa-chevron-circle-right"></i></a></strong>
				</li>
				<div class="{{revisar_expansion('Admin')}}"  id="collapseAdmin">
					
					<li>
						<a href="{{url('admin/areas')}}">  <i class="fa fa-location-arrow"></i> Areas</a>
					</li>
					<li>
						<a href="{{url('admin/directiva')}}"><i class="fa fa-sitemap"></i> 	Directiva</a>
					</li>
					<li>
						<a href="{{url('admin/eventos')}}"><i class="fa fa-calendar"></i> Eventos</a>
					</li>
					<li>
						<a href="{{url('admin/Encuestas')}}"> <i class="fa fa-list"></i> Encuestas</a>
					</li>
					<li>
						<a href="{{url('admin/facturas')}}"><i class="fa fa-dollar"></i> Facturas</a>
					</li>
					<li>
						<a href="{{url('admin/Noticias')}}"><i class="fa fa-newspaper-o"></i> Noticias</a>
					</li>
					<li>
						<a href="{{url('admin/Recibos')}}"><i class="fa fa-money"></i> Recibos</a>
					</li>
					<li>
						<a href="{{url('admin/Personas')}}"><i class="fa fa-user"></i> Personas</a>
					</li>
					<li>
						<a href="{{url('admin/Personal')}}"><i class="fa fa-users"></i> Personal</a>
					</li>
					<li>
						<a href="{{url('admin/Residencias')}}"> <i class="fa fa-home"></i> Residencias</a>
					</li>
					<li>
						<a href="{{url('admin/Galeria')}}"> <i class="fa fa-picture-o"></i> Galeria</a>
					</li>
					<li>
						<a href="{{url('admin/Documentos')}}"> <i class="fa fa-file-text"></i> Documentos</a>
					</li>
				</div>

				<li data-toggle="collapse" data-target="#collapseEmail" aria-expanded="true" aria-controls="collapeEmail">
					<strong><a href="#">Email<i class="fa fa-chevron-circle-right"></i></a></strong>
				</li>
				<div class="{{revisar_expansion('Email')}}" id="collapseEmail">
					<li><a href="{{url('admin/Email')}}"><i class="fa fa-envelope-square"></i>Email a Usuarios</a></li>
					<li><a href="{{url('admin/Email/Dueños')}}"><i class="fa fa-envelope-square"></i> Email a Dueños</a></li>
					<li><a href="{{url('admin/Email/Morosos')}}"><i class="fa fa-envelope-square"></i> Email a Morosos</a></li>
					<li><a href="{{url('admin/Email/AlDia')}}"><i class="fa fa-envelope-square"></i> Email a Al Dia</a></li>
				</div>

				<li data-toggle="collapse" data-target="#collapseDesign" aria-expanded="true" aria-controls="collapseDesign">
					<strong><a href="#">Diseño<i class="fa fa-chevron-circle-right"></i></a></strong>
				</li>
				<div class="{{revisar_expansion('Dise%C3%B1o')}}" id="collapseDesign">
					<li><a href="{{url('admin/Diseño/Portada')}}"><i class="fa fa-book"></i> Portadas</a></li>
				</div>
			</ul>
		</div>

		<!-- Page Content -->

		<div id="page-content-wrapper">
			<button class="btn btn-info" id="menu-toggle"><i class="fa fa-bars"></i></button>
			<a href="{{url()}}"><small><i class="fa fa-undo"></i> Volver a Principal </small></a> 
			@yield('content','')
		</div>


		<!-- Menu Toggle Script -->
		<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
		</script>
	</body>

	</html>
