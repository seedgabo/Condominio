<?php

class Solvencia extends \Eloquent {


	protected $table = "solvencia";


	protected $fillable = ['id','residencia_id','mes','año','monto','facturado_el','cancelado_el','estado','descripcion'];


	public function scopeMes($query, $mes){
		return $query->where('mes', "=", $mes);
	}

	public function scopeAno($query, $año){
		return $query->where('año', "=", $año);
	}

	public function scopeResidencia($query, $residencia_id){
		return $query->where('residencia_id', "=", $residencia_id);
	}

	public function getEstadoAttribute($value)
	{
		if ($value == 0)
		return  "No Activo";
		if ($value == 1)
		return  "Al Día";
		if ($value == 2)
		return "Crédito";
		if($value == 3)
		return "Moroso";
	}


	public static function getEstadoResidencia($residencia_id, $fecha_inicial = null){
		if ($fecha_inicial == null)
			$fecha_inicial = Carbon::parse(Carbon::today()->year ."/"."01/01");

		$estados = Solvencia::where('residencia_id',"=",$residencia_id)->where('año',">=",$fecha_inicial->year)->orderBy("id","desc")->get();

		$estados = $estados->filter(function($estado) use ($fecha_inicial){
			return ($estado->año > $fecha_inicial->year or ($estado->año == $fecha_inicial->year &&  $estado->mes >= $fecha_inicial->month));
		});
		return $estados;
	}

	public function getDates(){
		return array('created_at','updated_at','cancelado_el','facturado_el');
	}
}
