<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Retorna Vista con la lista de Marcas registradas.
     *
     * @GET Brand
     *
     */
    public function all(Request $request)
    {
        $brands = Brand::all();

        return view('admin.addnewbrand')->with([
            'brands' => $brands
        ]);
    }

    /**
     * Permite crear un <Brand> los parametros especificados.
     *
     * @POST Brand
     *
     * @param brand_name Nombre de la marca
     */
    public function create(Request $request)
    {
        $request->validate([
            'brand_name' => ['required']
        ]);

        if (!Brand::where('name', $request->brand_name)->first()) {
            $brand = new Brand();
            $brand->name = $request->brand_name;
            $brand->save();
        }

        return redirect('Brand');
    }

    /**
     * Permite eliminar un <Brand> en base al id.
     *
     * @DELETE Brand
     *
     * @param id Id del la Marca a eliminar
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect('Brand');
    }
}
