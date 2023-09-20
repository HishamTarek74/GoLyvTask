<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetAvailableSeatRequest;
use App\Http\Resources\SeatResource;
use App\Models\Seat;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function getAvailableSeats(GetAvailableSeatRequest $request)
    {
        $availableSeats = Seat::getAvailableSeats($request->start_station_id, $request->end_station_id);

        return SeatResource::collection($availableSeats);
    }
}
