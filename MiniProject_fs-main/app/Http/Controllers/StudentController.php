<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Display Student Dashboard
    public function dashboard()
    {
        $studentId = Auth::id();

        // Tarik jadual repeat khusus untuk student yang tengah login
        // $myTimetable = Timetable::where('student_id', $studentId)->first();

        return view('student_repeat.dashboard');
    }

    // Function untuk hantar borang subjek gagal/repeat (Create/Update)
    public function submitRepeatForm(Request $request)
    {
        $request->validate([
            'student_matric'=> 'required|string',
            'student_name'       => 'required|string',
            'course_id'       => 'required|string',
            'academic_session_id'       => 'required|string',
            'created_at'       => 'required|string',
            'updated_at'       => 'required|string',
        ]);

        // Simpan maklumat borang repeat pelajar ke dalam DB
        // StudentRepeatInfo::create([...]);

        return redirect()->back()->with('success', 'Borang permohonan repeat berjaya dihantar!');
    }
}