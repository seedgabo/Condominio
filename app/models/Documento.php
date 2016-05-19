<?php

class Documento extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'titulo' => 'required|min:3:unique:documentos:titulo',
		'contenido' => 'required|min:3',
		'morosos' => 'boolean',
	];

	// Don't forget to fill this array
	protected $fillable = ['titulo','contenido','activo','morosos'];

	public function scopeActivo($query){
		return $query->where("activo","=",1);
	}
}
