<?php

class VisitantesController extends \BaseController {

	/**
	 * Display a listing of visitantes
	 *
	 * @return Response
	 */
	public function index()
	{
		$visitantes = Visitante::join("residencias","residencias.id","=","visitantes.residencia_id")
		->select('visitantes.*' , 'residencias.nombre as residencia')
		->orderby("residencia_id")
		->get();

		return Response::json($visitantes);
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
		$data = Input::all();
		$data = array_add($data, 'residencia_id', Auth::user()->residencia_id);
		return Visitante::create($data);
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
			return  Response::json('No Autorizado', 401);
		}

		$visitante->update($data);
		$visitante->save();
		return $visitante;
	}

	/**
	 * Remove the specified visitante from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->residencia->id == Visitante::findorFail($id)->residencia_id || Auth::user()->admin == 1)
		{
			Visitante::destroy($id);
			return "TRUE";
		}
		else{
			return Response::json("No Autorizado", 401);
		}
	}

}
