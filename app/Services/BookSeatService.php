<?php

namespace App\Services;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Seat;

class BookSeatService
{
    public function bookSeat($seatId, $tripId, $userId)
    {
        //check the seat is available
        if (!$this->checkSeatIsAvailable($seatId)) {
            return response()->json(['error' => 'Seat is Not Available'], 400);
        }

        $this->updateSeatAvailability($seatId);

        return $this->createBooking($seatId, $tripId, $userId);

    }

    private function checkSeatIsAvailable($seatId): bool
    {
        if (Seat::findOrFail($seatId)->is_available === true) {
            return true;
        }
        return false;
    }

    private function updateSeatAvailability($seatId)
    {
        $seat = Seat::findOrFail($seatId);

        $seat->update([
            'is_available' => false
        ]);
    }

    private function createBooking($seatId, $tripId, $userId)
    {
        $booking =  Booking::create([
            'seat_id' => $seatId,
            'trip_id' => $tripId,
            'user_id' => $userId
        ]);

        return new BookingResource($booking);
    }

}
