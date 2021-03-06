<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\DocumentoAdjunto;
use App\Postulante;
class DocumentoAdjuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $nombreArchivo = array('Formulario de Postulación',
                                'Homologación de cursos',
                                'Ficha de la asistente social',
                                'Confirmación LLegada',
                                'Datos de contacto',
                                'Modificación de la homologacioń de cursos',
                                'Inscripción de cursos',
                                'Formulario CINDA',
                                'Biblioteca');
        $samples_temp = [];

        
        for($i = 0; $i <40; $i++)
        {
            $samples_temp[] = [
                'nombre' => $nombreArchivo[$faker->numberBetween($min = 0, $max = 8)],
                'path'=> '/'. $faker->bothify('???????########') . 'pdf',
                'postulante'=>$faker->numberBetween($min = 1, $max = 100)
            ];
        }
        DocumentoAdjunto::insert($samples_temp);


    }
}
