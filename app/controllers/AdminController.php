<?php

class AdminController extends BaseController {
	
	public function eventos()
	{
		return View::make('admin.eventos');
	}
	public function areas()
	{
		return View::make("admin.areas");
	}
	public function directiva()
	{
		return View::make("admin.directiva");
	}
	public function noticias()
	{
		return View::make("admin.noticias");
	}
	public function recibos()
	{
		return View::make("admin.recibos");
	}
	public function personas()
	{
		return View::make("admin.personas");
	}
	public function personal()
	{
		return View::make("admin.personal");
	}
	public function encuestas()
	{
		return View::make("admin.encuestas");
	}
	public function residencias()
	{
		return View::make("admin.residencias");
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
		return View::make('admin.galeria')->withFiles($files);
	}
	public function documentos()
	{
		$files =File::files(public_path()."/docs");
		if (Input::hasFile('file'))
		{
			$validator = Validator::make(Input::all(), array('file'=> 'mimes:jpeg,bmp,png,doc,docx,xls,xlsx,pdf,ppt,pptx,txt|max:10240'));
			if ($validator->fails())
			{
				return Redirect::to('admin/Documentos')->withFiles($files)->withErrors($validator);
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
		return View::make('admin.documentos')->withFiles($files);
	}


	// Controladores para Email
	public function emailPorUsuario()
	{
		$correos =User::lists('email','nombre');
		return View::make('admin.email')->withCorreos($correos);
	}
	public function emailPorResidencia()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos);
	}
	public function emailPorMoroso()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->where("residencias.solvencia","=","0")
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos);
	}
	public function emailPorSolvencia()
	{
		$correos =Residencias::rightJoin('personas', 'personas.id', '=', 'residencias.persona_id_propietario')
		->where("residencias.solvencia","=","1")
		->select("personas.email as correo","residencias.nombre")->lists("correo","nombre");
		return View::make('admin.email')->withCorreos($correos);
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
		return View::make("admin.portadas");
	}
}
