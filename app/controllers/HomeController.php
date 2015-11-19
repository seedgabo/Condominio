<?php

class HomeController extends BaseController {

	
	public function inicio()
	{		
		$noticias =	DB::table('noticias')->take(20)->orderby('fecha','desc')->orderby('id','asc')->get();
		$eventos = DB::table('eventos')
		->where('fecha_ini','>=',Carbon\Carbon::now())
		->take(10)
		->orderby('fecha_ini','asc')
		->orderby('tiempo_ini','asc')
		->get();
		return  View::make('inicio')->with('noticias',$noticias)->withEventos($eventos);
	}	
	public function agregarnoticia()
	{
		if (Request::isMethod('post'))
		{
			$rules =  array(
				'media' => 'mimes:jpg,jpeg,gif,bmp,png|max:10240|',
				'titulo' => 'required|min:3,max:30',
				'contenido' => 'required' 
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('agregar-noticia')->withErrors($validation);
			}

			$data= Input::except('_token','media');
			$fecha = new Carbon\Carbon();
			$fecha->setTimezone('America/Caracas');			
			$data= array_add($data,'fecha',$fecha::now());
			$data= array_add($data,'persona',Auth::user()->nombre . " de Residencia " . Residencias::find(Auth::user()->residencia_id)->nombre);
			if (Input::hasFile('media'))
			{
				$newName = quitar_tildes(Input::file('media')->getClientOriginalName());
				Input::file('media')->move(public_path('images/noticias'),$newName);
				$data= array_add($data,'media',$newName );
			}
			Noticias::create($data);
			Session::flash('message', '# Noticia Cargada Correctamente #');
			return Redirect::to('/');
		}
		return View::make('agregarnoticia');
	}
	public function agregarevento()
	{
		if (Request::isMethod('post'))
		{
			$rules =  array(
				'razon' =>'required|min:6|max:30',
				'fecha_ini' =>'required',
				'fecha_fin' =>'required'
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('agregar-evento')->withErrors($validation);
			}
			$data= Input::except("_token","area");
			$data['tiempo_ini'] = date("G:i", strtotime(Input::get('tiempo_ini')));
			$data['tiempo_fin'] = date("G:i", strtotime(Input::get('tiempo_fin')));
			$data= array_add($data,'persona', Auth::user()->nombre);
			$areas = "";
			foreach (Input::get('area',array()) as $key => $value) {
				$areas .= $key .', ';
			}
			$data= array_add($data, 'areas',$areas);
			$id =DB::table('eventos')->insertGetId($data);
			Session::flash('message', "Evento Agregado Correctamente");
			return  Redirect::To('ver-eventos');
		}
		return View::make('agregarevento');
	}
	public function agregarrecibo()
	{
		if (Request::isMethod('post'))
		{
			$rules =  array(
				'archivo' => 'image|max:10240',
				'concepto' => 'required|min:3,max:30',
				'monto' => 'required|numeric|min:0' 
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('agregar-recibo')->withErrors($validation);
			}
			$data= Input::except("_token","archivo");
			$data= array_add($data,'persona_id', Auth::user()->id);
			if(Input::hasFile('archivo'))
			{
				$newName = quitar_tildes(Input::file('archivo')->getClientOriginalName());
				Input::file('archivo')->move(public_path('images/recibos'),$newName);
				$data= array_add($data,'path',$newName);
			}

			$id =Recibos::insertGetId($data);
			Session::flash('message', "Recibo Agregado Correctamente");
			return  Redirect::to('ver-recibos');
		}
		return View::make('agregarrecibo');
	}
	public function agregarimagen()
	{
		if (Request::isMethod('post'))
		{
			if (Input::hasFile('file'))
			{
				$rules =  array(
					'file' => 'mimes:jpg,jpeg,gif,bmp,png|max:10240|'
					);
				$validation = Validator::make(Input::except('_token'),$rules);
				if ($validation->fails())
				{
					return Redirect::to('agregar-imagen')->withErrors($validation);
				}
				Input::file('file')->move(public_path()."/images/galeria/", Input::file('file')->getClientOriginalName());
				Session::flash('message',"Imagen subida a la Galeria Correctamente");
				return Redirect::to('ver-galeria');
			}
		}
		return View::make('agregarimagen');
	}
	public function verfullcalendar()
	{
		$proximos = DB::table('eventos')
		->where('fecha_ini','>=',Carbon\Carbon::now())
		->take(10)
		->orderby('fecha_ini','asc')
		->orderby('tiempo_ini','asc')
		->get();
		$eventos = Eventos::select('razon as title',
			DB::raw('CONCAT(fecha_ini,"T",tiempo_ini) as start'),
			DB::raw('CONCAT(fecha_fin,"T",tiempo_fin) as end'))
		->get();
		//dd($eventos->toJson());
		return View::make('vercalendario')->withEvents($eventos->toJson())->withProximos($proximos);
	}
	public function verdirectiva()
	{
		$tabla = DB::table('directiva')->select('nombre','cargo')->get();
		return View::make('directiva')->with('tabla',$tabla);
	}
	public function verrecibos()
	{
		$recibos = Recibos::where("persona_id","=" ,Auth::user()->id)->orderby("id","asc")->get();
		return View::make('verrecibos')->withRecibos($recibos);
	}
	public function vergaleria()
	{
		$list  = File::files(public_path()."/images/galeria");
		return View::make('vergaleria')->withImagenes($list);
	}
	public function verdocumentos()
	{
		$list  = File::files(public_path()."/docs");
		return View::make('verdocumentos')->withDocs($list);
	}
	public function verresidencia()
	{
		$residencia = DB::table('residencias')
		->select("personas.nombre as Dueño","personas.*","residencias.*")
		->leftjoin('personas',"personas.id","=","residencias.persona_id_propietario")
		->where("residencias.id", "=", Auth::user()->residencia_id)
		->first(); 
		$residentes = DB::table('personas')
		->select("personas.nombre")
		->join("residencias","personas.residencia_id","=","residencias.id")
		->where("residencias.id", "=" , $residencia->id)
		->get();
		$personal = Personal::where("residencia_id","=",Auth::user()->residencia_id)->get();
		return View::make('verdatosresidencia')->withResidencia($residencia)->withResidentes($residentes)->withPersonal($personal);
	}
	public function vernoticias()
	{
		$noticias =	DB::table('noticias')->orderby('fecha','desc')->get();
		return View::make('vernoticias')->with('noticias',$noticias);
	}
	public function verpersonal()
	{
		$personal = Personal::all();
		$tupersonal = Personal::where("residencia_id","=",Auth::user()->residencia_id) ->get();
		if (Input::has(array("nombre","cargo","cedula")))
		{
			$rules =  array(
				'nombre' => 'required|min:8|max:50',
				'cedula' => 'required|min:1000|numeric',
				'telefono' => 'required|min:7',
				'cargo'  => 'required|min:4|max:30',
				'email'  => 'email'
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('ver-personal')->withErrors($validation);
			}
			$datos = Input::except('_token');
			$datos = array_add($datos,"residencia_id",Auth::user()->residencia_id);
			Personal::FirstorCreate ($datos);
			Session::flash('message', 'Personal Agregado Correctamente');
		}
		$personal = Personal::all();
		$tupersonal = Personal::where("residencia_id","=",Auth::user()->residencia_id) ->get();
		return View::make('verpersonal')->withPersonal($personal)->withTupersonal($tupersonal);
	}
	public function verencuestas()
	{
		$encuestas = Encuestas::orderby('updated_at','asc')->take(100)->get();
		return View::make('verencuesta')->withEncuestas($encuestas);
	}
	public function eliminarrecibo($id)
	{
		$recibo =	recibos::find($id);
		if ($recibo->persona_id == Auth::user()->id) {
			File::delete(public_path()."/images/recibos/".$recibo->path);
			$recibo->delete();
			Session::flash('message', 'Recibo o Factura Borrado Correctamente');
			return Redirect::to("/");
		}	
		else
		{
			Session::flash('message',"No Posee permisos para realizar esta acción");
			return Redirect::back();
		}	
	}
	public function eliminarpersonal($id)
	{
		$persona =	Personal::find($id);
		if ($persona->residencia_id == Auth::user()->residencia_id) {
			$persona->delete();
			Session::flash('message', 'Personal Borrado Correctamente');
			return Redirect::to("ver-personal");
		}	
		else
		{
			Session::flash('message',"No Posee permisos para realizar esta acción");
			return Redirect::back();
		}	
	}
	public function login()
	{
		
		$credentials =Input::only('email','password');
		if(Auth::attempt($credentials, Input::get('remember', true)))
		{
			Session::flash('message', "Bienvenido " . Auth::user()->nombre);
			return  Redirect::to("/");
		}
		Session::flash('message', "Credenciales Invalidas");
		return  Redirect::to("/");
	}
	public function logout()
	{
		Auth::logout();
		Session::flash('message', 'Session Cerrada');
		return Redirect::to("/");
	}
	public function registro()
	{
		if(Input::has('keycode'))
		{
			//Verificar Keycode
			if(Input::get("keycode")!= Config::get('var.keycode'))
			{
				Session::flash('message', "El Codigo suministrado por el condominio no coincide");
				return Redirect::to("registro");	
			}
			 //Validar Campos
			$rules =  array(
				'nombre' => 'required|min:8|max:30|',
				'email' => 'required|email|unique:personas,email',
				'password' =>'required|min:8|max:50'
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('registro')->withErrors($validation);
			}



		    //registrar usuario
			$input = Input::except('password','keycode','_token');
			$input = array_add($input,"password",Hash::make(Input::get("password")));
			$id= DB::table('personas')->insertGetId($input);
			$credentials =Input::only('email','password');
			if(Auth::attempt($credentials, Input::get('remember', false)))
			{
				Session::flash('message', "Usuario Creado Correctamente");
				return  Redirect::to("/");
			};

		}
		$nulos = DB::table('residencias')->select(DB::raw("'NO POSEE' as label, null as value"));
		$residencias =Residencias::union($nulos)->lists("nombre","id");
		return View::make('formularioregistro')->withResidencias($residencias);
	}
	public function usuarioEdit()
	{
		$residencias = Residencias::lists('nombre','id');
		if (Input::has('nombre'))
		{
			$rules =  array(
				'nombre' => 'required|min:8|max:30|',
				'email' => 'required|email|unique:personas,email,'.Auth::user()->id,
				'residencia_id' => 'required|exists:residencias,id' 
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('Usuario-Edit')->withResidencias($residencias)->withErrors($validation);
			}
			else
			{
				Auth::user()->Update(Input::except('_token'));
				Session::flash('message', 'Usuario Actualizado Correctamente');
				return Redirect::to("/");
			}
		}
		
		return View::make("editarinfo")->withResidencias($residencias);
	}
	public function editarResidencia()
	{
		$residencias = Residencias::lists('nombre','id');
		if (Input::has('nombre'))
		{
			$rules =  array(
				'nombre' => 'required|min:4|max:50',
				'cant_personas' => 'required|numeric|min:0',
				'persona_id_propietario' =>'required|numeric|exists:personas,id' 
				);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('Usuario-Edit')->withResidencias($residencias)->withErrors($validation);
			}
			else
			{
				Residencias::find(Auth::user()->residencia_id)->Update(Input::except('_token'));
				Session::flash('message', 'Residencia Actualizada Correctamente');
				return Redirect::to("ver-residencia");
			}
		}
	}

	
}
