<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $booking = Booking::all();
        return view('user.index', compact('rooms', 'booking'));
    }

    public function showRooms()
    {
        $rooms = Room::all();
        return view('user.show_rooms', compact('rooms'));
    }

    public function createBooking()
    {
        $rooms = Room::all();
        return view('user.booking.create', compact('rooms'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'room_id' => ['required'],
            'booking_name' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        Booking::create($request->all());

        return redirect()->route('user.index')->with('success', 'Booking Created');
    }

    public function showBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.booking_show', compact('booking'));
    }

    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.booking_edit', compact('booking'));
    }

    public function updateRooms(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'room_id' => ['required'],
            'booking_name' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);
        Booking::updated($request->all());

        return redirect()->route('user.booking_show')->with('success', 'Booking Created');
    }

    public function deteleBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('user.booking.show')
            ->with('success', 'Booking deleted successfully.');
    }
}
