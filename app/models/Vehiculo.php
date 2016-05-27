<?php

class Vehiculo extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'nombre' => 'required|min:3',
		'color'  => 'min:3,max:50',
		'placa'  => 'min:3,max:50',
		'residencia_id' => 'exists:residencias,id'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','nombre','color', 'placa', 'residencia_id'];


	public function residencia(){
		return $this->belongsTo('residencias','residencia_id','id');
	}

}
