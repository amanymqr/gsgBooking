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
        return view('user.index', compact('rooms'));
    }

    public function viewRooms()
    {
        $rooms = Room::all();
        return view('user.view_rooms', compact('rooms'));
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
        // Booking::create([
        //     'user_id' => Auth::guard('user')->id(),
        //     'room_id' => $request->input('room_id'),
        //     'booking_name' => $request->input('booking_name'),
        //     'start_time' => $request->input('start_time'),
        //     'end_time' => $request->input('end_time'),
        // ]);

        return redirect()->route('user.index')->with('success', 'Booking Created');
    }

}
