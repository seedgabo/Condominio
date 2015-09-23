<?php 
class Residencias extends Eloquent {

   protected $table ="residencias";
   protected $fillable = array('nombre','cant_personas','alicuota','persona_id_propietario',"solvencia");

}