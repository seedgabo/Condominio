<?php	

class EncuestasTableSeeder extends Seeder {

	public function run()
	{
		$fecha =Carbon\Carbon::now();
		$faker = Faker\Factory::create('es_VE');
		DB::table('encuestas')->delete();
		Encuestas::create(array('id'=> '1' ,'nombre' => 'Sistema Web', 'pregunta' => '¿Como Calificarias El Nuevo Sistema Web De Tu Condominio?', 'respuesta1' => 'Excelente', 'respuesta2' => 'Bueno', 'respuesta3' => 'Regular' , 'respuesta4' => 'Malo', 'respuesta5' =>'Pésimo', 'respuesta6' => 'No lo sé'));
		Encuestas::create(array('id'=> '2' ,'nombre' => 'Nuevas Inversiones', 'pregunta' => '¿Que opinas de las nuevas inversiones tomadas?', 'respuesta1' => 'Excelente', 'respuesta2' => 'Bueno', 'respuesta3' => 'Regular' , 'respuesta4' => 'Malo', 'respuesta5' =>'Pésimo', 'respuesta6' => 'No lo sé'));

		DB::table('encuestas_respuestas')->delete();
		for ($i=1; $i <100 ; $i++) { 
			EncuestasRespuestas::create(array('encuesta_id' => 1 , 'persona_id' => $i,'respuesta' => $faker->biasedNumberBetween($min = 1, $max = 6, $function = 'Faker\Provider\Biased::linearLow'), 'comentarios' => 'Los comentarios son importantes!' ));
		}
		for ($i=1; $i <100 ; $i++) { 
			EncuestasRespuestas::create(array('encuesta_id' => 2 , 'persona_id' => $i,'respuesta' => $faker->biasedNumberBetween($min = 1, $max = 6, $function = 'Faker\Provider\Biased::linearLow'), 'comentarios' => 'Los comentarios son importantes!' ));
		}


	$this->command->info('Encuestas Table Seed!');
	}

}
