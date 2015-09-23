<?php

class AdminController extends BaseController {
	
	public function eventos()
	{
		return View::make('admin.eventos');
	}
	public function facturas()
	{
		
		if(Request::isMethod("post"))
		{
			$i=0;
			$monto = Input::get("monto");
			$id= Input::get('id');
			foreach (Input::get('nombre') as $key => $value) 
			{
				$elemento =	DB::table('facturas')->find($id[$i]);
				$array = array('mes' => Input::get("mes"), 
					'año' => Input::get("año"),
					'concepto'=> $value,
					'monto' => $monto[$i] );
				if($elemento ===null)
				{
					DB::table('facturas')->insert($array);
				}
				else
				{
					DB::table('facturas')->where("id","=",$id[$i])->update($array);
				}
				$i++;
			}
			return Redirect::to("admin/facturas");
		}
		
		
			// definimos un tiempo predeterminado
		$time = new Carbon\Carbon;
		$array = DB::table('facturas')->where("mes", "=" ,Input::get('mes',$time->month)) 
		->where("año","=",Input::get('año', $time->year))
		->get();
		
		$personas_opt= User::lists('nombre','id');
		return View::make('admin.generadordefacturas')
		->withArray($array)
		->withPersonas($personas_opt)
		->with('año',Input::get('año',$time->year))
		->withMes(Input::get('mes',$time->month));
	}
	public function eliminarconcepto($id)
	{
		DB::table("facturas")->where("id","=",$id)->delete();
		return 	Redirect::to(url("admin/facturas"))->withInput(Input::flashOnly('mes', 'año'));
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
			$validator = Validator::make(Input::all(), array('file'=> 'mimes:jpeg,bmp,png,gif|max:10240'));
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
}
