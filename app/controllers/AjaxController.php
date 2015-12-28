<?php

class AjaxController extends BaseController {


	public function Calendar($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Eventos::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Eventos::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Eventos::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Eventos::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Eventos::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
			if($action=="areas")
			{
				$nulos = DB::table('areas')->select(DB::raw("'Ninguna' as DisplayText,'null' as value"));
				$respuesta = DB::table('areas')
				->select("nombre as DisplayText","nombre as Value")->union($nulos)->orderby('value','asc')->distinct()
				->get();
				return	"var opciones=" .json_encode($respuesta);
			}
		}
	}
	public function Areas($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Areas::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Areas::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Areas::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Areas::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Areas::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
		}
	}
	public function Directiva($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Directiva::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Directiva::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Directiva::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Directiva::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Directiva::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
		}
	}
	public function noticias($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Noticias::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Noticias::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Noticias::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				$path =	Noticias::find(Input::get("id"))->media;
				Event::fire('eliminarArchivo', public_path() ."/images/". $path);
				Noticias::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Noticias::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
		}
	}
	public function Recibos($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Recibos::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Recibos::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Recibos::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				$path =	Recibos::find(Input::get("id"))->path;
				Event::fire('eliminarArchivo', public_path() ."/images/recibos/". $path);
				Recibos::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Recibos::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
			if($action=="personas")
			{
				$nulos = DB::table('personas')->select(DB::raw("'NO POSEE' as DisplayText, NULL as Value"));
				$respuesta = DB::table('personas')
				->select("nombre as DisplayText","id as Value")->union($nulos)->orderby('value','asc')->distinct()
				->get();
				return	"var opciones=" .json_encode($respuesta);
			}
		}
	}
	public function residencias($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Residencias::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Residencias::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Residencias::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Residencias::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				if (Input::has('q'))
					$Records = Residencias::where("id", Input::get('q'))->get();
				else
					$Records = Residencias::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
			if($action=="personas")
			{
				$nulos = DB::table('personas')->select(DB::raw("'NO POSEE' as DisplayText,'null' as value"));
				$respuesta = DB::table('personas')
				->select("nombre as DisplayText","id as Value")->union($nulos)->orderby('value','desc')->distinct()
				->get();
				return	"var opciones=" .json_encode($respuesta);
			}
		}
	}
	public function personas($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = User::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				User::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => User::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				User::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = User::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
			if($action=="residencia")
			{
				$nulos = DB::table('residencias')->select(DB::raw("'NO POSEE' as DisplayText, NULL as Value"));
				$respuesta = DB::table('residencias')
				->select("nombre as DisplayText","id as Value")->union($nulos)->orderby('value','asc')->distinct()
				->get();
				return	"var opciones=" .json_encode($respuesta);
			}
		}
	}
	public function personal($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Personal::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Personal::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Personal::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Personal::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Personal::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
			if($action=="residencia")
			{
				$nulos = DB::table('residencias')->select(DB::raw("'NO POSEE' as DisplayText, NULL as Value"));
				$respuesta = DB::table('residencias')
				->select("nombre as DisplayText","id as Value")->union($nulos)->orderby('value','asc')->distinct()
				->get();
				return	"var opciones=" .json_encode($respuesta);
			}
		}
	}
	public function encuestas($action)
	{
		if (isset($action))
		{
			if ($action=="create" ) 
			{
				$data = Encuestas::firstOrCreate(Input::all());
				return	$respuesta = array('Record' => $data,'Result'=>"OK") ;
			}
			if ($action=="edit" ) 
			{
				Encuestas::where("id" ,Input::get("id"))->update(Input::except("id"));
				return $respuesta = array('Record' => Encuestas::find(Input::get('id')),'Result'=>"OK") ;
			}
			if($action=="remove")
			{
				Encuestas::where('id',Input::get("id"))->delete();
				return  '{"Result":"OK"}';
			}
			if($action=="list")
			{
				$Records = Encuestas::get();
				$respuesta= array('Records' => $Records, 'Result' => "OK");
				return json_encode($respuesta);
			}
		}
	}
	public function solvencias($action)
	{
		if (isset($action))
		{
			if ($action=="solventar" ) 
			{
				$data = Solvencia::firstOrCreate(Input::all());
			  $data->estado = 1;
			  $data->save();
				return View::make('admin/estadoSolvencia')->withMes($data->mes)->with('año',$data->año)->withResidencia(Residencias::find($data->residencia_id));
			}
			if($action=="adeudar")
			{
				$data = Solvencia::firstOrCreate(Input::all());
			  $data->estado = 0;
			  $data->save();
				return View::make('admin/estadoSolvencia')->withMes($data->mes)->with('año',$data->año)->withResidencia(Residencias::find($data->residencia_id));
			}
				if($action=="acreditar")
			{
				$data = Solvencia::firstOrCreate(Input::all());
			  $data->estado = 2;
			  $data->save();
				return View::make('admin/estadoSolvencia')->withMes($data->mes)->with('año',$data->año)->withResidencia(Residencias::find($data->residencia_id));
			}			
			if($action=="obtener")
			{
				$data = Solvencia::firstOrCreate(Input::all());
				$data = array_add($data,'estado_org', $data->getOriginal('estado'));
				return  Response::json($data, 200);
			}
			if($action=="establecer")
			{
				Solvencia::where('id',"=", Input::get('id'))->update(Input::except('id','_token'));
				$data = Solvencia::find(Input::get('id'));
				return  Response::json($data, 200);
			}
				if($action=="vistar")
			{
				$data = Solvencia::firstOrCreate(Input::all());
				return View::make('admin/estadoSolvencia')->withMes($data->mes)->with('año',$data->año)->withResidencia(Residencias::find($data->residencia_id));
			}
		}
	}

	public function resultadosEncuesta($id)
	{
		if(Input::has('respuesta'))
		{
			$respuesta= EncuestasRespuestas::firstOrCreate(Input::except("respuesta","comentarios"));
			$respuesta->update(Input::all());
			return $respuesta;
		}
		$encuesta  = Encuestas::find($id);
		$resultados[1]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","1")->count('respuesta');
		$resultados[2]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","2")->count('respuesta');
		$resultados[3]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","3")->count('respuesta');
		$resultados[4]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","4")->count('respuesta');
		$resultados[5]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","5")->count('respuesta');
		$resultados[6]= EncuestasRespuestas::where('encuesta_id',"=",$encuesta->id)->where("respuesta","=","6")->count('respuesta');
		header('Access-Control-Allow-Origin:*');
		$respuesta = EncuestasRespuestas::where("persona_id","=",Auth::id())->where("encuesta_id","=",$id)->first();
		return View::make('renderpie')->withEncuesta($encuesta)->withResultados($resultados)->withRespuesta($respuesta);
	}
	public function cambiarsolvencia()
	{
		$residencia= Residencias::find(Input::get('id'));
		$residencia->solvencia ==0 ? $residencia->solvencia =1 : $residencia->solvencia =0;
		$residencia->save();
		return $residencia;
	}
	public function email()
	{

		if (Input::has('to'))

		{

			$validator = Validator::make(Input::all(), 

				array('contenido'=> 'required|min:8',

					'title'=> 'required|min:3|max:50',

					'to'=> 'required',

					'file' => 'max:10240|mimes:jpeg,bmp,png,doc,docx,xls,xlsx,pdf,jpg,gif,sql,txt,ppt,pptx'

					));

			if ($validator->fails())

			{

				$salida ['message'] =  $validator->messages()->first();

				return Redirect::back()->withErrors($validator);

			}



			foreach (Input::get('to') as $to) 

			{

				Mail::send('emails.basic', array('title' => Input::get('title'), 'contenido' => Input::get('contenido')), function($message) use ($to)

				{

					$message->to($to)->subject(Input::get('title'));

					if(Input::hasFile('file'))

					{

						$message->attach(Input::file('file')->getRealPath(), array('as' =>Input::file('file')->getClientOriginalName()));

					}

				});

			};



			$salida['message'] = "Mensaje Enviado entregado a los Destinatarios:  ";

			$salida['status']  = "ok";

			foreach (Input::get('to') as $key => $correo) {

				$salida['message'] .= $correo  .",  ";

			}

			return  json_encode($salida);

		}

		return "error No Ha Seleccionado ningun Destinatario";
	}
}