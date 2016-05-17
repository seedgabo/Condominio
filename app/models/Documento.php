<?php

class Documento extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'titulo' => 'required|min:3:unique:documentos:titulo',
		'contenido' => 'required|min:3',
	];

	// Don't forget to fill this array
	protected $fillable = ['titulo','contenido','activo'];

}
