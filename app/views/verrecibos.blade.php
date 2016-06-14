<?php  $meses = array('Selecionar','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO', 'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'); $i=0;?>
@extends('layout')
@section('contenido')
    <div class="container  row center-align">
        <h2>Recibos </h2>
        <a href="{{url("agregar-recibo")}}" class=" col m12 l12 s12 btn blue btn-block"><i class="fa fa-cloud-upload"></i> Agrega un Recibo</a>
        @foreach ($recibos as $recibo)
            <div class="card col  m4 s12 l4" style=" overflow: visible;">
                <div class="card-image">
                    <img class="materialboxed" src="{{asset("/images/recibos/".$recibo->path)}}">
                </div>
                <span class="card-title black-text">{{$recibo->concepto}}</span>
                <div class="card-content">
                    <p>{{"Monto: " .  number_format($recibo->monto,3) . Config::get("var.moneda_abreviada")}} </p>
                </div>
                <div class="card-action">
                    <a href="{{url("eliminar-recibo/".$recibo->id)}}">Borrar</a>
                </div>
            </div>
        @endforeach
    </div>
    <br><br>
    <div class="container center-align">
        <h2>Factura</h2>
        <div class="cardcol l12 m12 s12">
            <a href="{{'generar-factura'}}" class="btn btn-block" title="PDf del Factura cargada actualmente">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-file-o fa-stack-2x"></i>
                    <i class="fa fa-download fa-stack-1x"></i>
                </span>
                Ver Factura Actual
            </a>
        </div>
        <div class="card red white-text">
            <i class="fa fa-warning"></i> Algunos navegadores presentar problemas al descargar archivos, si aparece un error intente cambiar de navegador
        </div>
        <br>
        <h5>Facturas de otros periodos</h5>
        {{ Form::open(['method' => 'GET','url'=> 'generar-factura', 'class' => 'row']) }}

        <div class="input-field col l12 m12 s12">
            {{ Form::select('mes', $meses, $time->month, ['class' => '', 'required' => 'required']) }}
            {{ Form::label('mes', 'Mes:') }}
            <small class="text-danger">{{ $errors->first('mes') }}</small>
        </div>

        <div class="input-field col l12 m12 s12 ">
            {{ Form::number('año', $time->year, ['class' => 'form-control', 'required' => 'required','min'=>'1999','max'=>'2099']) }}
            {{ Form::label('año', 'Año:') }}
            <small class="text-danger">{{ $errors->first('año') }}</small>
        </div>

        <div class="">
            {{ Form::submit("Buscar", ['class' => 'btn btn-flat']) }}
        </div>
        {{ Form::close() }}
    </div>
    <br><br>

    <div class="container row center-align">
        <h4>Estado Actual</h4>
        <table class="table highlight striped hoverable bordered responsive-table">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Monto</th>
                    <!-- <th>Cancelado el</th> -->
                    <th>Facturado el</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($solvencias as $estado)
                    <tr>
                        <td>{{getMeses()[$estado->mes] . "/" . $estado->año}}
                               <a href="{{url('generar-recibo/'. $estado->id)}}" title="" class="btn-link" target="_blank">
                                 <img src="{{asset('fonts/invoice.png')}}" alt="">
                            </a>

                        </td>
                        <td>{{$estado->monto != 0 ? Config::get('var.moneda_abreviada') . number_format($estado->monto,"2",",","."): 'No Posee'}}</td>
                        {{-- <td>{{traducir_fecha($estado->cancelado_el->formatLocalized('%A %d de  %B de %Y'))}}</td> --}}
                        <td>{{traducir_fecha($estado->facturado_el->formatLocalized('%A %d de  %B de %Y'))}}</td>
                        <td class="@if($estado->estado == 'Al Día') green-text @endif @if($estado->estado == 'Moroso') red-text @endif">
                            <b>{{$estado->estado}}</b>
                        </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>Deuda Total: {{Config::get('var.moneda_abreviada')}} {{number_format($deuda,2,",",".")}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @stop
