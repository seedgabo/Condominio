<?php 
class Recibos extends Eloquent {

   protected $table ="recibos";
   protected $fillable = array('concepto','monto','persona_id','path');

}