<?php

namespace App\Exports;

use App\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class CarsExport implements FromView
{

    public function view(): View
    {
        $cars = Car::all();

        foreach ($cars as $car) {
            $car->ModelAndBrand();
        }

        return view('admin.exports.cars', [
            'cars' => $cars
        ]);
    }
}
