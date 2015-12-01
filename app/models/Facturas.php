<?php 
class Facturas extends Eloquent {

   protected $table ="facturas";
   protected $fillable =array('mes','año','residencia_id','porcentual','monto','concepto');
}