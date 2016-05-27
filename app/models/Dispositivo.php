<?php

class Dispositivo extends \Eloquent {
	public static $rules = [
		'token' => 'required|min:3',
		'dispositivo'  => 'min:3,max:50',
		'plataforma'  => 'min:3,max:50',
		'user_id' => 'exists:personas,id',
		'noticias_enabled' => 'boolean',
		'eventos_enabled' => 'boolean',
		'mensajes_enabled' => 'boolean',
	];

	protected $fillable = ['token','dispositivo','plataforma','user_id','noticias_enabled','eventos_enabled','mensajes_enabled'];

	public function User()
	{
		return $this->hasOne('users','id','user_id');
	}

}