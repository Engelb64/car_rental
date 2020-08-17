<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration',
        'color',
        'year',
        'description',
        'price',
        'model_id',
        'picture_url',
        'status'
    ];


    /**
     * Get the chanllenge that owns the extended challenge.
     */
    public function ModelAndBrand()
    {
        $model = ModelCar::find($this->model_id);
        $brand = Brand::find($model->brand_id);
        $this->modelname = $model->name;
        $this->brand_id = $brand->id;
        return $this->brandname = $brand->name;;
    }
}
