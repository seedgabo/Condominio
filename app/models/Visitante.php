<?php

class Visitante extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'nombre' => 'required|min:3|max:100',
		'cedula' => 'required|numeric|min:1000',
		'telefono' => 'numeric',
		'email' =>'email',
		'residencia_id' => 'required|number|exists:Residencias,id'

	];

	// Don't forget to fill this array
	protected $fillable = ["nombre","cedula","telefono","email","residencia_id"];

	public function Residencia(){
		return $this->belongsTo("Residencias","residencia_id");
	}

}
