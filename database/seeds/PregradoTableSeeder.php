<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Pregrado;
use App\Postgrado;
use App\Postulante;

class PregradoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 100; $i++)
        {
            $pregrado       = new Pregrado();
            $postgrado      = new Postgrado();
            $postulanteTemp = new Postulante();

            $idPregrado = $faker->unique->numberBetween($min = 1, $max = 100);

            $postgrado      = Postgrado::find($idPregrado);
            $postulanteTemp = Postulante::find($idPregrado);
            

            if ($postgrado === null) {
              $pregrado->postulante         = $idPregrado;
              $postulanteTemp->tipo_estudio = 'Pregrado';
              
              $postulanteTemp->save();
              $pregrado->save();
            }
        }

    }
}
