<?php
class Eventos extends Eloquent {

   protected $table ="eventos";
   protected $fillable = array('razon','fecha_ini','tiempo_ini','fecha_fin','tiempo_fin','user_id','persona','areas');
}
