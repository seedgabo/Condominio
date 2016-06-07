<?php
class Personal extends Eloquent {

   protected $table ="personal";
   protected $fillable = array('nombre','cedula','email','cargo','residencia_id','telefono');

   public function residencia()
	{
		return $this->hasOne('Residencias','id','residencia_id');
	}
}
