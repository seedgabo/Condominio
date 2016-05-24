<?php

class VehiculosController extends \BaseController {

	/**
	 * Display a listing of vehiculos
	 *
	 * @return Response
	 */
	public function index()
	{
		$vehiculos = Vehiculo::join("residencias","residencias.id","=","vehiculos.residencia_id")
		->select('vehiculos.*' , 'residencias.nombre as residencia')
		->orderby("residencia_id")
		->get();

		return Response::json($vehiculos);
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
	 * Store a newly created vehiculo in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Vehiculo::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Vehiculo::create($data);

		Session::flash("message", "Vehiculo Creado Correctamente");
		return Redirect::back();
	}

	/**
	 * Display the specified vehiculo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vehiculo = Vehiculo::findOrFail($id);

		return View::make('vehiculos.show', compact('vehiculo'));
	}

	/**
	 * Show the form for editing the specified vehiculo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vehiculo = Vehiculo::find($id);

		return View::make('vehiculos.edit', compact('vehiculo'));
	}

	/**
	 * Update the specified vehiculo in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$vehiculo = Vehiculo::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Vehiculo::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$vehiculo->update($data);

		Session::flash("message", "Vehiculo Actualizado Correctamente");
		return Redirect::back();
	}

	/**
	 * Remove the specified vehiculo from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Vehiculo::destroy($id);

		Session::flash("message", "Vehiculo Eliminado Correctamente");
		return Redirect::back();
	}

}
