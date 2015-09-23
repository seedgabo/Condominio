<h5><i class="fa fa-lg fa-question-circle fa-fw"></i>{{$encuesta->pregunta}}</h5>
<canvas id="myChart" height="300"></canvas>
<div class="left-align">   
  <ol>
    <li class="red-text"> {{$encuesta->respuesta1 or ""}} :   {{$resultados[1]}} </li>
    <li class="green-text"> {{$encuesta->respuesta2 or ""}}:   {{$resultados[2]}} </li>
    <li class="orange-text"> {{$encuesta->respuesta3 or ""}}:   {{$resultados[3]}} </li>
    <li class="blue-text"> {{$encuesta->respuesta4 or ""}}:   {{$resultados[4]}} </li>
    <li class="yellow-text"> {{$encuesta->respuesta5 or ""}}:   {{$resultados[5]}} </li>
    <li class="teal-text"> {{$encuesta->respuesta6 or ""}} :  {{$resultados[6]}} </li>
  </ol>         
</div>
<!-- Modal Trigger -->
<button data-target="modal1" class="btn modal-trigger">Votar</button>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content left-align">
    <h4> {{$encuesta->pregunta}}</h4>
    {{ Form::open(['method' => 'GET','id' => 'respuestaform', 'class' => 'form-horizontal']) }}        
    <p><input name="respuesta" type="radio" id="respuesta1" value="1" checked="checked" />
     <label for="respuesta1">{{$encuesta->respuesta1}}</label> 
   </p>

   <p><input name="respuesta" type="radio" id="respuesta2" value="2"  />
     <label for="respuesta2">{{$encuesta->respuesta2}}</label> 
   </p>

   <p><input name="respuesta" type="radio" id="respuesta3" value="3" />
     <label for="respuesta3">{{$encuesta->respuesta3}}</label>
   </p>

   <p><input name="respuesta" type="radio" id="respuesta4" value="4" />
     <label for="respuesta4">{{$encuesta->respuesta4}}</label> 
   </p>

   <p><input name="respuesta" type="radio" id="respuesta5" value="5" />
     <label for="respuesta5">{{$encuesta->respuesta5}}</label> 
   </p>

   <p><input name="respuesta" type="radio" id="respuesta6" value="6" />
     <label for="respuesta6">{{$encuesta->respuesta6}}</label> 
   </p>
   {{Form::hidden('encuesta_id', $encuesta->id)}}
   {{Form::submit('Enviar Respuesta', ["class"=>"btn green"])}}
   {{ Form::close() }}
 </div>
 <div class="modal-footer">
  <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Cerrar</a>
</div>
</div>
<script>
  var ctx = document.getElementById("myChart").getContext("2d");
  var myPieChart = new Chart(ctx).Pie(data,{percentageInnerCutout : 25, animationSteps : 35,});
  var data = [
  {
    value: {{$resultados[1]}},
    color:"#F7464A",
    highlight: "#FF5A5E",
    label: "{{$encuesta->respuesta1}}"
  },
  {
    value: {{$resultados[2]}},
    color: "#64FE2E",
    highlight: "#A9F5A9",
    label: "{{$encuesta->respuesta2}}"
  },
  {
    value: {{$resultados[3]}},
    color: "#FDB45C",
    highlight: "#FFC870",
    label: "{{$encuesta->respuesta3}}"
  },
  {
    value: {{$resultados[4]}},
    color: "#0000FF",
    highlight: "#2E2EFE",
    label: "{{$encuesta->respuesta4}}"
  },
  {
    value: {{$resultados[5]}},
    color: "#FFBF00",
    highlight: "#F7BE81",
    label: "{{$encuesta->respuesta5}}"
  },
  {
    value: {{$resultados[6]}},
    color: "#04B4AE",
    highlight: "#2EFEF7",
    label: "{{$encuesta->respuesta6}}"
  }
  ];
</script>