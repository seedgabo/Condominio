<?php

class AreasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /eventos
	 *
	 * @return Response
	 */
	public function index()
	{
	  $areas = Areas::all();
	  return $areas;
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
		return	 json_encode(Areas::find($id));
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

	}

}
