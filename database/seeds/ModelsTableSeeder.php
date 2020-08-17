<?php

use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Models = [
            [
                'brand_id' => 1,
                'name' => 'Kwid'
            ],
            [
                'brand_id' => 2,
                'name' => 'Mazda 6'
            ],
            [
                'brand_id' => 3,
                'name' => 'Picanto'
            ],
            [
                'brand_id' => 3,
                'name' => 'Rio'
            ],
            [
                'brand_id' => 3,
                'name' => 'Tonic'
            ],
        ];

        foreach ($Models as $Model) {
            DB::table('Models')->insert($Model);
        }
    }
}
