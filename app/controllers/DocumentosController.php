<?php

class DocumentosController extends \BaseController {

	/**
	 * Display a listing of documentos
	 *
	 * @return Response
	 */
	public function index()
	{
		$documentos = Documento::all();

		return View::make('documentos.index', compact('documentos'));
	}

	/**
	 * Show the form for creating a new documento
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('documentos.create');
	}

	/**
	 * Store a newly created documento in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Documento::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Documento::create($data);

		return Redirect::route('documentos.index');
	}

	/**
	 * Display the specified documento.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$documento = Documento::findOrFail($id);

		return View::make('documentos.show', compact('documento'));
	}

	/**
	 * Show the form for editing the specified documento.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$documento = Documento::find($id);

		return View::make('documentos.edit', compact('documento'));
	}

	/**
	 * Update the specified documento in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$documento = Documento::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Documento::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$documento->update($data);

		return Redirect::route('documentos.index');
	}

	/**
	 * Remove the specified documento from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Documento::destroy($id);

		return Redirect::route('documentos.index');
	}

}
