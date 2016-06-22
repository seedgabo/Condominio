<ul class="sidebar-nav " id="accordion">
    <li class="sidebar-brand">
        <a href="{{url('admin')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <br>
    <li data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
        <strong><a href="#">
            <span>Administración</span><i class="fa fa-chevron-circle-right"></i></a>
        </strong>
    </li>
    <div class="{{revisar_expansion('Admin')}}" id="collapseAdmin">

        <li @if(isset($activo) && $activo == 'areas') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Areas">
            <a href="{{url('admin/areas')}}"> <i class="fa fa-location-arrow"></i> <span>Areas</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'directiva') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Directiva">
            <a href="{{url('admin/directiva')}}"><i class="fa fa-sitemap"></i>  <span>Directiva</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'eventos') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Eventos ">
            <a href="{{url('admin/eventos')}}"><i class="fa fa-calendar"></i> <span>Eventos</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'encuestas') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Encuestas">
            <a href="{{url('admin/Encuestas')}}"> <i class="fa fa-list"></i> <span>Encuestas</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'noticias') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Noticias">
            <a href="{{url('admin/Noticias')}}"><i class="fa fa-newspaper-o"></i> <span>Noticias</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'recibos') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Recibos">
            <a href="{{url('admin/Recibos')}}"><i class="fa fa-money"></i> <span>Recibos</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'personas') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Personas">
            <a href="{{url('admin/Personas')}}"><i class="fa fa-user"></i> <span>Personas</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'personal') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Personal">
            <a href="{{url('admin/Personal')}}"><i class="fa fa-users"></i> <span>Personal</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'vehiculos') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Vehiculos">
            <a href="{{url('admin/Vehiculos')}}"><i class="fa fa-car"></i> <span>Vehiculos</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'visitantes') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Visitantes">
            <a href="{{url('admin/Visitantes')}}"><i class="fa fa-hand-peace-o"></i> <span>Visitantes</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'residencias') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Residencias">
            <a href="{{url('admin/Residencias')}}"><i class="fa fa-home"></i> <span>Residencias</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'galeria') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Galeria">
            <a href="{{url('admin/Galeria')}}"> <i class="fa fa-picture-o"></i> <span>Galeria</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'documentos') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Documentos">
            <a href="{{url('admin/Documentos')}}"><i class="fa fa-file-text"></i> <span>Documentos</span></a>
        </li>
    </div>

    <li data-toggle="collapse" data-target="#collapseEmail" aria-expanded="false" aria-controls="collapeEmail">
        <strong><a href="#"  data-toggle="tooltip" data-placement="top" data-title="Menu Email">
        <span>Email</span><i class="fa fa-chevron-circle-right"></i>
        </a></strong>
    </li>
    <div class="{{revisar_expansion('Email')}}" id="collapseEmail">
        <li @if(isset($activo) && $activo == 'emailPorUsuario') class="activo" @endif data-toggle="tooltip" data-placement="top" data-title="Por Usuarios">
            <a href="{{url('admin/Email')}}"><i class="fa fa-envelope"></i> <span>Email a Usuarios</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'emailPorResidencia') class="activo" @endif  data-toggle="tooltip" data-placement="top" data-title="A Dueños">
            <a href="{{url('admin/Email/Dueños')}}"><i class="fa fa-envelope"></i><span> Email a Dueños</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'emailPorMoroso') class="activo" @endif  data-toggle="tooltip" data-placement="top" data-title="a Morosos">
            <a href="{{url('admin/Email/Morosos')}}"><i class="fa fa-envelope"></i> <span>Email a Morosos</span></a>
        </li>
        <li @if(isset($activo) && $activo == 'emailPorSolvencia') class="activo" @endif  data-toggle="tooltip" data-placement="top" data-title="Al Día">
            <a href="{{url('admin/Email/AlDia')}}"><i class="fa fa-envelope"></i> <span>Email a Al Dia</span></a>
        </li>
    </div>

    <li data-toggle="collapse" data-target="#collapseFinanzas" aria-expanded="false" aria-controls="collapseFinanzas">
        <strong  data-toggle="tooltip" data-placement="top" data-title="Menu Finanzas">
            <a href="#"><span>Finanzas</span><i class="fa fa-chevron-circle-right"></i></a>
        </strong>
    </li>

    <div class="{{revisar_expansion('Finanzas')}}" id="collapseFinanzas">
        <li  data-toggle="tooltip" data-placement="top" data-title="Cuotas Generales">
            <a href="{{url('admin/Finanzas/cuotas')}}"><i class="fa fa-money"></i> <span>Cuotas Generales</span></a>
        </li>
        <li  data-toggle="tooltip" data-placement="top" data-title="Por Residencia">
            <a href="{{url('admin/Finanzas/cuotasPorResidencia')}}"><i class="fa fa-dollar"></i> <span>Cuotas por Residencia</span></a>
        </li>
        <li  data-toggle="tooltip" data-placement="top" data-title="Cuotas Masivas">
            <a href="{{url('admin/Finanzas/cuotasMasivas')}}"><i class="fa fa-credit-card"></i> <span>Asignar Cuotas Masivas</span></a>
        </li>
        <li  data-toggle="tooltip" data-placement="top" data-title="Gestionar Pagos">
            <a href="{{url('admin/Finanzas/gestion')}}"><i class="fa fa-cc-mastercard"></i> <span>Gestionar Pagos</span></a>
        </li>
        <li  data-toggle="tooltip" data-placement="top" data-title="Parametros">
            <a href="{{url('admin/Finanzas/parametros')}}"><i class="fa fa-paragraph"></i> <span>Parametros</span></a>
        </li>
    </div>

    <li data-toggle="collapse" data-target="#collapseDesign" aria-expanded="false" aria-controls="collapseDesign">
        <strong><a href="#"><span>Diseño</span><i class="fa fa-chevron-circle-right"></i></a></strong>
    </li>

    <div class="{{revisar_expansion('Dise%C3%B1o')}}" id="collapseDesign">
        <li><a href="{{url('admin/Diseño/Portada')}}"><i class="fa fa-book"></i> <span>Portadas</span></a></li>
    </div>
     <li class="menu-compact" style="float: left; clear: both; bottom: 35px; position:fixed;">
        <strong><a class="" href="{{url('/')}}"><i class="fa fa-home"></i> <span>Volver</span></a></strong>
    </li>
    <li class="menu-compact" style="float: left; clear: both; bottom: 5px; position:fixed;">
        <strong><a class="menu-toggle" href="#!"><i class="fa fa-bars"></i> <span>Compactar</span></a></strong>
    </li>
    <script>
        $(document).ready(function(){
            if(Cookies.get('compact')=="true")
            {
                $("#wrapper").addClass('compact');
            }
            $(".menu-toggle").click(function(e)
            {
                $("#wrapper").toggleClass("compact");
                $("#wrapper").hasClass("compact")? Cookies.set('compact', 'true'):Cookies.set('compact', 'false');
            });

            $("[data-toggle='collapse']").click(function(e){
                if(!$(this).hasClass("collapsed"))
                    $(this).find(".fa").removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-right");
                else
                    $(this).find(".fa").removeClass("fa-chevron-circle-right").addClass("fa-chevron-circle-down");

               if($($(this).data("target")).hasClass("in"))
               {
                    $($(this).data("target")).hasClass("in").removeClass('in');
               }
               else
               {
                  $(".in").removeClass("in");
               }
            });
            $('li').tooltip({trigger: 'hover'});
        });
    </script>
</ul>
