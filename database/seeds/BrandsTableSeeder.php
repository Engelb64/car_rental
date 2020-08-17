<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'Renault'
            ],
            [
                'name' => 'Mazda'
            ],
            [
                'name' => 'Kia'
            ],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }
    }
}
