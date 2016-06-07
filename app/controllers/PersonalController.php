<?php

class PersonalController extends \BaseController {

	/**
	 * Display a listing of vehiculos
	 *
	 * @return Response
	 */
	public function index()
	{
		$personal = Personal::join("residencias","residencias.id","=","personal.residencia_id")
		->select('personal.*' , 'residencias.nombre as residencia')
		->orderby("residencia_id")
		->get();

		return Response::json($personal);
	}

	/**
	 * Show the form for creating a new vehiculo
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('vehiculos.create');
	}

	/**
	 * Store a newly created personal in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data = array_add($data, "residencia_id", Auth::user()->residencia_id);

		$personal = Personal::create($data);

		return $personal;
	}

	/**
	 * Display the specified personal.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$personal = Personal::findOrFail($id);

		return $personal;
	}

	/**
	 * Show the form for editing the specified personal.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$personal = Personal::find($id);

		return View::make('personal.edit', compact('personal'));
	}

	/**
	 * Update the specified personal in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$personal = Personal::findOrFail($id);

		if(Auth::user()->residencia->id == Personal::find($id)->residencia_id)
		{
			$personal->update($data);
			return $personal;
		}
		else{
			return "ERROR";
		}
	}

	/**
	 * Remove the specified personal from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->residencia->id == Personal::find($id)->residencia_id)
		{
			Personal::destroy($id);
			return "TRUE";
		}
		else{
			return "ERROR";
		}
	}

}
