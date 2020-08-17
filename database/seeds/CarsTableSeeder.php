<?php

use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'registration' => 'KSDF85',
                'color' => '#000000',
                'year' => '2021',
                'description' => 'Motor 1000 c.c excelente rendimiento en consumo de combustible.',
                'price' => '300000',
                'model_id' => 1
            ],
            [
                'registration' => 'K23F85',
                'color' => '#111111',
                'year' => '2007',
                'description' => 'Versión 2.3 AT, cilindrada 2300 cc',
                'price' => '150000',
                'model_id' => 2
            ],
            [
                'registration' => 'K23F85',
                'color' => '#222222',
                'year' => '2020',
                'description' => 'FRENOS ABS , DOBLE AIRBAG , CENTRO DE ENTRETENIMIENTO FES DE 9" , CON BLUETOOTH , , COMPUTADOR A BORDO , ELEVA VIDRIOS DELANTEROS Y TRASEROS ',
                'price' => '200000',
                'model_id' => 3
            ],
        ];

        foreach ($cars as $car) {
            DB::table('cars')->insert($car);
        }
    }
}
