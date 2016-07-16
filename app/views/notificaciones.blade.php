<?php
require_once('vendor/autoload.php');
Pushpad\Pushpad::$auth_token = '3f31ce907b0008fbde64d2f21399b9c7';
Pushpad\Pushpad::$project_id = 1211;
?>
@extends('layout')
@section('contenido')
    <div class="container row" id="notificaciones">
        <ul class="collection" >
            <li class="collection-item center">
                <a href="ajax/leer-notificaciones"> Marcar Todas Como Leidas</a>
            </li>
            <li class="collection-item" v-for="(index,notificacion) in notificaciones">
                <a class="secondary-content red-text" v-on:click="eliminar(notificacion,index)" href="#!">
                    <i class="fa fa-times fa-lg"></i>
                </a>
                <a  class="secondary-content badge" v-bind:class="{ 'blue lighten-2': notificacion.leido == '1'}" v-on:click="toggle(notificacion)" href="#!">
                    <i class="fa fa-lg" v-bind:class="{ 'fa-bell-o': notificacion.leido, 'fa-bell': !notificacion.leido}"></i>
                    @{{notificacion.leido ?  'Marcar como no leido' : 'Marcar como leido'}}
                </a>
                <p> <b>@{{notificacion.titulo}}</b> | @{{ notificacion.mensaje }}  <br>
                    <i class="right">@{{  notificacion.created_at | fromNow | capitaiize }}</i>
                </p>
            </li>
        </ul>
        <div v-if="!notificaciones.length" class="no-content center fadeinleft">
            <img src="{{asset('images/logo-happy.png')}}" alt="Sin Notificaciones" style="width:30%; -webkit-filter: grayscale(100%); filter: grayscale(100%);" />
            <h3 class="grey-text">No tienes notificaciones</h3>
        </div>
        {{$notificaciones->links()}}
        <a class="btn btn-link btn-large right" href="<?= Pushpad\Pushpad::path_for(Auth::user()->id) ?>">Suscribirse a notificaciones</a>
    </div>

    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script>
    moment.locale("es");
    $.ajaxSetup({
        headers: { 'Auth-Token': "{{ Crypt::encrypt(Auth::user()->id) }}" }
    });


    var Vue = new Vue({
        el: '#notificaciones',
        data: {
            notificaciones : {{ $notificaciones->toJson() }}.data
        },
        methods: {
            toggle: function (notificacion){
                if(notificacion.leido == "0")
                $.get("{{url('api/notificaciones/leido'). '/'}}" +notificacion.id ,function(data){
                    notificacion.leido = data.leido;
                    $('.badge1[data-badge]').attr("data-badge", Vue.notificaciones.filter(checkNoLeidos).length);
                });
                else{
                    $.get("{{url('api/notificaciones/no-leido'). '/'}}" +notificacion.id ,function(data){
                        notificacion.leido = data.leido;
                        $('.badge1[data-badge]').attr("data-badge", Vue.notificaciones.filter(checkNoLeidos).length);
                    });
                }

            },
            eliminar: function(notificacion, index){
                $.ajax({type:'DELETE', url :"{{url('api/notificaciones/'). '/'}}" +notificacion.id })
                .done(function(data){
                    Vue.notificaciones.splice(index,1);
                    $('.badge1[data-badge]').attr("data-badge", Vue.notificaciones.filter(checkNoLeidos).length);
                });
            }
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
            recordLength: function (result, key){
             this.$set(key, result.length);
             return result;
         }
        }
    });

    function checkNoLeidos(not) {
        return not.leido != 1;
    }
    </script>
@endsection
