<?php 
class Directiva extends Eloquent {

   protected $table ="directiva";
   protected $fillable = array('nombre','cargo','email','telefono');
}