
<div class="panel panel-warning col-md-4 col-md-offset-4 pull-right">
     <div class="panel-heading">
         Crear cobros
     </div>
     <div class="panel-body">
        <h4> Generar cobros y facturas para este periodo:    </h4>
         <a href="{{url('admin/Finanzas/cargar-cobros?mes='. $mes . "&año=".$año)}}" class="btn btn-warning text-center btn-block" onclick="return confirm('¿está seguro que quiere crear los cobros basados en los datos actuales')">
            <i class="fa fa-exchange"></i> CONFIRMAR Y GENERAR
         </a>

     </div>
</div>
