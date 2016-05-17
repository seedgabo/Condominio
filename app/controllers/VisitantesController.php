<?php

class VisitantesController extends \BaseController {

	/**
	 * Display a listing of visitantes
	 *
	 * @return Response
	 */
	public function index()
	{
		$visitantes = Visitante::all();

		return View::make('visitantes.index', compact('visitantes'));
	}

	/**
	 * Show the form for creating a new visitante
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('visitantes.create');
	}

	/**
	 * Store a newly created visitante in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Visitante::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Visitante::create($data);

		return Redirect::route('visitantes.index');
	}

	/**
	 * Display the specified visitante.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$visitante = Visitante::findOrFail($id);

		return View::make('visitantes.show', compact('visitante'));
	}

	/**
	 * Show the form for editing the specified visitante.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$visitante = Visitante::find($id);

		return View::make('visitantes.edit', compact('visitante'));
	}

	/**
	 * Update the specified visitante in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$visitante = Visitante::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Visitante::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$visitante->update($data);

		return Redirect::route('visitantes.index');
	}

	/**
	 * Remove the specified visitante from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Visitante::destroy($id);

		return Redirect::route('visitantes.index');
	}

}
