<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $booking = Booking::all();
        return view('assistant.room.index', compact('rooms', 'booking'));
    }

    public function showRooms($id)
    {
        $room = Room::findOrFail($id);
        return view('assistant.room_index', compact('room'));
    }

    public function showBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('assistant.booking_show', compact('booking'));
    }

    public function acceptBooking(Booking $booking)
    {
        $booking->status = 'accept';
        $booking->save();

        return redirect()->back()
            ->with('success', 'Booking Accepted.');
    }

    public function denyBooking(Booking $booking)
    {
        $booking->status = 'deny';
        $booking->save();

        return redirect()->back()
            ->with('error', 'Booking Denied.');
    }
}
