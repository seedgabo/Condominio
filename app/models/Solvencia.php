<?php

class Solvencia extends \Eloquent {
	

	protected $table = "solvencia";


	protected $fillable = ['id','residencia_id','mes','año','monto','facturado_el','cancelado_el','estado','descripcion'];



	 public function getEstadoAttribute($value)
    {
    	if ($value == 0)
        return  "Moroso";
      if ($value == 1)
      	return  "Al Día";
      if ($value == 2)
      	return "Crédito";
    }

}