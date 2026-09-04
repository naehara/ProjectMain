<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display Admin Dashboard & List of Timetables
    public function dashboard()
    {
        // Dalam real project, korang boleh tarik data dari Database:
        // $timetables = Timetable::with(['student', 'lecturer', 'course', 'room', 'academicSession'])->get();
        
        return view('admin.dashboard');
    }

    // Function untuk simpan Timetable baharu (Create)
    public function storeTimetable(Request $request)
    {
        $request->validate([
            'student_id'  => 'required',
            'lecturer_id' => 'required',
            'course_id'   => 'required',
            'room_id'     => 'required',
            'session_id'  => 'required',
            'class_name'  => 'required|string',
            'day'         => 'required|string',
            'time_start'  => 'required',
            'time_end'    => 'required',
        ]);

        // Timetable::create($request->all());

        return redirect()->back()->with('success', 'Jadual waktu berjaya ditambah!');
    }

    // Function untuk padam Timetable (Delete)
    public function destroyTimetable($id)
    {
        // $timetable = Timetable::findOrFail($id);
        // $timetable->delete();

        return redirect()->back()->with('success', 'Jadual waktu berjaya dipadam!');
    }
}