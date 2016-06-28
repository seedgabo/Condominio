<?php

class NotificacionesController extends \BaseController {

	/**
	 * Display a listing of notificaciones
	 *
	 * @return Response
	 */
	public function index()
	{
		$notificaciones =  Auth::user()->notificaciones->sortByDesc('id')->take(50);
		return Response::json($notificaciones,200);
	}

	/**
	 * Show the form for creating a new notificacione
	 *
	 * @return Response
	 */
	public function all()
	{
		return View::make('notificaciones.create');
	}

	/**
	 * Store a newly created notificacione in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Notificacion::$rules);
		$data = array_add($notificaciones,'user_id',Auth::user()->id);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$notificacion = Notificacion::create($data);

		return Response::json($notificacion,200);
	}

	/**
	 * Display the specified notificacione.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$notificacion = Notificacion::findOrFail($id);

		return Response::json($notificacion,200);
	}

	/**
	 * Show the form for editing the specified notificacione.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function marcarComoLeido($id)
	{
		$notificacion = Notificacion::find($id);
		$notificacion->leido= 1;
		$notificacion->save();
		return Response::json($notificacion,200);
	}

	public function marcarComoNoLeido($id)
	{
		$notificacion = Notificacion::find($id);
		$notificacion->leido= 0;
		$notificacion->save();
		return Response::json($notificacion,200);
	}

	/**
	 * Update the specified notificacione in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$notificacion = Notificacion::findOrFail($id);

		$notificacion->update($data);

		return Response::json($notificacion,200);
	}

	/**
	 * Remove the specified notificacione from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Notificacion::destroy($id);

		return Response::json(["status" => 'success'],200);
	}

}
