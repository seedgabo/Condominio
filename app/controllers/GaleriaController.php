<?php

class GaleriaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /galeria
	 *
	 * @return Response
	 */
	public function index()
	{
		$list  = File::files(public_path()."/images/galeria");
		foreach ($list as $key => $imagen) {
		 $imagenes[$key]['src'] = asset("/images/galeria") . strrchr($imagen,"/");
		 $imagenes[$key]['sub'] = substr(strrchr($imagen,"/"),1);
 		}

		return $imagenes;
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /galeria/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /galeria
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /galeria/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$list  = File::files(public_path()."/images/galeria");

		 $list[$id]  = asset("/images/galeria") . strrchr($list[$id],"/");

		return $list[$id];
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /galeria/{id}/edit
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
	 * PUT /galeria/{id}
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
	 * DELETE /galeria/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
