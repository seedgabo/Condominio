<?php

class EncuestasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return json_encode(Encuestas::get());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		Auth::once(Input::only('email','password'),true);
		$encuesta  = Encuestas::find($id);
		$resultados[1]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","1")->count('respuesta');
		$resultados[2]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","2")->count('respuesta');
		$resultados[3]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","3")->count('respuesta');
		$resultados[4]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","4")->count('respuesta');
		$resultados[5]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","5")->count('respuesta');
		$resultados[6]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","6")->count('respuesta');
		$respuesta = EncuestasRespuestas::where("persona_id","=",Auth::id())->where("encuesta_id","=",$id)->first();
		$data = array('encuesta' => $encuesta , 'resultados' => $resultados , 'respuestausuario' => $respuesta);
		return  $data;
	}


	/**
	 * Show the form for editing the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
			Auth::attempt(Input::only('email','password'),true);
			$respuestaUsuario = EncuestasRespuestas::firstOrCreate(['encuesta_id' =>$id, 'persona_id' => Auth::id()]);
			$respuestaUsuario->update(Input::get('data'));
			$respuestaUsuario->save();
			return json_encode($respuestaUsuario);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
