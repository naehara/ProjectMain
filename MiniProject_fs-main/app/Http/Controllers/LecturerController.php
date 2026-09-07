<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    // Papar Lecturer Dashboard
    public function dashboard()
    {
        $lecturerId = Auth::id();

        // Tarik jadual khusus untuk lecturer yang tengah login (jika ada Model Timetable)
        // $myTimetables = Timetable::where('lecturer_id', $lecturerId)->get();

        return view('lecturer.dashboard');
    }

    // Function untuk kemaskini Working Days & Availability Slots
    public function updateAvailability(Request $request)
    {
        $request->validate([
            'working_days'  => 'required|array',
            'course_taught' => 'required|string',
        ]);

        $user = Auth::user();

        // Kemaskini atau cipta rekod dalam jadual lecturers
        \App\Models\Lecturer::updateOrCreate(
            ['email' => $user->email], // Cari mengikut user log masuk
            [
                'staff_id' => $user->username ?? $user->id,
                'name'     => $user->name ?? 'Lecturer Name',
                'day' => json_encode($request->working_days),
                'course'       => $request->course_taught,
            ]
        );

        return redirect()->back()->with('success', 'Slot masa & hari bekerja berjaya dikemaskini!');
    }
}