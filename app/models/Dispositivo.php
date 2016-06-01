<?php

class Dispositivo extends \Eloquent {

	public static $rules = [
		'token' => 'min:3',
		'dispositivo'  => 'min:3,max:50',
		'plataforma'  => 'min:3,max:50',
		'user_id' => 'exists:personas,id',
		'active' => 'boolean',
		'noticias_enabled' => 'boolean',
		'eventos_enabled' => 'boolean',
		'mensajes_enabled' => 'boolean',
	];
	protected $cast =[
		'mensajes_enabled' => 'boolean',
		'noticias_enabled' => 'boolean',
		'eventos_enabled' => 'boolean',
		'active' => 'boolean',
	];

	protected $fillable = ['token','dispositivo','plataforma','user_id','active','noticias_enabled','eventos_enabled','mensajes_enabled'];

	public function User()
	{
		return $this->hasOne('users','id','user_id');
	}

	public function scopeNoticias($query){
		return $query->where('noticias_enabled', '=', '1');
	}
	public function scopeEventos($query){
		return $query->where('eventos_enabled', '=', '1');
	}
	public function scopeMensajes($query){
		return $query->where('mensajes_enabled', '=', '1');
	}
	public function scopeActive($query){
		return $query->where('active', '=', '1');
	}

	public function getActiveAttribute($value){
		return ($value == 1)? true  : false;
	}
	public function getMensajesEnabledAttribute($value){
		return ($value == 1)? true  : false;
	}
	public function getEventosEnabledAttribute($value){
		return ($value == 1)? true  : false;
	}
	public function getNoticiasEnabledAttribute($value){
		return ($value == 1)? true  : false;
	}

}
