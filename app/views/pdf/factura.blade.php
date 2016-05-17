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
                 <th style="text-align: center;">SUBTOTAL:</th>
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
                 <td style="text-align: right !important;">{{number_format($sum,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}} </td>
             </tr>
          @empty
          @endforelse
          <tr><td colspan="4" style="font-style:italic; text-indent: 4rem;">Gastos Extraordinarios</td></tr>

        @if ($maestra['is_fondo'])
            <tr>
              <td> Fondo de  Reserva: ({{$maestra['fondo_%']}}%)</td>
              <td style="text-align: right !important;">{{number_format(($sum/$residencia->alicuota*100)*$maestra['fondo_%']/100,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}}</td>
              <td style="text-align: right !important;"> {{number_format(($sum)*$maestra['fondo_%']/100,2,",",".")}}
              <?php $sum += $sum*$maestra['fondo_%']/100 ?> {{Config::get('var.moneda_abreviada',"$")}}
              <td style="text-align: right !important;">{{number_format($sum,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}} </td>
            </tr>
          @endif
          <tfoot>
              <tr>
                  <th></th>
                  <th></th>
                  <th style="text-align: right !important;">SUBTOTAL:</th>
                  <th style="text-align: right !important;">{{number_format($sum,2,",",".")}} {{Config::get('var.moneda_abreviada',"$")}}</th>
              </tr>
          </tfoot>
         </tbody>
     </table>
     <div class="well well-lg">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis aliquid ab eveniet quasi, facere atque iste, dicta repellat eos repellendus odio velit, dignissimos quibusdam minus voluptas consectetur voluptatum omnis porro autem quos est amet totam. Corporis, voluptate, nemo. Minima enim rerum, ex earum ab inventore necessitatibus sed aut voluptatibus alias.
     </div>
</body>
</html>
