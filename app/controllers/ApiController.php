<?php

class ApiController extends \BaseController {


	public function index()
	{
		//
	}
	
	public function login()
	{
		$data['user'] =  Auth::user();
		$data['residencia'] =  $data['user']->residencia;
		$data['notificaciones'] = Notificacion::getByUser(50);
		$data['sinLeer'] = Notificacion::noLeidas(Auth::user()->id)->count();
		$data['status'] = true;    
		$data['deuda'] =  getDeudaTotal(Auth::user()->residencia_id);
    	return  Response::json($data, 200);
	} 

	public function adicionales(){
		$data = [];
		$data['deuda'] =  getDeudaTotal(Auth::user()->residencia_id);
		return Response::json($data, 200);
	}

}