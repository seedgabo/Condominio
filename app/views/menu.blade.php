
<?php 
require_once('vendor/autoload.php');
Pushpad\Pushpad::$auth_token = '3f31ce907b0008fbde64d2f21399b9c7';
Pushpad\Pushpad::$project_id = 1211; 
?>
<div class="navbar-fixed">
    <header id="header" class="">
        <nav>
            <div class="nav-wrapper ">
                <a href="{{ url('/') }}" class="brand-logo center"><img id="brand-logo" src="{{asset('images/logo-completo.png')}}" width="120"></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-bars"></i></a>
                <ul class="right hide-on-med-and-down">
                    @if(Auth::check())
                        <li class="tooltipped dropdown-button" data-activates="dropdown2" data-delay="10" data-constrainwidth="false" data-beloworigin="true" data-alignment="right" data-tooltip="Notificaciones">
                            <a href="#!"><i style="font-size:18px" class="fa fa-bell badge1" data-badge="{{sizeof($notificaciones)}}"> </i>
                            </a>
                        </li>
                            <li>
                                <a class="dropdown-button valign-wrapper" href="#!" data-beloworigin="true" data-hover="true" data-activates="dropdown1" data-alignment="left">
                                    @if (Auth::check() && Auth::user()->avatar != null)
                                        <img class="left avatar circle valign" src="{{Auth::user()->avatar}}" alt="">
                                    @endif
                                    &nbsp;{{str_limit(Auth::user()->nombre,20,"...")}}
                                    <i class="right fa fa-caret-down"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <ul class="center hide-on-med-and-down">
                        @if (!Auth::check())
                            <li><a href="#modallogin" class="modal-trigger" data-target="#modallogin"><i class="left fa fa-user"></i> Iniciar Sesión</a></li>
                            <li><a href="{{url('registro')}}"><i class="left fa fa-sign-in"></i> Registrate</a></li>
                        @else
                            <li class="tooltipped" data-delay="10" data-tooltip="Encuestas"><a href="{{url('ver-encuestas')}}"><i style="font-size:18px" class="fa fa-pie-chart"></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Pagos y Facturas"><a href="{{url('ver-recibos')}}"><i style="font-size:18px" class="fa fa-money"></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Condominio"><a href="{{url('directiva')}}"><i style="font-size:18px" class="fa fa-info"></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Galeria"><a href="{{url('ver-galeria')}}"><i style="font-size:18px" class="fa fa-picture-o "></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Documentos"><a href="{{url('ver-documentos')}}"><i style="font-size:18px" class="fa fa-file "></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Calendario"><a href="{{url('ver-eventos')}}"><i style="font-size:18px" class="fa fa-calendar "></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Personal" ><a href="{{url('ver-personal')}}"><i style="font-size:18px" class="fa fa-users"></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Vehiculos" ><a href="{{url('ver-vehiculos')}}"><i style="font-size:18px" class="fa fa-car"></i></a></li>
                            <li class="tooltipped" data-delay="10" data-tooltip="Visitantes" ><a href="{{url('ver-visitantes')}}"><i style="font-size:18px" class="fa fa-hand-peace-o"></i></a></li>
                        @endif
                    </ul>

                    <ul class="side-nav" id="mobile-demo">
                        @if (!Auth::check())
                            <li><a href="#modallogin" class="modal-trigger" data-target="#modallogin">Iniciar Sesión</a></li>
                            <li><a href="{{url('registro')}}">Registrate</a></li>
                        @else
                            <li>
                                <a href="{{url('ver-notificaciones')}}">Notificaciones 
                                    <i style="font-size:18px" class="fa fa-bell badge1" data-badge="{{sizeof($notificaciones)}}"> </i>
                                </a>
                            </li>
                            <li><a href="{{url('logout')}}"> Cerrar Sesión</a> </li>
                            <li><a href="{{url('ver-residencia')}}">Mi Residencia</a></li>
                            <li><a href="{{url('perfil')}}">Mi Perfil</a></li>
                            <li><a href="{{url('ver-recibos')}}">Pagos</a></li>
                            <li><a href="{{url('ver-encuestas')}}">Encuestas</a></li>
                            <li><a href="{{url('directiva')}}"> @lang('literales.condominio')</a></li>
                            <li><a href="{{url('ver-galeria')}}">Galeria</a></li>
                            <li><a href="{{url('ver-documentos')}}">Documentos</a></li>
                            <li><a href="{{url('ver-personal')}}">Ver Personal</a></li>
                            <li><a href="{{url('ver-vehiculos')}}">Ver Vehiculos</a></li>
                            <li><a href="{{url('ver-visitantes')}}">Ver Visitantes</a></li>

                            @if (Auth::user()->admin)
                                <li><a href="{{url('admin')}}" title="Entrar como Administrador">Admin</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
</div>

    <ul id="dropdown1" class="dropdown-content">
        @if (Auth::check() &&Auth::user()->admin)
            <li class="tooltipped" data-delay="10" data-position="right" data-tooltip="Entrar Como Administrador"><a class="" href="{{url('admin')}}" title="Entrar como Administrador"><i class="left fa fa-unlock-alt"></i>Administrar</a></li>
        @endif
        <li ><a class="" href="{{url('ver-residencia')}}"><i class="left fa fa-home "></i>Mi Residencia</a></li>
        <li><a class="" href="{{url('perfil')}}"><i class="left fa fa-pencil"></i>Mi Perfil</a></li>
        <li class="divider"></li>
        <li><a class="" href="{{url('logout')}}"><i class="left fa fa-sign-out"></i>Cerrar Sessión</a></li>
    </ul>

 @if(Auth::check())
    <ul id="dropdown2" class="dropdown-content">
        @forelse($notificaciones->take(5) as $notificacion)
            <li>
                <span class="blue-text lighten-2" onclick="window.location = '{{url('ver-notificaciones')}}'">{{$notificacion->titulo}}<span>
                <span onclick="window.location = '{{url('ajax/marcar-leido/'. $notificacion->id)}}'"><i class="fa fa-bell-o grey-text"></i></span>
                <span onclick="window.location = '{{url('eliminar-notificacion/'. $notificacion->id)}}'"><i class="fa fa-times red-text"></i></span>
            </li>
        @empty
            <p class="black-text"> No Tienes Notificaciones Nuevas </p>
        @endforelse
        <li class="divider"></li>
        <li><a href="{{url('ver-notificaciones')}}">Ver Todas las Notificaciones</a></li>
        <li><a href="<?= Pushpad\Pushpad::path_for(Auth::user()->id) ?>">Suscribirse</a></li>
    </ul>
@endif




