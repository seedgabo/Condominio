<?php $sum = 0; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                        <strong>Factura #: </strong> {{$mes . $año. $residencia->id}}
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
                   {{$residencia->nombre}}<br>
                   {{$persona->nombre}}  <br>
                   {{$persona->email}}         
                   </td>
              </tr>
           </thead>
</table>   

    <div style="width: 15%" class="btn btn-xs btn-default">
    Alicuota: {{$residencia->alicuota}} %
    </div>
     <div style="border-top: 1px solid #CABCEA;"></div> 

     <table class="table table-bordered">
         <thead>
             <tr style="background-color: #6962F0;">
                 <th style="text-align: center;">Concepto:</th>
                 <th style="text-align: center;">Cuota Total:</th>
                 <th style="text-align: center;">Monto a pagar:</th>
             </tr>
         </thead>
         <tbody>
          @forelse ($factura as $cuota)
             <tr> 
                <td>{{$cuota->concepto}}</td>
                <td style="text-align: right !important;">{{number_format($cuota->monto,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}}</td>
                @if ($cuota->residencia_id != null)
                    <td style="text-align: right !important;">{{number_format($cuota->monto,2,",",".")}}   <?php $sum += $cuota->monto ?>
                @elseif($cuota->porcentual == 1)
                    <td style="text-align: right !important;">{{number_format($cuota->monto * $residencia->alicuota /100,2,",",".")}}  <?php $sum += $cuota->monto* $residencia->alicuota /100 ?>
                @else 
                    <td style="text-align: right !important;"> {{number_format($cuota->monto /$cant_residencias,2,",",".")}}   <?php $sum += $cuota->monto / $cant_residencias ?>
                @endif
                 {{Config::get('var.moneda_abreviada',"$")}}</td>
             </tr>
          @empty
          @endforelse
          <tfoot>
              <tr>
                  <th></th>
                  <th style="text-align: right !important;">SUBTOTAL:</th>
                  <th style="text-align: right !important;">{{number_format($sum,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}}</th>
              </tr>
          </tfoot>
         </tbody>
     </table>
     <div class="well well-lg">
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt delectus quia provident quam, quis voluptate reiciendis nihil! Saepe, magnam minus ea molestias dignissimos atque vero nihil aut culpa quasi, non cumque quos modi eos nulla quis. Veniam velit temporibus fuga asperiores eveniet tempora est architecto et ea repellat, tempore magni tenetur ut quaerat, sit dolor necessitatibus enim, deserunt placeat odio fugit. Debitis, nobis labore, quibusdam illo dolore non vitae fugit.
     </div>
</body>
</html>
