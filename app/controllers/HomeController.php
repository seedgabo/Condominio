<?php

class HomeController extends BaseController {

	public function inicio()
	{
		$portadas = DB::table('portadas')->get();
		$noticias =	DB::table('noticias')->take(20)->orderby('created_at','desc')->orderby('id','asc')->get();
		$eventos = DB::table('eventos')
		->where('fecha_ini','>=',Carbon::today())
		->take(10)
		->orderby('fecha_ini','asc')
		->orderby('tiempo_ini','asc')
		->get();
		return  View::make('inicio')->with('noticias',$noticias)->withEventos($eventos)->withPortadas($portadas);
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
			$fecha = new Carbon();
			$fecha->setTimezone('America/Bogota');
			$data= array_add($data,'fecha',$fecha::now());
			if(Auth::user()->avatar != null)
			$imagen ="<img class='avatar circle' src='" . Auth::user()->avatar ."'/>";
			else
			$imagen ='  <i class="fa fa-2x fa-user"></i>';
			$data= array_add($data,'persona', Auth::user()->nombre . " de Residencia " . Residencias::find(Auth::user()->residencia_id)->nombre . $imagen);
			$data= array_add($data,'user_id', Auth::user()->id);
			if (Input::hasFile('media'))
			{
				$newName = quitar_tildes(Input::file('media')->getClientOriginalName());
				Input::file('media')->move(public_path('images/noticias'),$newName);
				$data= array_add($data,'media',$newName );
			}
			Noticias::create($data);
			Session::flash('message', ' Noticia Cargada Correctamente ');
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
			$data= Input::except("_token");
			$data['tiempo_ini'] = date("G:i", strtotime(Input::get('tiempo_ini')));
			$data['tiempo_fin'] = date("G:i", strtotime(Input::get('tiempo_fin')));
			$data= array_add($data,'persona', Auth::user()->nombre);
			$data= array_add($data,'user_id', Auth::user()->id);
			$evento = Eventos::create($data);
			flashMessage("Evento Agregado Correctamente");
			return  Redirect::To('ver-eventos');
		}
		$areas = Areas::get();
		return View::make('agregarevento')->with(compact('areas'));
	}
	public function agregarrecibo()
	{
		if (Request::isMethod('post'))
		{
			$rules =  array(
				'archivo' => 'image|max:10240',
				'concepto' => 'required|min:3,max:30',
				'monto' => 'required|numeric|min:0',
				'mes' => 'numeric|min:1|max:12|required_with:isFactura',
				'año' => 'numeric|min:2000|max:2099|required_with:isFactura'
			);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('agregar-recibo')->withErrors($validation);
			}


			$data= Input::except("_token","archivo","isFactura","mes","año");
			$data= array_add($data,'persona_id', Auth::user()->id);
			if(Input::hasFile('archivo'))
			{
				$newName = quitar_tildes(Input::file('archivo')->getClientOriginalName());
				Input::file('archivo')->move(public_path('images/recibos'),$newName);
				$data= array_add($data,'path',$newName);
			}

			$id =Recibos::insertGetId($data);
			flashMessage("Recibo Agregado Correctamente");
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
				Input::file('file')->move(public_path()."/images/galeria/", quitar_tildes(Input::get('nombre') . "." . Input::file('file')->getClientOriginalExtension()));
				Event::fire('register.image', array(public_path()."/images/galeria/",quitar_tildes(Input::get('nombre') . "." . Input::file('file')->getClientOriginalExtension()),Input::get('album')));
				flashMessage("Imagen Cargada Correctamente");
				return Redirect::to('ver-galeria');
			}
		}
		return View::make('agregarimagen');
	}
	public function verfullcalendar()
	{
		$proximos = Eventos::where('fecha_ini','>=',Carbon::today())
		->take(10)
		->orderby('fecha_ini','asc')
		->orderby('tiempo_ini','asc')
		->get();
		$eventos = Eventos::select('razon as title',
		DB::raw('CONCAT(fecha_ini,"T",tiempo_ini) as start'),
		DB::raw('CONCAT(fecha_fin,"T",tiempo_fin) as end'))
		->get();
		return View::make('vercalendario')->withEventos($eventos->toJson())->withProximos($proximos);
	}
	public function verdirectiva()
	{
		$directiva = Directiva::select("nombre","cargo","telefono","email")->get();
		return View::make('directiva')->with('directiva', $directiva);
	}
	public function verrecibos()
	{
		$recibos = Recibos::where("persona_id","=" ,Auth::user()->id)->orderby("created_at","desc")->get();
		$solvencias = Solvencia::getEstadoResidencia(Auth::user()->residencia->id);
		$deuda = getDeudaTotal(Auth::user()->residencia_id);
		return View::make('verrecibos')->withRecibos($recibos)->withSolvencias($solvencias)->withDeuda($deuda);
	}
	public function vergaleria()
	{
		$list  = File::files(public_path()."/images/galeria");
		return View::make('vergaleria')->withImagenes($list);
	}
	public function verdocumentos()
	{
		$list  = File::files(public_path()."/docs");
		$documentos = Documento::activo()->get();
		return View::make('verdocumentos')
			->withDocs($list)
			->withDocumentos($documentos);
	}
	public function verresidencia()
	{
		$residencia = Input::get('residencia', Auth::user()->residencia_id);
		$residencia = Residencias::
		select("personas.nombre as Dueño","personas.*","residencias.*")
		->leftjoin('personas',"personas.id","=","residencias.persona_id_propietario")
		->where("residencias.id", "=", $residencia)
		->first();
		$residentes = User::
		select("personas.*")
		->join("residencias","personas.residencia_id","=","residencias.id")
		->where("residencias.id", "=" , $residencia)
		->get();
		$personal = Personal::where("residencia_id","=", $residencia)->get();
		$vehiculos  = Vehiculo::where("residencia_id","=",$residencia)->get();
		return View::make('verdatosresidencia')->withResidencia($residencia)->withResidentes($residentes)->withPersonal($personal)->withVehiculos($vehiculos);
	}
	public function vernoticias()
	{
		$noticias =	DB::table('noticias')->orderby('fecha','desc')->paginate(20);
		return View::make('vernoticias')->with('noticias',$noticias);
	}
	public function verpersonal()
	{
		if (Input::has(array("nombre","cargo","cedula")))
		{
			$rules =  array(
				'nombre' => 'required|min:3|max:50',
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
			flashMessage("Personal Agregado Correctamente");
		}
		$personal = Personal::with('residencia')->get();
		$tupersonal = Auth::user()->residencia->personal;
		return View::make('verpersonal')->withPersonal($personal)->withTupersonal($tupersonal);
	}
	public function vervehiculos()
	{
		if (Input::method() == "POST")
		{

			$validation = Validator::make(Input::except('_token'),Vehiculo::$rules);
			if ($validation->fails())
			{
				return Redirect::back()->withErrors($validation);
			}
			$datos = Input::except('_token');
			$datos = array_add($datos,"residencia_id",Auth::user()->residencia_id);
			Vehiculo::FirstorCreate ($datos);
			flashMessage("Vehiculo Agregado Correctamente");
		}
		$vehiculos = Vehiculo::with('residencia')->orderBy("residencia_id","asc")->get();
		$tusvehiculos = Auth::user()->residencia->vehiculos->sortBy('residencia_id');
		return View::make('vervehiculos')->withVehiculos($vehiculos)->withTusvehiculos($tusvehiculos);
	}
	public function vervisitantes()
	{
		if (Input::method() == "POST")
		{

			$validation = Validator::make(Input::except('_token'),Visitante::$rules);
			if ($validation->fails())
			{
				return Redirect::back()->withErrors($validation);
			}
			$datos = Input::except('_token');
			$datos = array_add($datos,"residencia_id",Auth::user()->residencia_id);
			Visitante::FirstorCreate ($datos);
			flashMessage("Visitante Agregado Correctamente");
		}
		$visitantes    = Visitante::with('residencia')->orderBy("residencia_id","asc")->get();
		$tusvisitantes = Auth::user()->residencia->visitantes->sortBy('residencia_id');
		return View::make('vervisitantes')->withVisitantes($visitantes)->withTusvisitantes($tusvisitantes);
	}
	public function verencuestas()
	{
		$encuestas = Encuestas::orderby('updated_at','asc')->take(100)->get();
		return View::make('verencuesta')->withEncuestas($encuestas);
	}
	public function verNotificaciones()
	{
		$notificaciones = Notificacion::Usuario(Auth::user()->id)->orderby("updated_at","desc")->paginate(50);
		return View::make('notificaciones',['notificaciones' => $notificaciones]);
	}
	public function eliminarrecibo($id)
	{
		$recibo =	recibos::find($id);
		if ($recibo->persona_id == Auth::user()->id) {
			File::delete(public_path()."/images/recibos/".$recibo->path);
			$recibo->delete();
			flashMessage("Recibo o Factura  eliminado Correctamente");
			return Redirect::to("ver-recibos");
		}
		else
		{
			flashMessage("No posee los permisos para realizar esta acción", 'red');
			return Redirect::back();
		}
	}
	public function eliminarpersonal($id)
	{
		$persona =	Personal::find($id);
		if ($persona->residencia_id == Auth::user()->residencia_id) {
			$persona->delete();
			flashMessage("Personal Eliminado");
			return Redirect::to("ver-personal");
		}
		else
		{
			flashMessage("No posee los permisos para realizar esta acción", 'red');
			return Redirect::back();
		}
	}
	public function eliminarnoticia($id)
	{
		$noticia =	Noticias::find($id);
		if ($noticia->user_id == Auth::user()->id || Auth::user()->admin == 1) {
			$noticia->delete();
			Session::flash('message', 'Noticia Borrada Correctamente');
			return Redirect::to("ver-noticias");
		}
		else
		{
			flashMessage("No posee los permisos para realizar esta acción", 'red');
			return Redirect::back();
		}
	}
	public function eliminarvehiculo($id)
	{
		$vehiculo =	Vehiculo::find($id);
		if ($vehiculo->residencia_id == Auth::user()->residencia_id) {
			$vehiculo->delete();
			Session::flash('message', 'Vehiculo Eliminado Correctamente');
			return Redirect::back();
		}
		else
		{
			flashMessage("No posee los permisos para realizar esta acción", 'red');
			return Redirect::back();
		}
	}
	public function eliminarnotificacion($id){
		if(Notificacion::find($id)->user_id == Auth::user()->id){
			Notificacion::destroy($id);
			flashMessage("Notificacion Eliminada");
			return Redirect::back();
		}
		else{
			return "No posee los permisos para hacer esta operacion";
		}
	}
	public function generarFactura()
	{
		if (Input::has("persona_id"))
		$persona = User::find(Input::get('persona_id'));
		else
		$persona = Auth::user();

		$residencia = $persona->residencia;
		$time = new Carbon;
		$mes = Input::get('mes', $time->month);
		$año = Input::get('año', $time->year);
		$factura = DB::select(DB::raw(getFactura($residencia->id,$mes,$año)));
		$cant_residencias = Residencias::where("id","<>","1")->count();
		$maestra =  json_decode(File::get(app_path("config/maestra.php")),true);

		$html = View::make('pdf.factura')
			->withFactura($factura)
			->withResidencia($residencia)
			->withPersona($persona)->withMes($mes)
			->with('año',$año)
			->withMaestra($maestra)
			->with('cant_residencias',$cant_residencias);
		$html = renderVariables($html);
		header('Content-Type : application/pdf');
		$headers = array('Content-Type' => 'application/pdf');
		return Response::make(PDF::load($html, 'A4', 'portrait')->show('factura-'.$mes . "-". $año), 200, $headers);
	}
	public function generarDocumento($id)
	{
		$documento = Documento::find($id);
		if($documento->activo == 0){
			return "<h1> Este documento ya no esta disponible</h1>";
		}
		if(Auth::user()->residencia->solvencia == 0 && $documento->morosos == 0){
			return "<h1>Usted no puede acceder a este documento</h1> <h4> Contacte a su administrador</h4>";
		}
		$persona = Input::has('persona') ? User::find(Input::get('persona')) : Auth::user();
        $residencia = Input::has('residencia') ? Residencias::find(Input::get('residencia')) : $persona->residencia;
        $titulo = $documento->titulo;
        $contenido = $documento->contenido;
        $html = View::make('pdf.basic',["persona" => $persona, "residencia" => $residencia, 'contenido' => $contenido]);
		// return $html;
        header('Content-Type : application/pdf');
		$headers = array('Content-Type' => 'application/pdf');
		return Response::make(PDF::load($html, 'A4', 'portrait')->show($titulo), 200, $headers);
	}
	public function generarRecibo($id)
	{
		$solvencia = Solvencia::find($id);
		if(Auth::user()->residencia_id != $solvencia->residencia_id){
			return Response::make("No posee los permisos para ver este recibo", 403);
		}
        $año = $solvencia->año;
        $mes = $solvencia->mes;
        $user = Auth::user();
        $residencia = $solvencia->residencia;
        $html = View::make('pdf.comprobante')->with('año',$año)->withMes($mes)->withResidencia($residencia)->withPersona($user)->withSolvencia($solvencia);
        $html = renderVariables($html);
        header('Content-Type : application/pdf');
		$headers = array('Content-Type' => 'application/pdf');
		return Response::make(PDF::load($html, 'A4', 'portrait')->show('Solvencia-'.$mes . "-". $año), 200, $headers);
	}
	public function login()
	{

		$credentials =Input::only('email','password');
		if(Auth::attempt($credentials, Input::get('remember', true)))
		{
			Session::flash('message', "Bienvenido " . Auth::user()->nombre);
			return  Redirect::to("/");
		}
		flashMessage("Usuario o contraseña invalidos", 'red');
		return  Redirect::to("/");
	}
	public function logout()
	{
		Auth::logout();
		flashMessage("Sesión Finalizada", 'blue lighten-1 rounded');
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
				flashMessage("Usuario creado correctamente");
				return  Redirect::to("/");
			};

		}
		$nulos = DB::table('residencias')->select(DB::raw("'NO POSEE' as label, null as value"));
		$residencias =Residencias::union($nulos)->lists("nombre","id");
		return View::make('formularioregistro')->withResidencias($residencias);
	}
	public function forgotPassword(){
		if (Input::method() == "GET"){
			return View::make('forgotPassword');
		}
	}

	public function perfil()
	{
		$residencias = Residencias::lists('nombre','id');
		if (Input::has('nombre'))
		{
			$rules =  array(
				'nombre' => 'required|min:8|max:30|',
				'email' => 'required|email',
				'residencia_id' => 'exists:residencias,id',
				'cedula' => 'required|min:3|max:10',
			);
			$validation = Validator::make(Input::except('_token'),$rules);
			if ($validation->fails())
			{
				return Redirect::to('perfil')->withResidencias($residencias)->withErrors($validation);
			}
			else
			{
				Auth::user()->Update(Input::except('_token'));
				flashMessage("Usuario Actualziado Correctamente");
				return Redirect::back();
			}
		}
		$tupersonal = Auth::user()->residencia->personal;
		$tusvehiculos   = Auth::user()->residencia->vehiculos;
		$tusvisitantes = Auth::user()->residencia->visitantes;
		return View::make("perfil")->withResidencias($residencias)
		->withTupersonal($tupersonal)->withTusvehiculos($tusvehiculos)->withTusvisitantes($tusvisitantes);
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
				return Redirect::to('perfil')->withResidencias($residencias)->withErrors($validation);
			}
			else
			{
				Residencias::find(Auth::user()->residencia_id)->Update(Input::except('_token'));
				flashMessage("Residencia Actualizada Correctamente");
				return Redirect::to("ver-residencia");
			}
		}
	}


}
