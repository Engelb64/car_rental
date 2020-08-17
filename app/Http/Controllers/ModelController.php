<?php

namespace App\Http\Controllers;

use App\Brand;
use App\ModelCar;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Permite ver todos los <Cars> registrados.
     *
     * @GET car_rental.test/api/v1/Car
     *
     */
    public function all(Request $request)
    {
        $brands = Brand::all();
        $models = ModelCar::all();

        return view('admin.addnewmodel', [
            'brands' => $brands,
            'models' => $models
        ]);
    }

    /**
     * Permite ver todos los <Cars> registrados.
     *
     * @GET car_rental.test/api/v1/Car
     *
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'model_name' => 'required|max:45',
        ]);

        if (!ModelCar::where('name', $request->model_name)->first()) {
            $model = new ModelCar();
            $model->name = $request->model_name;
            $model->brand_id = $request->brand_id;
            $model->save();

            return redirect('Model');
        }

        return redirect('Model');
    }

    /**
     * Permite ver todos los <Cars> registrados.
     *
     * @GET car_rental.test/api/v1/Car
     *
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect('Model');
    }
}
