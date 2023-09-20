<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['departure_time', 'arrival_time', 'bus_id'];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime'
    ];


    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }


    public function stations()
    {
        return $this->belongsToMany(Station::class);
    }

    public function getArrivalStation()
    {
        return $this->stations()->last();
    }
}
