<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.training_rooms.index', compact('rooms'));
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

    public function showRooms(){

    }

    public function showBooking(){

    }
}
