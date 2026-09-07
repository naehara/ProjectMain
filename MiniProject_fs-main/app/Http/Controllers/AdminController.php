<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\RepeatStudent;
use App\Models\User;
use App\Models\Course;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display Admin Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Display Timetable Management Page
    public function timetables()
    {
        return view('admin.timetables');
    }

    // Display User Management Page
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Display Student Repeat Info Page
    public function repeats()
    {
        $repeatStudents = RepeatStudent::all();
        return view('admin.repeats', compact('repeatStudents'));
    }

    // Display Lecturers & Slots Page
    public function lecturers()
    {
        $lecturers = Lecturer::all();
        return view('admin.lecturers', compact('lecturers'));
    }

    // Display Room Availability Page
    public function rooms()
    {
        return view('admin.rooms');
    }

    // Display Courses & Sessions Page
    public function courses()
    {
        $lecturers = Lecturer::all();
        return view('admin.courses', compact('lecturers'));
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

    public function destroyRepeat($id)
    {
        $student = RepeatStudent::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Rekod permohonan mengulang berjaya dipadam!');
    }

    public function editRepeat($id)
    {
        $repeat = RepeatStudent::findOrFail($id);
        $courses = Course::all();
        $sessions = AcademicSession::all();

        return view('admin.repeats_edit', compact('repeat', 'courses', 'sessions'));
    }

    // Proses Simpan Kemaskini
    public function updateRepeat(Request $request, $id)
    {
        $request->validate([
            'student_matric'      => 'required',
            'student_name'        => 'required',
            'course_id'           => 'required',
            'academic_session_id' => 'required',
            'reason'              => 'required',
        ]);

        $repeat = RepeatStudent::findOrFail($id);
        $repeat->update([
            'student_matric'      => $request->student_matric,
            'student_name'        => $request->student_name,
            'course_id'           => $request->course_id,
            'academic_session_id' => $request->academic_session_id,
            'reason'              => $request->reason,
        ]);

        return redirect()->route('admin.repeats')->with('success', 'Maklumat pelajar mengulang berjaya dikemaskini!');
    }
}