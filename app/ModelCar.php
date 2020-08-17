<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_id',
    ];


    /**
     * Get the chanllenge that owns the extended challenge.
     */
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
