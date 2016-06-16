<?php

class EventosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /eventos
	 *
	 * @return Response
	 */
	public function index()
	{
	  $eventos = Eventos::where('fecha_ini','>=',Carbon::today())->orderby("fecha_ini","asc")->orderby("tiempo_ini","asc")->get();
	  $eventos->each(function($evento){
	  	$evento  = array_add($evento,'duracion',traducir_fecha(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini)->diffForHumans(Carbon::parse($evento->fecha_fin . $evento->tiempo_fin)),true));
	  	$evento['inicio'] = traducir_fecha(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini)->toDayDateTimeString());
	  	$evento['fin'] = traducir_fecha(Carbon::parse($evento->fecha_fin . $evento->tiempo_fin)->toDayDateTimeString());
		foreach ($evento->areas() as $area) {
			$evento->area .= $area->nombre . "," ;
		}
	});
	  return Response::json($eventos,200);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /eventos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /eventos
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules =  array(
			'razon' =>'required|min:6|max:30',
			'fecha_ini' =>'required',
			'fecha_fin' =>'required'
		);
		$validation = Validator::make(Input::except('_token'),$rules);
		if ($validation->fails())
		{
			return "ERROR";
		}
		$data= Input::except("areas");
		$data['tiempo_ini'] = date("G:i", strtotime(Input::get('tiempo_ini')));
		$data['tiempo_fin'] = date("G:i", strtotime(Input::get('tiempo_fin')));
		$data= array_add($data,'persona', Auth::user()->nombre);
		$data= array_add($data,'user_id', Auth::user()->id);
		$areas = explode(",",Input::get('areas',""));
		$data= array_add($data,'areas', $areas);
		$evento = Eventos::create($data);
		return  $evento;
	}

	/**
	 * Display the specified resource.
	 * GET /eventos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$evento = Eventos::find($id);
		foreach ($evento->areas() as $area) {
			$evento->area .= $area->nombre . "," ;
		}
		return	 json_encode($evento);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /eventos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /eventos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /eventos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$evento = Eventos::find($id);
		if($evento->user_id == Auth::user()->id || Auth::user()->admin)
		{
			$evento->delete();
			return Response::json(['status' => 'TRUE'], 200);
		}
		else{
			return Response::json(['status' => 'ERROR'], 403);
		}
	}

}
