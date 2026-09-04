<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    // Display Lecturer Dashboard
    public function dashboard()
    {
        $lecturerId = Auth::id();

        // Tarik jadual khusus untuk lecturer yang tengah login
        // $myTimetables = Timetable::where('lecturer_id', $lecturerId)->get();

        return view('lecturer.dashboard');
    }

    // Function untuk kemaskini Working Days & Availability Slots (Update)
    public function updateAvailability(Request $request)
    {
        $request->validate([
            'working_days' => 'required|array',
            'course_taught'=> 'required|string',
        ]);

        // Simpan atau kemaskini data availability lecturer dalam DB
        // LecturerDetail::updateOrCreate(['user_id' => Auth::id()], [...]);

        return redirect()->back()->with('success', 'Slot masa & hari bekerja berjaya dikemaskini!');
    }
}