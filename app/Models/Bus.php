<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'available_seats' , 'vehicle_no'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
