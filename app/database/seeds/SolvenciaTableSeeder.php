<?php


class SolvenciaTableSeeder extends Seeder {

	public function run()
	{
		$año = Carbon\Carbon::now()->year;
		foreach(range(1, 12) as $mes)
		{
			foreach (Residencias::get() as  $residencia) 
			{
				$solvencias[] = array('año' => $año, 'mes' => $mes, 'residencia_id'=> $residencia->id);
			}
		}
		Solvencia::insert($solvencias);
	}

}