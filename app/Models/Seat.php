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
//        'start_station_id',
//        'end_station_id'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

//    public function start_station()
//    {
//        return $this->belongsTo(Station::class , 'start_station_id');
//    }
//
//    public function end_station()
//    {
//        return $this->belongsTo(Station::class , 'end_station_id');
//    }

    public function scopeGetAvailableSeats($query, $startStationId, $endStationId)
    {
       // dd($startStationId);
        return $query->whereHas('bus.trips', function ($query) use ($startStationId, $endStationId) {
            $query->whereHas('stations', function ($query) use ($startStationId, $endStationId) {
                $query->where('station_id', $startStationId)
                    ->orWhere('station_id', $endStationId);
            });
        })->get();
    }
}
