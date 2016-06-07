
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Variables</h3>
    </div>
    <div class="panel-body">
        <div class="btn-group-vertical" role="group" aria-label="Variables insertables">
            <div class="btn-group" role="group">
                <button class="btn btn-info-outline waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-home"></i> Residencia <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="addVar('{residencia}')">Nombre de Residencia</a></li>
                    <li><a onclick="addVar('{residencia_alicuota}')">Alicuota de Residencia</a></li>
                    <li><a onclick="addVar('{residencia_solvencia}')">Solvencia de Residencia</a></li>
                    <li><a onclick="addVar('{residencia_qtyper}')">Cantidad de Personas en Residencia</a></li>
                    <li><a onclick="addVar('{residencia_telefono}')">Teléfono de Residencia</a></li>
                </ul>
            </div>


            <div class="btn-group" role="group">
                <button class="btn btn-info-outline waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-user"></i> Persona <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="addVar('{persona}')">Nombre de la Persona</a></li>
                    <li><a onclick="addVar('{persona_cedula}')">{{Lang::get("literales.cedula")}} de la Persona</a></li>
                    <li><a onclick="addVar('{persona_email}')">Email de la Persona</a></li>
                    <li><a onclick="addVar('{persona_telefono}')">Telefono de la Persona</a></li>
                    <li><a onclick="addVar('{persona_imagen}')">Avatar de la Persona</a></li>
                </ul>
            </div>

            <div class="btn-group" role="group">
                <button class="btn btn-info-outline waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-building"></i> Conjunto Residencial <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="addVar('{condo}')">Nombre de Conjunto</a></li>
                    <li><a onclick="addVar('{condo_direccion}')">Dirección del Conjunto</a></li>
                    <li><a onclick="addVar('{condo_telefono}')">Teléfono del Conjunto</a></li>
                    <li><a onclick="addVar('{condo_email}')">Email del Conjunto</a></li>
                    <li><a onclick="addVar('{condo_cuenta}')">Cuenta Bancaria del Conjunto</a></li>
                    <li><a onclick="addVar('{condo_doc}')">{{Lang::get('literales.doc_mercantil')}}: del Conjunto</a></li>
                    <li><a onclick="addHtml('<p style=&quot;text-align: center;&quot;><img src=&quot;{{asset("images/condominio/logo.png")}}&quot;/></p>')">Logo del Conjunto (centrado)</a></li>
                    <li><a onclick="addHtml('<p><img style=&quot;float:left&quot; src=&quot;{{asset("images/condominio/logo.png")}}&quot;/></p>')">Logo del Conjunto (Izquierda)</a></li>
                    <li><a onclick="addHtml('<p><img style=&quot;float:right&quot; src=&quot;{{asset("images/condominio/logo.png")}}&quot;/></p>')">Logo del Conjunto (derecha)</a></li>
                </ul>
            </div>

            <div class="btn-group" role="group">
                <button class="btn btn-info-outline waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-male"></i> Propietario <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="addVar('{propietario}')">Nombre del Propietario</a></li>
                    <li><a onclick="addVar('{propietario_cedula}')">{{Lang::get("literales.cedula")}} del Propietario</a></li>
                    <li><a onclick="addVar('{propietario_email}')">Email del Propietario</a></li>
                    <li><a onclick="addVar('{propietario_telefono}')">Telefono del Propietario</a></li>
                    <li><a onclick="addVar('{propietario_imagen}')">Avatar del Propietario</a></li>
                </ul>
            </div>

            <div class="btn-group" role="group">
                <button class="btn btn-info-outline waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-clock-o"></i> Tiempo <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="addVar('{dia}')">Día Dinámico</a></li>
                    <li><a onclick="addVar('{mes}')">Mes Dinámico</a></li>
                    <li><a onclick="addVar('{ano}')">Año Dinámico</a></li>
                    <li><a onclick="addVar('{hora}')">Hora Dinámica</a></li>
                    <li><a onclick="addVar('{minuto}')">Minuto Dinámico</a></li>
                    <li><a onclick="addVar('{segundo}')">Segundo Dinámico</a></li>
                    <li><a onclick="addVar('{nombre_dia}')"> Dia de la Semana Dinámico</a></li>
                    <li><a onclick="addVar('{nombre_mes}')">Nombre del Mes Dinámico</a></li>
                    <li><a onclick="addVar('{fecha}')">Fecha Dinámica</a></li>
                </ul>
            </div>

            <button formaction="{{url("documento-preview")}}" formmethod="POST" formtarget="_blank" class="btn btn-warning" onclick="getHtml()"><i class="fa fa-eye"></i> Vista Previa</button>
        </div>
    </div>
</div>



<script>
function addVar(texto){
    for ( var i in CKEDITOR.instances ){
        CKEDITOR.instances[i].insertText(texto);
        break;
    }
}
function addHtml(texto){
    for ( var i in CKEDITOR.instances ){
        CKEDITOR.instances[i].insertHtml(texto);
        break;
    }
}
function getHtml (){

}
</script>
