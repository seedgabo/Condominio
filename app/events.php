<?php


Event::listen('eliminarArchivo', function($path)
{
	if (File::exists($path))
   		return File::delete($path);
   	else 
   		return false;
});