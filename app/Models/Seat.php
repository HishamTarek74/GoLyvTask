<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_no',
        'is_available',
        'bus_id',
        'start_station_id',
        'end_station_id'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function start_station()
    {
        return $this->belongsTo(Station::class , 'start_station_id');
    }

    public function end_station()
    {
        return $this->belongsTo(Station::class , 'end_station_id');
    }
}
