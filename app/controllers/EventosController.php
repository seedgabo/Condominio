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
	  foreach ($eventos as $key => $evento) {
	  	$evento  = array_add($evento,'duracion',traducir_fecha(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini)->diffForHumans(Carbon::parse($evento->fecha_fin . $evento->tiempo_fin)),true));
	  	$evento['inicio'] = traducir_fecha(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini)->toDayDateTimeString());
	  	$evento['fin'] = traducir_fecha(Carbon::parse($evento->fecha_fin . $evento->tiempo_fin)->toDayDateTimeString());
	  }
	  return $eventos;
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
		//
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
		return	 json_encode(Eventos::find($id));
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
		//
	}

}