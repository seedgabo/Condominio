<ul class="sidebar-nav " id="accordion">
    <li class="sidebar-brand">
        <a href="{{url('admin')}}">
            <i class="fa fa-dashboard"></i> Dashboard
        </a>
    </li>
    <br>
    <li data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
        <strong><a href="#">Administración<i class="fa fa-chevron-circle-right"></i></a></strong>
    </li>
    <div class="{{revisar_expansion('Admin')}}" id="collapseAdmin">

        <li>
            <a href="{{url('admin/areas')}}"> <i class="fa fa-location-arrow"></i> Areas</a>
        </li>
        <li>
            <a href="{{url('admin/directiva')}}"><i class="fa fa-sitemap"></i>  Directiva</a>
        </li>
        <li>
            <a href="{{url('admin/eventos')}}"><i class="fa fa-calendar"></i> Eventos</a>
        </li>
        <li>
            <a href="{{url('admin/Encuestas')}}"> <i class="fa fa-list"></i> Encuestas</a>
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
        <li><a href="{{url('admin/Email')}}"><i class="fa fa-envelope"></i> Email a Usuarios</a></li>
        <li><a href="{{url('admin/Email/Dueños')}}"><i class="fa fa-envelope"></i> Email a Dueños</a></li>
        <li><a href="{{url('admin/Email/Morosos')}}"><i class="fa fa-envelope"></i> Email a Morosos</a></li>
        <li><a href="{{url('admin/Email/AlDia')}}"><i class="fa fa-envelope"></i> Email a Al Dia</a></li>
    </div>

    <li data-toggle="collapse" data-target="#collapseFinanzas" aria-expanded="true" aria-controls="collapseFinanzas">
        <strong><a href="#">Finanzas<i class="fa fa-chevron-circle-right"></i></a></strong>
    </li>

    <div class="{{revisar_expansion('Finanzas')}}" id="collapseFinanzas">
        <li><a href="{{url('admin/Finanzas/cuotas')}}"><i class="fa fa-money"></i> Cuotas Generales</a></li>
        <li><a href="{{url('admin/Finanzas/cuotasPorResidencia')}}"><i class="fa fa-dollar"></i> Cuotas por Residencia</a></li>
        <li><a href="{{url('admin/Finanzas/cuotasMasivas')}}"><i class="fa fa-credit-card"></i> Asignar Cuotas Masivas</a></li>
    </div>

    <li data-toggle="collapse" data-target="#collapseDesign" aria-expanded="true" aria-controls="collapseDesign">
        <strong><a href="#">Diseño<i class="fa fa-chevron-circle-right"></i></a></strong>
    </li>

    <div class="{{revisar_expansion('Dise%C3%B1o')}}" id="collapseDesign">
        <li><a href="{{url('admin/Diseño/Portada')}}"><i class="fa fa-book"></i> Portadas</a></li>
    </div> 
    <script>
        $("[data-toggle='collapse']").click(function(){
            if(!$(this).hasClass("collapsed"))
                $(this).find(".fa").removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-right");
            else                
                $(this).find(".fa").removeClass("fa-chevron-circle-right").addClass("fa-chevron-circle-down");
        });
    </script>
</ul>
