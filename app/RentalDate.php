<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalDate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rental_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'departure_date',
        'admission_date',
        'payment',
        'user_id',
        'car_id'
    ];

    /**
     * Get the info User.
     */
    public function withUserData()
    {
        return  $this->user = User::find($this->user_id);
    }

    /**
     * Get the info user and car.
     */
    public function withCarData()
    {
        return  $this->car =  Car::find($this->car_id);
    }
}
