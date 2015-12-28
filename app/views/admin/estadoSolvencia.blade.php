<!-- Single button -->
<?php $solvencia = Solvencia::firstorCreate(array('mes'=> $mes,'año'=> $año, 'residencia_id'=>$residencia->id )) 
?>
<div class="btn-group">
  <button type="button" class="btn btn-sm @if ($solvencia->estado =='Moroso') btn-danger @elseif ($solvencia->estado =='Al Día')  btn-success @endif dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{$solvencia->estado}}
   <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">

    <li onclick='obtener("{{$residencia->id}}","{{$mes}}","{{$año}}")'><a href="#"><i class="fa fa-eye"></i> Ver</a></li>
    
    @if($solvencia->estado == "Moroso")
      <li  onclick='pagar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
      	<a style="color: green;" href="#"><i class="fa fa-check"></i> Establecer como Pagado</a>
      </li>
      <li onclick='acreditar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
        <a style="color: orange;" href="#"><i class="fa fa-credit-card"></i> Establecer como Acreditado</a>
      </li>
    @endif

    @if($solvencia->estado == "Al Día")
      <li onclick='adeudar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
      	<a style="color: red;" href="#"><i class="fa fa-times"></i> Establecer como Moroso</a>
      </li>
      <li onclick='acreditar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
        <a style="color: orange;" href="#"><i class="fa fa-credit-card"></i> Establecer como Acreditado</a>
      </li>
    @endif

    @if($solvencia->estado == "Crédito")
      <li onclick='pagar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
        <a style="color: green;" href="#"><i class="fa fa-check"></i> Establecer como Pagado</a>
      </li>
      <li onclick='adeudar("{{$residencia->id}}","{{$mes}}","{{$año}}")'>
        <a style="color: red;" href="#"><i class="fa fa-times"></i> Establecer como Moroso</a>
      </li>
    @endif

    <li role="separator" class="divider"></li>
    <li><a href="#"><i class="fa fa-envelope"></i> Enviar Estado por Correo al Dueño</a></li>
  </ul>
</div>