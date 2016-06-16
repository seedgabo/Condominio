<?php

class SolvenciasController extends \BaseController {

	/**
	 * Display a listing of solvencias
	 *
	 * @return Response
	 */
	public function index()
	{
		$solvencias = Solvencia::where('residencia_id','=',Auth::user()->residencia_id)
		->orderby("año","desc")
		->orderby("mes","desc")
		->get();
		$solvencias->each(function($sol){
			$sol->facturado = traducir_fecha($sol->facturado_el->formatLocalized("%d/%m/%Y"));
			$sol->cancelado = traducir_fecha($sol->cancelado_el->formatLocalized("%d/%m/%Y"));
		});
		return Response::json($solvencias);
	}

	/**
	 * Show the form for creating a new solvencia
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('solvencias.create');
	}

	/**
	 * Store a newly created solvencia in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data = array_add($data, "residencia_id", Auth::user()->residencia_id);
		$validator = Validator::make($data, Solvencia::$rules);

		if ($validator->fails())
		{
			return "ERROR";
		}
		$solvencia = Solvencia::create($data);

		return $solvencia;
	}

	/**
	 * Display the specified solvencia.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$solvencia = Solvencia::findOrFail($id);

		return View::make('solvencias.show', compact('solvencia'));
	}

	/**
	 * Show the form for editing the specified solvencia.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$solvencia = solvencia::find($id);

		return View::make('solvencias.edit', compact('solvencia'));
	}

	/**
	 * Update the specified solvencia in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$solvencia = Solvencia::findOrFail($id);

		$validator = Validator::make($data = Input::all(), solvencia::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$solvencia->update($data);

		Session::flash("message", "solvencia Actualizado Correctamente");
		return   $solvencia;
	}

	/**
	 * Remove the specified solvencia from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->residencia->id == Solvencia::find($id)->residencia_id)
		{
			Solvencia::destroy($id);
			return Response::json(['status' => 'TRUE'], 200);
		}
		else{
			return Response::json(['status' => 'ERROR'], 403);
		}
	}

}
