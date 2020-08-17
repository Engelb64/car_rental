<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\RentalDate;
use App\User;
use Illuminate\Http\Request;

class RentalDateController extends Controller
{
    /**
     * Retorna Calendario con Rentas especificando los parametros.
     *
     * @GET RentalDate
     *
     */
    public function all(Request $request)
    {
        $retalDates = null;

        $events = null;

        $brands = Brand::all();

        $cars = null;

        if ($request->model) {
            $cars = Car::where('model_id', $request->model)->get();
        }

        if ($request->car_id) {
            $retalDates = RentalDate::where('car_id', $request->car_id)->get();
            foreach ($retalDates as $i => $retalDate) {
                $user = User::find($retalDate->user_id);
                $event = new \StdClass();
                $event->title = $user->name;
                $event->start = $retalDate->departure_date;
                $event->end = $retalDate->admission_date;
                $events[$i] = $event;
            }
        }

        return view('admin.calendar')->with([
            'eventos' => $events,
            'brands' => $brands,
            'cars' => $cars
        ]);
    }
}
