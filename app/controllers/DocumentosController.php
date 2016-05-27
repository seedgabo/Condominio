<?php

class DocumentosController extends \BaseController {

	/**
	 * Display a listing of documentos
	 *
	 * @return Response
	 */
	public function index()
	{
		$documentos = Documento::select("id","titulo","morosos","activo")->activo()->get();
		$list  = [];
		foreach (File::files(public_path()."/docs")  as $documento) {
			$list[]  =  array("titulo" => substr(strrchr($documento,'/'),1) , "url" => asset('docs/' . substr(strrchr($documento,'/'),1)) );
		}
		$docs = array_where($list, function ($key, $documento ){
			return $documento["titulo"] != 'index.html';
		});
		$data["documentos_dinamicos"] = $documentos;
		$data["documentos_clasicos"] = array_values($docs);
		return Response::json($data, 200);
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
			return Response::json($validator->errors, 300);
		}

		$documento = Documento::create($data);

		return  Response::json($documento,200);
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
			return Response::json($validator->errors, 300);
		}

		$documento->update($data);

		return Response::json($documento, 200);
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
		return $id;
	}

}
