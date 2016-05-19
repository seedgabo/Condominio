<?php
$portadas = DB::table('portadas')->get();
?>
    @extends('layout')
    @section('contenido')
    {{-- PORTADAS --}}
    @if(sizeof($portadas)>0)
    <div class="slider">
        <ul class="slides">
            @forelse ($portadas as $portada)
            <li>
                <img style="opacity: .8" src="{{url('images/portadas/' . $portada->media)}}">
                <div class="caption left-align">
                    <h2><i class="fa fa-home fa-2x"></i> {{ $portada->titulo }}</h2>
                    <p class="">{{ $portada->contenido }}</p>
                </div>
            </li>
            @empty
            @endforelse
        </ul>
    </div>
    @endif
    <div class="row">
        {{-- NOTICIAS --}}
        <div class="col s12 m9 l9">
            <ul class="collection with-header z-depth-5">
                @forelse ($noticias as $noticia)
                <li class="collection-item">
                    <div class="center-align">
                        <strong class="uppercase">{{$noticia->titulo}}</strong>
                        @if ( Auth::check()  && strpos($noticia->persona, Auth::user()->nombre) === 0)
                            <a class="red-text right" href="{{url('eliminar-noticia'.'/'.$noticia->id)}}"><i class="fa fa-trash"></i> </a>
                        @endif
                    </div>
                    <div class="row">
                        <div class="left col s2 m2 l2">
                            <img src="images/noticias/{{$noticia->media or '../logo.png'}}" data-caption="{{$noticia->titulo}}" class="circle materialboxed " height="100">
                        </div>
                        <div class="col s10 m10 l10">
                            <p>
                                {{$noticia->contenido}}
                                <blockquote class="right"> Por: {{ $noticia->persona or 'Condominio'}}</blockquote>
                            </p>
                        </div>
                    </div>
                </li>
                @empty
                    No hay Noticias
                @endforelse
                <li class="collection-item"><a class="btn btn-block btn-small" href="{{url('agregar-noticia')}}"><i class="fa fa-plus-circle"></i> Agregar Noticia</a></li>
            </ul>
        </div>

        {{-- Links y Eventos --}}
        <div class="col s12  m3 l3 ">
            <ul class="collection right-aligned z-depth-3">
                <a href="{{url('directiva')}}" class="collection-item waves-effect"><i class="fa fa-info fa-fw fa-lg"></i> Datos Del Condominio</a>
                <a href="{{url('ver-galeria')}}" class="collection-item waves-effect"><i class="fa fa-picture-o fa-fw fa-lg"></i> Galeria</a>
                <a href="{{url('ver-documentos')}}" class="collection-item waves-effect"><i class="fa fa-files-o fa-fw fa-lg"></i> Ver Documetación</a>
                <a href="{{url('ver-residencia')}}" class="collection-item waves-effect"><i class="fa fa-home fa-fw fa-lg"></i> Datos de tu Residencia</a>
                <a href="{{url('ver-encuestas')}}" class="collection-item waves-effect"><i class="fa fa-thumbs-up fa-fw fa-lg"></i> Encuestas</a>
                <a href="{{url('ver-recibos')}}" class="collection-item waves-effect"><i class="fa fa-credit-card fa-fw fa-lg"></i> Pagos y Facturas </a>
                <a href="{{url('ver-eventos')}}" class="collection-item waves-effect"><i class="fa fa-calendar fa-fw fa-lg"></i> Calendario</a>
                <a href="{{url('ver-noticias')}}" class="collection-item waves-effect"><i class="fa fa-newspaper-o"></i> Noticias </a>
                <a href="{{url('ver-personal')}}" class="collection-item waves-effect"><i class="fa fa-th"></i> Listado de Personal </a>
                <a href="{{url('ver-vehiculos')}}" class="collection-item waves-effect"><i class="fa fa-car"></i> Listado de Vehiculos  </a>
            </ul>

            {{-- Eventos --}}
            <a style="color: inherit !important;" href="{{url('ver-eventos')}}">
                <ul class="collection right-aligned  z-depth-3">
                    <li class="collection-header center-align">
                        <h5> Proximos Eventos </h5>
                    </li>
                    @forelse($eventos as $evento)
                    <li class="collection-item ">
                        <strong class="center-align">
                        {{ $evento->razon }}
                    </strong>
                        <br> {{traducir_fecha(Carbon::parse($evento->fecha_ini)->formatLocalized('%a %d/%b/%y') ." - ")}} {{traducir_fecha(Carbon::parse($evento->fecha_fin)->formatLocalized('%a %d/%b/%y'))}}
                        <p class="green-text">{{traducir_fecha(Carbon::now()->diffForHumans(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini))) }}</p>
                        <blockquote class="right-align">
                            {{$evento->persona}}
                        </blockquote>
                    </li>
                    @empty
                    <li class="collection-item">No hay Eventos Próximos</li>
                    @endforelse
                    <li class="collection-item"><a class="btn btn-block btn-small" href="{{url('agregar-evento')}}"><i class="fa fa-plus-circle"></i> Agregar Evento</a></li>
                </ul>
            </a>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $('.slider').slider(
            {});
        })
    </script>

    @stop
