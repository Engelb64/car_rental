<?php

namespace App\Http\Controllers;

use App\Brand;
use App\ModelCar;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Retorna Vista con la lista de Modelos registradas.
     *
     * @GET Model
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
     * Permite crear un <Model> los parametros especificados.
     *
     * @POST Model
     *
     * @param model_name Nombre de la modelo
     * @param brand_id   Id de la marca
     */
    public function create(Request $request)
    {
        $request->validate([
            'model_name' => ['required'],
            'brand_id' => ['required']
        ]);

        $model = new ModelCar();
        $model->name = $request->model_name;
        $model->brand_id = $request->brand_id;
        $model->save();

        return redirect('Model');
    }

    /**
     * Permite eliminar un <Model> en base al id.
     *
     * @DELETE Model/[$id]
     *
     * @param id Id del la Modelo a eliminar
     */
    public function delete($id)
    {
        $brand = ModelCar::find($id);
        $brand->delete();

        return redirect('Model');
    }
}
