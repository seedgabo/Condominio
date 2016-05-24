<?php
class Noticias extends Eloquent {

   protected $table ="noticias";
   protected $fillable =array('titulo','contenido','persona', 'user_id','fecha','media');
}
