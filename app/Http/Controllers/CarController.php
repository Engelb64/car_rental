<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\Exports\CarsExport;
use App\Exports\RentalsExport;
use App\RentalDate;
use App\ModelCar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Retorna Vista con la lista de Vehículos registrados.
     *
     * @GET Car
     *
     */
    public function all(Request $request)
    {
        if ($request->find) {
            $cars = Car::where("registration", "LIKE", "%{$request->find}%")
                ->orWhere("price", "LIKE", "%{$request->find}%")
                ->orWhere("year", "LIKE", "%{$request->find}%")
                ->get();
        } else {
            $cars = Car::all();
        }

        foreach ($cars as $car) {
            $car->ModelAndBrand();
        }

        $brands = Brand::all();

        return view('admin.carlist')->with([
            'cars' => $cars,
            'brands' => $brands
        ]);
    }

    /**
     * Permite crear un <Car> con los parametros especificados.
     *
     * @POST Car
     *
     * @param registration Matricula
     * @param color Color del vehículo
     * @param year Año del Vehiculo
     * @param price Precio del Vehículo
     * @param model_id Id del modelo
     */
    public function create(Request $request)
    {
        // $this->validate($request, [
        //     'registration' => 'required',
        //     'color' => 'required',
        //     'year' => 'required',
        //     'price' => 'required',
        //     'model_id' => 'required'
        // ]);

        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }

        $car = new  Car();
        $car->registration = $request->registration;
        $car->color = $request->color;
        $car->year = $request->year;
        $car->description = $request->description;
        $car->price = $request->price;
        $car->model_id = $request->model;
        $car->picture_url = '/storage/' . $filePath;

        $car->save();

        return redirect('Car');
    }

    /**
     * Permite ver un <Car> en base al Id.
     *
     * @GET Car/[id]
     *
     * @param id id del carro
     */
    public function read($id)
    {
        $car = Car::find($id);
        $car->ModelAndBrand();

        $rentaldates = RentalDate::where('car_id', $id)->get();

        foreach ($rentaldates as $rentaldate) {
            $rentaldate->withUserData();
        }

        $brands = Brand::where("name", '!=', $car->brandname)->get();

        return view('admin.cardetails', [
            'car' => $car,
            'brands' => $brands,
            'rentaldates' => $rentaldates,
        ]);
    }

    /**
     * Permite actializar un <Car> en base al Id.
     *
     * @PUT Car/[id]
     *
     * @param id id del carro
     * @param registration Matricula
     * @param color Color del vehículo
     * @param year Año del Vehiculo
     * @param price Precio del Vehículo
     * @param model_id Id del modelo
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'registration' => 'required|max:45',
        //     'color' => 'required|max:8',
        //     'year' => 'required|max:5',
        //     'price' => 'required|max:45',
        //     'model_id' => 'required'
        // ]);

        $car = Car::find($id);
        $car->registration = $request->registration;
        $car->color = $request->color;
        $car->year = $request->year;
        $car->description = $request->description;
        $car->price = $request->price;
        $car->model_id = $request->model;
        $car->save();

        return redirect('Car/' . $id);
    }

    /**
     * Permite Eliminar un <Car> en base al Id.
     *
     * @DELETE Car/[id]
     *
     * @param id id del carro
     */
    public function delete($id)
    {
        $car = Car::find($id);
        $car->delete();

        return redirect('Car');
    }

    /**
     * Retorna Objeto con los modelos de una marca
     *
     * @GET Models
     *
     * @param brand_id Id de la Marca
     */
    public function Models(Request $request)
    {
        $models = ModelCar::where('brand_id', $request->brand_id)->get();

        return json_encode($models);
    }

    /**
     * Retorna vista con los <Cars> Disponibles.
     *
     * @GET /
     *
     */
    public function carsAvailable(Request $request)
    {
        $cars = Car::all();

        foreach ($cars as $car) {
            $car->ModelAndBrand();
        }

        return view('landing.index')->with([
            'cars' => $cars,
        ]);
    }

    /**
     * Retorna vista de Detalle del Carro en el Landing
     *
     * @GET details/[id]
     *
     * @param id id del carro
     */
    public function CarDetails(Request $request, $id)
    {
        $car = Car::find($id);
        $car->ModelAndBrand();

        $priceanddates = null;

        if ($request->startdate && $request->enddate) {
            $days = Carbon::parse($request->startdate)->diffInDays(Carbon::parse($request->enddate));
            $priceanddates = new stdClass;
            $priceanddates->totalprice = $days * $car->price;
            $priceanddates->startdate = $request->startdate;
            $priceanddates->enddate = $request->enddate;
        }

        return view('landing.details', [
            'car' => $car,
            'priceanddates' =>  $priceanddates,
        ]);
    }

    /**
     * Crea un registro de Renta de Vehiculo.
     *
     * @POST details/[id]
     *
     * @param payment Metodo de Pago
     * @param car_id Id del Vehiculo
     * @param departure_date Fecha de Salida del Vehiculo
     * @param admission_date Fecha de Regreso del Vehiculo
     * @param user_id Id del Usuario
     */
    public function RentCar(Request $request)
    {
        $this->validate($request, [
            'payment' => 'required|max:45',
            'car_id' => 'required',
            'departure_date' => 'required',
            'admission_date' => 'required'
        ]);

        $rental = new RentalDate();
        $rental->payment = $request->payment;
        $rental->car_id = $request->car_id;
        $rental->departure_date = Carbon::parse($request->departure_date);
        $rental->admission_date = Carbon::parse($request->admission_date);
        $rental->user_id = Auth()->user()->id;
        $rental->save();

        return redirect('RentaExitosa');
    }

    /**
     * Retorna la Vista de Reportes
     *
     * @GET car_rental.test/[id]
     *
     * @param carreport Boolean que saca reporte de los vehiculos registrados
     * @param datarange Rango de Fechas para reporte de Rentas
     */
    public function Reports(Request $request)
    {
        if ($request->datarange) {
            $request->datarange;
            $fechas = (explode("-", $request->datarange));
            $rangedates = new stdClass;
            $rangedates->from  = Carbon::parse($fechas[0]);
            $rangedates->to  = Carbon::parse($fechas[1]);

            return Excel::download(new RentalsExport($rangedates), 'rentals.csv');
        }
        if ($request->carreport == true) {
            return Excel::download(new CarsExport, 'cars.csv');
        }

        return view('admin.reports');
    }
}
