<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RepeatStudent;
use App\Models\Course;
use App\Models\AcademicSession;
//use App\Models\Timetable; // Uncomment kalau dah ada model timetable

class StudentController extends Controller
{
    // 1. Papar Student Dashboard
    public function dashboard()
    {
        $student = Auth::user();
        
        $courses = Course::all();
        $sessions = AcademicSession::all();

        // Kira jumlah kursus ulangan student ni
        $repeatCount = RepeatStudent::where('student_name', $student->name)->count();

        return view('student_repeat.dashboard', compact('student', 'courses', 'sessions', 'repeatCount'));
    }

    // 2. Papar My Profile
    public function profile()
    {
        $student = Auth::user();
        return view('student_repeat.profile', compact('student'));
    }

    // 3. Kemaskini My Profile
    public function updateProfile(Request $request)
    {
        $student = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $student->id,
            'email'    => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|min:6',
        ]);

        $student->name = $request->name;
        $student->username = $request->username;
        $student->email = $request->email;

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('student.profile')->with('success', 'Profil berjaya dikemaskini!');
    }

    // 4. Papar My Timetable (Tarik terus dari folder public/upload)
    public function timetable()
    {
        $student = Auth::user();
        
        // Cari fail dalam folder public/upload yang bermula dengan ID student ni
        $uploadsPath = public_path('upload');
        $timetableFile = null;

        if (is_dir($uploadsPath)) {
            $files = scandir($uploadsPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    // Semak jika nama fail bermula dengan id student ini
                    if (str_starts_with($file, $student->id . '_')) {
                        $timetableFile = 'upload/' . $file;
                        break;
                    }
                }
            }
        }

        return view('student_repeat.timetable', compact('student', 'timetableFile'));
    }

    // 5. Simpan Timetable (Terus upload ke folder public/upload)
    public function storeTimetable(Request $request)
    {
        $request->validate([
            'timetable_file' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $student = Auth::user();

        if ($request->hasFile('timetable_file')) {
            $file = $request->file('timetable_file');
            
            // Format nama fail: [student_id]_[timestamp]_[nama_asal_fail]
            $filename = $student->id . '_' . time() . '_' . $file->getClientOriginalName();
            
            // Guna folder 'upload' selaras dengan folder fizikal korang
            $uploadsPath = public_path('upload');
            
            // Pastikan folder 'upload' wujud secara fizikal
            if (!is_dir($uploadsPath)) {
                mkdir($uploadsPath, 0755, true);
            }

            // Padam dulu fail lama student ni kalau ada supaya tak bertindih
            $files = scandir($uploadsPath);
            foreach ($files as $fileInDir) {
                if ($fileInDir !== '.' && $fileInDir !== '..') {
                    if (str_starts_with($fileInDir, $student->id . '_')) {
                        @unlink($uploadsPath . '/' . $fileInDir);
                    }
                }
            }

            // Simpan fail baru ke folder public/upload fizikal
            $file->move($uploadsPath, $filename);
        }

        return redirect()->route('student.timetable')->with('success', 'Jadual waktu berjaya dimuat naik!');
    }

    // 6. Fungsi Borang Repeat Kursus
    public function showRepeatForm()
    {
        $courses = Course::all();
        $sessions = AcademicSession::all();

        return view('student_repeat.repeat_form', compact('courses', 'sessions'));
    }

    public function submitRepeatForm(Request $request)
    {
        $request->validate([
            'student_matric'      => 'required',
            'student_name'        => 'required',
            'course_id'           => 'required|exists:courses,id',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'reason'              => 'required',
        ]);

        RepeatStudent::create([
            'student_matric'      => $request->student_matric,
            'student_name'        => $request->student_name,
            'course_id'           => $request->course_id,
            'academic_session_id' => $request->academic_session_id,
            'reason'              => $request->reason,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Borang permohonan mengulang kursus berjaya dihantar!');
    }

    // 7. Jadual Lama (Schedule)
    public function schedule()
    {
        return view('student_repeat.schedule');
    }
}