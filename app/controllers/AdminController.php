<?php

class AdminController extends BaseController {

	public function eventos()
	{
		return View::make('admin.eventos')->withActivo('eventos');
	}
	public function areas()
	{
		return View::make("admin.areas")->withActivo('areas');
	}
	public function directiva()
	{
		return View::make("admin.directiva")->withActivo('directiva');
	}
	public function noticias()
	{
		return View::make("admin.noticias")->withActivo('noticias');
	}
	public function recibos()
	{
		return View::make("admin.recibos")->withActivo('recibos');
	}
	public function personas()
	{
		return View::make("admin.personas")->withActivo('personas');
	}
	public function personal()
	{
		return View::make("admin.personal")->withActivo('personal');
	}
	public function vehiculos()
	{
		return View::make("admin.vehiculos")->withActivo('vehiculos');
	}
	public function visitantes()
	{
		return View::make("admin.visitantes")->withActivo('visitantes');
	}
	public function encuestas()
	{
		return View::make("admin.encuestas")->withActivo('encuestas');
	}
	public function residencias()
	{
		return View::make("admin.residencias")->withActivo('residencias');
	}
	public function galeria()
	{
		$files = File::files(public_path()."/images/galeria");
		if (Input::hasFile('file'))
		{
			$validator = Validator::make(Input::all(), array('file'=> 'image|max:10240'));
			if ($validator->fails())
			{
				return Redirect::to('admin/Galeria')->withFiles($files)->withErrors($validator);
			}
			Input::file('file')->move(public_path()."/images/galeria/",quitar_tildes(Input::file('file')->getClientOriginalName()));
			$files =File::files(public_path()."/images/galeria");
		}
		if (Input::has('path'))
		{
			Event::fire('eliminarArchivo', public_path()."/images/galeria/" . Input::get('path'));
			return "Imagen Eliminada Correctamente";
		}
		return View::make('admin.galeria')->withFiles($files)->withActivo('galeria');
	}

	//Funciones para Documentos
	public function documentos(){
		$files =File::files(public_path()."/docs");
		if (Input::hasFile('file'))
		{
			$validator = Validator::make(Input::all(), array('file'=> 'mimes:jpeg,bmp,png,doc,docx,xls,xlsx,pdf,ppt,pptx,txt|max:10240'));
			if ($validator->fails())
			{
				return Redirect::to('admin/Documentos')->withFiles($files)->withErrors($validator)->withActivo('documentos');
			}
			Input::file('file')->move(public_path()."/docs/",quitar_tildes(Input::file('file')->getClientOriginalName()));
			$files =File::files(public_path()."/docs");
		}
		if (Input::has('path'))
		{
			if (Event::fire('eliminarArchivo', public_path()."/docs/" . Input::get('path')))
				return "Documento Eliminado Correctamente";
			else
				return "No Se Pudo Eliminar El Documento";
		}
		$documentos = Documento::all();
		 return View::make('admin.documentos')->withFiles($files)->withDocumentos($documentos)->withActivo('documentos');
	}

	public function agregarDocumento(){
		if(Input::method() == "POST"){
			$validator = Validator::make($data = Input::all(), Documento::$rules);
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
			$documento = Documento::create(Input::all());
			$documento->morosos = Input::get('morosos', false);
			$documento->save();
			Session::flash('success', "Documento Agregado");
			return Redirect::to('admin/Documentos');
		}
		return View::make('admin.documento-editor');
	}

	public function editarDocumento($id){
		$documento = Documento::find($id);
		if(Input::method() == "POST"){
			$validator = Validator::make($data = Input::all(), Documento::$rules);
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
			$documento->morosos = Input::get('morosos', false);
			$documento->fill(Input::all())->save();
			Session::flash('success', "Documento Editado");
			return Redirect::to('admin/Documentos');
		}

		return View::make('admin.documento-editor')->withDocumento($documento);
	}

	public function eliminarDocumento($id){
		 Documento::find($id)->delete();
		Session::flash('success', "Documento Eliminado");
		return Redirect::to('admin/Documentos');

	}

	public function toggleDocumento($id){
		 $documento = Documento::find($id);
		 if ($documento->activo == 0) {
			 $documento->activo = 1;
			 $documento->save();
			 Session::flash('success', "Documento Activado");
		 }
		 else{
			$documento->activo = 0;
			$documento->save();
			Session::flash('success', "Documento Desactivado");
		 }
		return Redirect::to('admin/Documentos');

	}


	// Controladores para Email
	public function emailPorUsuario()
	{
		$correos =User::lists('email','nombre');
		return View::make('admin.email')->withCorreos($correos)->withActivo('emailPorUsuario');
	}
	public function emailPorResidencia()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos)->withActivo('emailPorResidencia');
	}
	public function emailPorMoroso()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->where("residencias.solvencia","=","0")
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos)->withActivo('emailPorMoroso');
	}
	public function emailPorSolvencia()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->where("residencias.solvencia","=","1")
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos)->withActivo('emailPorSolvencia');
	}

	public function push(){
		$dispositivos = Dispositivo::active()->mensajes()->get();
		$disp = [];

		foreach ($dispositivos as $dispositivo) {
			$disp[]= PushNotification::Device($dispositivo->token);
		}

		$devices = PushNotification::DeviceCollection($disp);

		$message = PushNotification::Message(Input::get('mensaje'),[
		    'badge' => 1,
			'image' => 'www/logo.png',
			'soundname' => 'alert',
			"ledColor" => [0, 146, 234, 255],
		    'title' => Input::get('titulo'),
		    "style" => "inbox",
        	"summaryText" =>  "Tienes %n% notificaciones",
        	'actions' => [["title" => "Abrir", "callback"=> "abrir", "foreground"=>  true]]
			]);

		$collection = PushNotification::app('android')
	        ->to($devices)
	        ->send($message);

		Session::flash('success', 'Mensaje enviado');
	    return Redirect::back();
	}

  //Controladores para el Diseño
	public function Portada()
	{
		if (Input::has("id"))
		{
			Event::fire('eliminarArchivo', public_path()."/images/portadas/" . DB::table("portadas")->where("id",Input::get("id"))->first()->media);
			DB::table("portadas")->where("id",Input::get("id"))->delete();
			return View::make("admin.portadas");
		}
		if (Input::method()=="POST")
		{

			$validator = Validator::make(Input::all(), array(
				'media'=> 'image|max:10240',
				'titulo'=> 'max:50|min:3',
				'contenido' => 'max:500|min:8'));
			if ($validator->fails())
			{
				return Redirect::to('admin/Diseño/Portada')->withErrors($validator);
			}
			$id = DB::table("portadas")->insertGetId(Input::only('titulo','contenido'));
			Input::file('media')->move(public_path()."/images/portadas/","slider" . $id .".". Input::file('media')->getClientOriginalExtension());
			DB::table("portadas")
			->where("id","=",$id)
			->update(array("media"=> "slider" . $id .".". Input::file('media')->getClientOriginalExtension()));
		}
		return View::make("admin.portadas")->withActivo('portadas');
	}
}
