<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RepeatStudent;
use App\Models\Course;
use App\Models\AcademicSession; // Import model berkaitan

class StudentController extends Controller
{
    // Display Student Dashboard
    public function dashboard()
    {
        $studentId = Auth::id();
        $courses = Course::all();
        $sessions = AcademicSession::all();

        // Tarik jadual repeat khusus untuk student yang tengah login
        // $myTimetable = Timetable::where('student_id', $studentId)->first();

        return view('student_repeat.dashboard', compact('courses', 'sessions'));
    }

    // Function untuk hantar borang subjek gagal/repeat
   public function submitRepeatForm(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'student_matric'      => 'required',
        'student_name'        => 'required',
        'course_id'           => 'required|exists:courses,id',
        'academic_session_id' => 'required|exists:academic_sessions,id',
        'reason'              => 'required',
    ]);

    // 2. Simpan Terus ke Pangkalan Data (Sebab $request->course_id sudah berisi ID nombor)
    RepeatStudent::create([
        'student_matric'      => $request->student_matric,
        'student_name'        => $request->student_name,
        'course_id'           => $request->course_id,
        'academic_session_id' => $request->academic_session_id,
        'reason'              => $request->reason,
    ]);

    // 3. Kembalikan Respon Kejayaan
    return redirect()->route('student.dashboard')->with('success', 'Borang permohonan mengulang kursus berjaya dihantar!');
}

    public function showRepeatForm()
    {
        $courses = Course::all();
        $sessions = AcademicSession::all();

        return view('student_repeat.repeat_form', compact('courses', 'sessions'));
    }
}