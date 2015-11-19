<?php 
$portadas = DB::table('portadas')->get();
?>
@extends('layout') 
@section('contenido')

{{-- PORTADAS --}}
<div class="slider">
    <ul class="slides">
        <li>
            <img style="opacity: .8" src="{{url('images/portadas/slider0.jpg')}}">
            <div class="caption left-align">
                <h2><i class="fa fa-home fa-2x"></i> {{Config::get('var.condominio')}}</h2>
                <h4> <i class="fa fa-location-arrow"></i> {{Config::get('var.ubicacion')}}</h4>
                <p class="">Bienvenido {{Config::get("var.user", "invitado")}}</p>
            </div>
        </li>
        @forelse ($portadas as $portada)
        <li>
            <img style="opacity: .8" src="{{url('images/portadas/' . $portada->media)}}">
            <div class="caption left-align">
                <h2><i class="fa fa-home fa-2x"></i> {{ $portada->titulo }}</h2>
                <p class="">{{  $portada->contenido }}</p>
            </div>
        </li>
        @empty
        @endforelse
    </ul>
</div>
<div class="row">
    {{-- NOTICIAS --}}
    <div class="col s12 m9 l9">
        <ul class="collection with-header z-depth-5">
            @forelse ($noticias as $noticia)
            <li class="collection-item">
                <div class="center-align">
                    <strong class="uppercase">{{$noticia->titulo}}</strong>
                </div>
                <div class="row">
                    <div class="pull-left">
                        <img src="images/noticias/{{$noticia->media or '../logo.png'}}" data-caption="{{$noticia->titulo}}" class="circle materialboxed " height="100">
                    </div>
                    <div class="justified col s10 m10 l10 offset-s2 offset-m2 offset-l2">
                        <p>{{$noticia->contenido}} <br>
                            <blockquote class="pull-right"> Por: {{ $noticia->persona or 'Condominio'}}</blockquote>
                        </p>
                    </div>
                </div>
            </li>
            @empty
            No hay Noticias
            @endforelse
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
        <a href="{{url('ver-personal')}}" class="collection-item waves-effect"><i class="fa fa-th"></i> Personal </a>
    </ul>

    {{-- Eventos --}}
    <ul class="collection right-aligned  z-depth-3">
        <li class="collection-header center-align">
            <h5> Proximos Eventos </h5>
        </li>
        @forelse($eventos as $evento)
        <li class="collection-item ">
            <strong class="center-align">
                {{ $evento->razon }}    
            </strong> : {{traducir_fecha(Carbon\Carbon::parse($evento->fecha_ini)->formatLocalized('%A %d %B %Y') ." - ")}} {{traducir_fecha(Carbon\Carbon::parse($evento->fecha_fin)->formatLocalized('%A %d %B %Y'))}}
            <p>{{$evento->areas}}</p>
            <blockquote class="right-align">
                {{$evento->persona}}
            </blockquote>
        </li>
        @empty
        <li class="collection-item">No hay Eventos Próximos</li>
        @endforelse
    </ul>
</div>


<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a type="button" class="btn-floating btn-large red"><i class="fa fa-plus-circle"></i></a>
    <ul>
        <li>
            <a href="{{url("agregar-noticia")}}" type="button" class="btn-floating btn-large red tooltipped" data-position="left" data-delay="10" data-tooltip="Nueva Noticia"><i class="fa fa-newspaper-o"></i></a>
        </li>
        <li><a href="{{url("agregar-recibo")}}" type="button" class="btn-floating btn-large blue tooltipped" data-position="left" data-delay="10" data-tooltip="Registrar Pago"><i class="fa fa-money"></i></a></li>
        <li><a href="{{url("agregar-evento")}}" type="button" class="btn-floating btn-large green tooltipped" data-position="left" data-delay="10" data-tooltip="Agregar Evento al Calendario"><i class="fa fa-calendar-plus-o"></i></a></li>
        <li><a type="button" class="btn-floating btn-large yellow tooltipped" data-position="left" data-delay="10" data-tooltip="Subir un Documento"><i class="fa fa-file-text"></i></a></li>
    </ul>
</div>
</div>
</div>
<script>
    $(document).ready(function () {
        $('.slider').slider({
        });
    })
</script>

@stop