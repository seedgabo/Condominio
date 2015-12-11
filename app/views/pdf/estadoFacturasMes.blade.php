<?php $sum = 0; ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{asset('css/bootstrap-email.css')}}">
    <!-- Latest compiled and minified CSS & JS -->
    <style type="text/css" media="screen">
        body
        {
            font-family: 'Helvetica Neue';
            font-size: 14px;
            font-weight: 12px;
        }
    </style>
</head>

<body>
 <table class="table" style="background-color: #EEEEFF">
         <thead>
             <tr>
                 <td><img src="{{asset('images/condominio/logo.png')}}" alt=""></td>
                 <td style="text-align: right; vertical-align: middle;">
                        <strong>Estado de Cuenta: </strong>
                    <br><strong>Creado el: </strong>  {{traducir_fecha($time->formatLocalized('%a %d %b %y'))}}
                    <br><strong>Del: </strong>  {{traducir_fecha(Carbon::parse($año ."/".$mes."/01")->formatLocalized('%a %d %b %y'))}}
                 </td>
             </tr>
         </thead>
 </table> 

<table class="table" style=" text-transform: uppercase;">
     <div style="text-align: center !important;">
        <a href="{{url()}}">{{Config::get('var.nombre')}}</a> 
     </div>
           <thead>
               <tr>
                   <td>{{Config::get('var.ubicacion')}}</td>
                   <td style="text-align: right; vertical-align: middle;">   
                     Estado de Cobro del Mes:    
                   </td>
              </tr>
           </thead>
</table>   

   <table class="table table-bordered">
     <thead>
       <tr>
         <th style="text-align: center;">Residencia</th>
         <th style="text-align: center;">Monto</th>
         <th style="text-align: center;">Deuda Total</th>
       </tr>
     </thead>
     <tbody>
        @forelse ($deudas as $deuda)
       <tr>
         <td>{{$deuda['residencia']->nombre}}</td>
         <td style="text-align: right;">{{number_format($deuda['monto'],2,",",".")}} {{Config::get('var.moneda_abreviada')}}</td>
         <td style="text-align: right;">{{number_format($deuda['monto'],2,",",".")}} {{Config::get('var.moneda_abreviada')}}</td>
       </tr>
        @empty
           <td rowspan="3" headers=""> No hay Deudas Agregadas</td>
        @endforelse
     </tbody>
   </table>
  
  <div class="well">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A omnis blanditiis nam cumque ratione commodi quibusdam architecto, earum nobis, voluptate consequuntur pariatur doloribus. Nemo architecto iusto ducimus labore. Corporis sapiente iste minus dolor laudantium omnis culpa ut quos obcaecati blanditiis dolorem accusantium quia necessitatibus, id vero asperiores autem reiciendis nam. </div>

</body>
</html>
