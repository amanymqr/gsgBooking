<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $booking = Booking::all();
        return view('admin.room.index', compact('rooms', 'booking'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('admin.room.create', compact('rooms'));
    }

    public function storeRoom(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
            'seats' => ['required'],
            'location' => ['required'],
            'working_days' => ['required'],
        ]);

        Auth::guard('admin')->Room()->create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'seats' => $request->input('seats'),
            'location' => $request->input('location'),
            'working_days' => $request->input('working_days'),

        ]);

        return redirect()->route('admin.index')->with('success', 'Room Created');
    }

    public function showRooms($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.room_index', compact('room'));
    }

    public function editRooms($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.room_edit', compact('room'));
    }

    public function updateRooms(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
            'seats' => ['required'],
            'location' => ['required'],
            'working_days' => ['required'],
        ]);

        Auth::guard('admin')->Room()->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'seats' => $request->input('seats'),
            'location' => $request->input('location'),
            'working_days' => $request->input('working_days'),

        ]);

        return redirect()->route('admin.room.show')->with('success', 'Room Updated.');
    }

    public function deteleRooms($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.room.show')
            ->with('success', 'Room deleted successfully.');
    }

    public function showBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking_show', compact('booking'));
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
