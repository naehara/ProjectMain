<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function dashboard()
    {
        return view('lecturer.dashboard');
    }

    public function updateAvailability(Request $request)
    {
        $request->validate([
            'day'       => 'required|string',
            'status'    => 'required|string',
            'time_slot' => 'required|string',
        ]);

        $user = Auth::user();
        $formattedTime = ucfirst($request->status) . ' (' . $request->time_slot . ')';

        DB::table('lect_availabilty')->updateOrInsert(
            ['staff_id' => $user->username ?? $user->id],
            [
                'staff_id' => $user->username ?? $user->id,
                'Name'     => $user->name ?? 'Lecturer',
                'Day'      => $request->day,
                'status'   => $request->status, // simpan status berasingan
                'Time'     => $request->time_slot,
            ]
        );

        return redirect()->back()->with('success', 'Tetapan slot & masa berjaya dikemaskini ke pangkalan data!');
    }

    public function schedule()
    {
        return view('lecturer.schedule');
    }

    public function profile()
    {
        return view('lecturer.profile');
    }

    public function availability()
    {
        return view('lecturer.availability');
    }

    public function timetable()
    {
        return view('lecturer.timetable');
    }
}