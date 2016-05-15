<?php
class Residencias extends Eloquent {

	protected $table ="residencias";
	protected $fillable = array('nombre','cant_personas','alicuota','persona_id_propietario',"solvencia");

	public function personas()
	{
		return $this->hasMany('User','residencia_id');
	}
	public function personal()
	{
		return $this->hasMany('personal','residencia_id');
	}

	public function vehiculos(){
		return $this->hasMany('Vehiculo','residencia_id');
	}
}
