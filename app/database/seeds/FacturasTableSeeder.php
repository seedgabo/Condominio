<?php	

class FacturasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('facturas')->delete();
		$año =Carbon\Carbon::now()->year;
		for ($i=1; $i <= 12; $i++) 
		{ 
			$facturas[] = (array('mes' =>''.$i, 'año' => $año ,'monto' => rand(100000,500000),'concepto' => 'Mantenimiento'));
			$facturas[] = (array('mes' =>''.$i, 'año' => $año ,'monto' => rand(100000,500000),'concepto' => 'Seguridad'));
			$facturas[] = (array('mes' =>''.$i, 'año' => $año ,'monto' => rand(100000,500000),'concepto' => 'Electricidad'));
			$facturas[] = (array('mes' =>''.$i, 'año' => $año ,'monto' => rand(100000,500000),'concepto' => 'Servicio de Agua'));
			$facturas[] = (array('mes' =>''.$i, 'año' => $año ,'monto' => rand(100000,500000),'concepto' => 'Gastos Generales'));
		}
		Facturas::insert($facturas);
		DB::table('recibos')->delete();
		Recibos::create(array('concepto'=>'Contrato con Sistema Web de Condominio Online','monto' => '0','persona_id'=>'0'));
	$this->command->info('Facturas Table Seed!');
	}

}
