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

		return View::make('admin/cuotasMasivas')->withConceptosmasivos($conceptosMasivos);
	}

	public function eliminarconcepto($id)
	{
		Facturas::where("id","=",$id)->delete();
		return  Redirect::to(url(URL::previous()));
	}

	public function eliminarconceptomasivo($concepto)
	{
		$cantidad = Facturas::where("concepto","=",$concepto)->delete();
		return  Redirect::to(url(URL::previous()));
	}

}
