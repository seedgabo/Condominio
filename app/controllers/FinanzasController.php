<?php

class FinanzasController extends \BaseController {

	public function facturas()
	{

		if(Request::isMethod("post"))
		{
			$i=0;
			$monto = Input::get("monto");
			$id= Input::get('id');
			$porcentual= Input::get('porcentual');
			foreach (Input::get('nombre') as $key => $value)
			{
				$elemento =	Facturas:: find($id[$i]);
				$array = array('mes' => Input::get("mes"),
					'año' => Input::get("año"),
					'concepto'=> $value,
					'monto' => $monto[$i],
					'porcentual' => $porcentual[$i] );
				if($elemento ===null)
				{
					Facturas::create($array);
				}
				else
				{
					Facturas:: where("id","=",$id[$i])->update($array);
				}
				$i++;
			}
			return Redirect::to(URL::previous());
		}


		// definimos un tiempo predeterminado
		$time = new Carbon;
		$array = Facturas::where("mes", "=" ,Input::get('mes', $time->month))
		->where("año","=",Input::get('año', $time->year))
		->whereNull('residencia_id')
		->get();

		$personas_opt= User::lists('nombre','id');
		return View::make('admin.generadordefacturas')
		->withArray($array)
		->withPersonas($personas_opt)
		->with('año',Input::get('año',$time->year))
		->withMes(Input::get('mes',$time->month));
	}

	public function facturasPorResidencia()
	{

		if(Request::isMethod("post"))
		{
			$i=0;
			$residencia_id  =  Input::get('residencia_id',null);
			$monto = Input::get("monto");
			$id= Input::get('id');
			foreach (Input::get('nombre') as $key => $value)
			{
				$elemento =	Facturas:: find($id[$i]);
				$array = array('mes' => Input::get("mes"),
					'año' => Input::get("año"),
					'concepto'=> $value,
					'monto' => $monto[$i],
					'residencia_id' => $residencia_id[$i] );
				if($elemento ===null)
				{
					Facturas:: create($array);
				}
				else
				{
					Facturas:: where("id","=",$id[$i])->update($array);
				}
				$i++;
			}
			return Redirect::to(URL::previous());
		}


		// definimos un tiempo predeterminado
		$time = new Carbon;
		$array = Facturas::where("mes", "=" ,Input::get('mes', $time->month))
		->where("año","=",Input::get('año', $time->year))
		->where(function($query){
				if (Input::get('residencia_id') != '')
					$query->wherein("residencia_id",Input::get('residencia_id'));
			})
		->whereNotNull('residencia_id')
		->get();

		$personas_opt= User::lists('nombre','id');
		return View::make('admin.generadordefacturasporresidencia')
		->withArray($array)
		->withPersonas($personas_opt)
		->with('año',Input::get('año',$time->year))
		->withMes(Input::get('mes',$time->month))
		->withResidencia_id(Input::get('residencia_id',null));
	}

	public function cuotasMasivas()
	{
		$time = new Carbon;
		$mes = Input::get('mes', $time->month);
		$año = Input::get('año', $time->year);
		if (Request::isMethod("POST"))
		{
			foreach (Input::get('residencia_id') as $key => $residencia_id)
			{
				$array = ["residencia_id" => $residencia_id] + Input::only('mes','año','concepto','monto');
				$cambios[] =Facturas::firstorCreate($array);
			}
			return Redirect::to(URL::previous());
		}

		$conceptosMasivos = Facturas::selectRaw("concepto, monto,concat(mes,'/',año) as periodo , count(*) as cuenta")
			->groupby("concepto")
			->having('cuenta','>',1)
			->whereNotNull("residencia_id")
			->get();


		return View::make('admin/cuotasMasivas')->withConceptosmasivos($conceptosMasivos)->withMes($mes)->withAño($año);
	}

	public function parametros()
	{
	   $maestra =  json_decode(File::get(app_path("config/maestra.php")),true);

	   if(Request::method()== "POST")
	   {
     		$maestra["is_fondo"] = Input::get('is_fondo', false);
     		$maestra["fondo_%"] = Input::get('fondo_%', 14);
	   }
     File::put(app_path("config/maestra.php"), json_encode($maestra));

     return View::make('admin/parametros')->withMaestra($maestra);
	}

	public function  gestionResidencias()
	{
		if (Input::has('residencia'))
		{
			$residencias = Residencias::where("nombre",'LIKE','%'.Input::get('residencia').'%')->distinct()->orderby("id")->paginate(12);
		}
		else
		{
			$residencias = Residencias::distinct()->orderby("id")->paginate(Input::get('per_page', 12));
		}
		return View::make('admin/gestionResidencias',compact('residencias'));
	}

	public function cargarCobros()
	{
		$mes = Input::get('mes');
		$año = Input::get('año');
		foreach (Residencias::all() as $residencia)
		{
			$solvencia = Solvencia::firstorNew(['mes' => $mes, 'año' => $año, 'residencia_id' => $residencia->id]);
			$solvencia->estado = 3;
			$solvencia->monto = getdeuda($residencia->id,$mes,$año);
			$solvencia->save();
		}
		Notificacion::InsertarNotificacionesMasivas("Nuevo Recibo Agregado", "Se ha agregado el recibo de " . getMeses()[$mes] .  $año);
		Session::flash('success', "Cobros cargados Correctamente");
		if (Config::get('var.push',false)){

            $dispositivos = Dispositivo::active()->mensajes()->get();
            $disp = [];

            foreach ($dispositivos as $dispositivo) {
                $disp[]= PushNotification::Device($dispositivo->token);
            }
            $devices = PushNotification::DeviceCollection($disp);
            $message = PushNotification::Message("Se ha agregado el recibo de " . getMeses()[$mes] .  $año,[
                'badge' => 1,
                'image' => 'www/logo.png',
                'soundname' => 'alert',
                "ledColor" => [0, 146, 234, 255],
                'title' => 'Nueva Recibo Agregado',
            ]);
            $collection = PushNotification::app('android')
            ->to($devices)
            ->send($message);
        }
		return Redirect::to('admin/Finanzas/gestion?mes='.$mes. '&año='.$año);
	}

	public function generarResumendeCobrosMes()
	{
	   $i= 0;
	   $time = New Carbon();
	   $mes = Input::get("mes", $time->month);
	   $año = Input::get("año", $time->year);
	   $residencias = Residencias::get();
	    foreach ($residencias as $residencia) {
	        $deudas[$i]['monto'] = getdeuda($residencia->id, $time->month, $time->year);
	        $deudas[$i]['residencia'] = $residencia;
			$i++;
		}
	   $html = View::make('pdf/estadoFacturasMes')->withDeudas($deudas)->withMes($mes)->withAño($año);
	   header('Content-Type : application/pdf');
		 $headers = array('Content-Type' => 'application/pdf');
		 return Response::make(PDF::load($html, 'A4', 'portrait')->show('Resumen de Cobros ' . $mes . "/" .$año), 200, $headers);
	}

	public function eliminarconcepto($id)
	{
		Facturas::where("id","=",$id)->delete();
		return  Redirect::back();
	}

	public function eliminarconceptomasivo($concepto)
	{
		$cantidad = Facturas::where("concepto","=",$concepto)->delete();
		return  Redirect::back();
	}

}
