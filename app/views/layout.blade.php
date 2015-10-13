<?php 
$message = Session::get('message');
$residencias = Residencias::leftjoin("personas","personas.id","=","residencias.persona_id_propietario")->select("residencias.*","personas.nombre as dueño")->get(); 

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', Config::get('var.condominio', 'Tu Condominio Online'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <!-- Libreria de Iconos -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS & JS -->
    <script src="//code.jquery.com/jquery.js"></script>
    {{-- Fuente --}}
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    {{-- Link a FAVICON --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" /> {{-- Librerias adicionales por plantillas hijas --}} @yield('head', ' ') {{-- Estilo para Footer siempre debajo --}}
    <style type="text/css">
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>

<body>
    {{-- Menu Bar --}}
    <header id="header" class="">
        <nav>
            <div class="nav-wrapper  blue darken-3">
                <a href="{{ url('/') }}" class="brand-logo center"><img src="{{asset('images/favicon.png')}}" width="60"></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <ul class="left hide-on-med-and-down">
                   @if (Auth::check() &&Auth::user()->admin)
                   <li class="tooltipped" data-delay="10" data-position="right" data-tooltip="Entrar Como Administrador"><a href="{{url('admin')}}" title="Entrar como Administrador"><i class="fa fa-bar-chart left"></i>Admin</a></li>
                   @endif
               </ul>
               <ul class="right hide-on-med-and-down">
                @if (!Auth::check())
                <li><a href="#modallogin" class="modal-trigger" data-target="#modallogin">Iniciar Sesión</a></li>
                <li><a href="{{url('registro')}}">Registrate</a></li>
                @else
                <li class="tooltipped" data-delay="10" data-tooltip="Cerrar Sessión"><a href="{{url('logout')}}">{{Auth::user()->nombre}}</a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Encuestas">
                    <a href="{{url('ver-encuestas')}}"> <i class="fa fa-list-alt"></i></a>
                </li>
                <li class="tooltipped" data-delay="10" data-tooltip="Pagos y Facturas"><a href="{{url('ver-recibos')}}"><i class="fa fa-credit-card"></i></a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Condominio"><a href="{{url('directiva')}}"><i class="fa fa-info"></i></a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Galeria"><a href="{{url('ver-galeria')}}"><i class="fa fa-picture-o "></i></a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Documentos"><a href="{{url('ver-documentos')}}"><i class="fa fa-paperclip "></i></a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Tu Residencia"><a href="{{url('ver-residencia')}}"><i class="fa fa-home "></i></a></li>
                <li><a class="tooltipped modal-trigger" data-delay="10" data-tooltip="Revisar Solvencia" href="#solvencia"><i class="fa fa-users"></i></a></li>
                <li class="tooltipped" data-delay="10" data-tooltip="Editar informacion"><a href="{{url('Usuario-Edit')}}"><i class="fa fa-pencil"></i></a></li>
                @endif
            </ul>

            <ul class="side-nav" id="mobile-demo">
                @if (!Auth::check())
                <li><a href="#modallogin" class="modal-trigger" data-target="#modallogin">Iniciar Sesión</a></li>
                <li><a href="{{url('registro')}}">Registrate</a></li>
                @else
                <li><a href="{{url('logout')}}">Cerrar Sesión</a> </li>
                <li><a href="{{url('ver-encuestas')}}"><i class="fa fa-list-alt left"></i>Encuestas</a></li>
                <li><a href="{{url('ver-recibos')}}"><i class="fa fa-credit-card left"></i>Pagos</a></li>
                <li><a href="{{url('directiva')}}"><i class="fa fa-info left"></i>Condominio</a></li>
                <li><a href="{{url('ver-galeria')}}"> <i class="fa fa-picture-o left"></i>Galeria</a></li>
                <li><a href="{{url('ver-documentos')}}"><i class="fa fa-paperclip left"></i>Documetación</a></li>
                <li><a href="{{url('ver-residencia')}}"><i class="fa fa-home left"></i>Residencia</a></li>
                <li><a href="{{url('Usuario-Edit')}}"><i class="fa fa-pencil left"></i> Editar</a></li>
                <li><a class="modal-trigger" href="#solvencia">Revisar Solvencia</a></li>
                @if (Auth::user()->admin)
                <li><a href="{{url('admin')}}" title="Entrar como Administrador">Admin</a></li>
                @endif @endif
            </ul>
        </div>
    </nav>
</header>
<main>
    @yield('contenido', '')
</main>
<!-- Modal de iniciar session -->
<div id="modallogin" class="modal">
    <div class="modal-content">
        <h4>Iniciar Sessión</h4>
        <form action="{{url('user')}}" method="post">
            <div class="input-field">
                <i class="fa fa-user prefix"></i>
                <input id="correo" type="text" name="email" class="validate">
                <label for="correo">Correo</label>
            </div>
            <div class="input-field col s6">
                <i class="fa fa-key prefix"></i>
                <input id="contraseña" type="password" name="password" class="validate">
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn ">Iniciar</button>
            </div>
        </form>
    </div>

    <div class="modal-footer pull-right">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">cerrar</a>
    </div>
</div>

<!-- Modal de Solvencias -->
<div id="solvencia" class="modal modal-fixed-footer">
    <div class="modal-content ">
        <h3 class="center-align">Solvencia</h3>
        <table class="table highlight centered bordered">
            <thead>
                <tr>
                    <th>RESIDENCIA</th>
                    <th>DUEÑO</th>
                    <th>SOLVENCIA </th>
                </tr>
            </thead>
            <tbody>                    @forelse ($residencias as $residencia)
                <tr>
                    <td>{{$residencia->nombre }}</td>
                    <td>{{$residencia->dueño or "<span class='grey-text'>No Registrado</span>"}}</td>
                    @if ($residencia->solvencia)
                    <td class="green-text">{{ trans('literales.solvente') }}</td>
                    @else
                    <td class="red-text">{{ Lang::choice('literales.moroso', 12) }}</td>
                    @endif
                </tr>
                @empty No hay Residencias @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Listo</a>
    </div>
</div>

<footer class="page-footer  blue darken-3"> 
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h6 class="white-text">¿Quieres tu propio servicio de Condominio online?</h6>
                <form action="http://www.tucondominio.com" method="GET">
                    <input type="email" name="emailContact" class="form-control col s12 m8 l8" id="" placeholder="Deja tu Correo">
                    <button type="submit" class="btn col s12 offset-l1 offset-m1 m3 l3">Enviar</button>
                </form>
            </div>
            <div class="col l4 offset-l2 s12">
                <ul>
                    <li>
                        <a href="mailto:seedgabo@gmail.com" class="grey-text text-lighten-3"> <i class="fa fa-send-o"></i> Correo</a>
                    </li>
                    <li>
                        <a href="https://ve.linkedin.com/pub/gabriel-bejarano/98/817/711" class="grey-text text-lighten-3"> <i class="fa fa-linkedin"></i> Linkendin</a>
                    </li>
                    <li>
                        <a href="tel:+573212441949" class="grey-text text-lighten-3"> <i class="fa fa-phone"></i> Llamanos: 321 244 1949</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2015 Copyright Text
        </div>
    </div>
</footer>
<script>
    $(".button-collapse").sideNav();
    $(document).ready(function () {
        $('.modal-trigger').leanModal();
        if ("{{$message or ''}}".length != 0) {
            Materialize.toast("{{$message or ''}}", 15000, "rounded");
        }
    });
</script>
</body>

</html>