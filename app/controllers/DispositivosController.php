<?php

class DispositivosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /dispositivos
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Dispositivo::get(), 200);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dispositivos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dispositivos
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data = array_add($data, "user_id", Auth::user()->id);
		$validator = Validator::make($data, Dispositivo::$rules);

		if ($validator->fails())
		{
			return "ERROR";
		}

		$dispositivo = Dispositivo::firstOrCreate(['token' => Input::get('token')]);
		$dispositivo->fill($data);
		$dispositivo->save();
		return $dispositivo;
	}

	/**
	 * Display the specified resource.
	 * GET /dispositivos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Dispositivo::find($id), 200);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dispositivos/{id}/edit
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
	 * PUT /dispositivos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$data = array_add($data, "user_id", Auth::user()->id);
		$validator = Validator::make($data, Disppositivo::$rules);

		if ($validator->fails())
		{
			return "ERROR";
		}

		$dispositivo = Dispositivo::find(id);
		$dispositivo->fill($data);
		$dispositivo->save();
		return $dispositivo;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dispositivos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Dispositivo::delete($id);
		return "true";
	}

}