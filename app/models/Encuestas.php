<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Encuestas extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'encuestas';

	protected $fillable =array('id','nombre','pregunta','respuesta1','respuesta2','respuesta3','respuesta4','respuesta5','respuesta6');


}
