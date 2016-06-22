<?php

class Notificacion extends \Eloquent {

	 protected $table= 'notificaciones';
	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'mensaje' => 'required',
		'user_id' =>'number:required'
	];

	// Don't forget to fill this array
	protected $fillable = ['titulo','mensaje','user_id','leido','url'];

	public function scopeNoleidos($query){
		return $query->where('leido', '=', 0);
	}

	public function scopeLeidos($query){
		return $query->where('leido', '=', 1);
	}

	public function scopeUsuario($query, $user_id){
		return $query->where('user_id', '=', $user_id);
	}

	public static function noLeidas($user_id){
		return Notificacion::usuario($user_id)->noleidos()->orderby("created_at","desc")->get();
	}

	public function persona(){
		return $this->hasOne('User','id','user_id');
	}

	public function InsertarNotificacionesMasivas($titulo,$mensaje,$excluidos = []){
		$notificaciones= [];
		$usuarios = User::whereNotIn('id',$excluidos)->get();
		foreach ($usuarios as $usuario) {
			$notificaciones[] = ['titulo' =>$titulo, 'mensaje' => $mensaje, 'user_id' => $usuario->id, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
		}

		Notificacion::insert($notificaciones);
	}


}
