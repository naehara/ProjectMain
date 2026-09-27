<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Lecturer;
use App\Models\RepeatStudent;
use App\Models\User;
use App\Models\Course;
use App\Models\AcademicSession;
use App\Models\Room;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display Admin Dashboard
    public function dashboard()
    {
        $totalTimetables = Timetable::count();
        $repeatStudentsCount = RepeatStudent::count(); 
        $activeLecturersCount = Lecturer::count(); 
        $emptyRoomsToday = 0;
        $totalRooms = 20;

        return view('admin.dashboard', compact(
            'totalTimetables',
            'repeatStudentsCount',
            'activeLecturersCount',
            'emptyRoomsToday',
            'totalRooms'
        ));
    }

    // Display Timetable Management Page
   public function timetables()
{
    // Eager load semua relationship
    $timetables = Timetable::with(['courses', 'repeatStudents', 'lecturer', 'rooms'])->get();

    $timetables     = Timetable::all();
    $lecturers      = Lecturer::all();
    $courses        = Course::all();
    $rooms          = Room::all(); // Mengambil data bilik
    $repeatStudents = RepeatStudent::all(); // Mengambil data pelajar repeat

    return view('admin.timetables', compact(
        'timetables', 
        'lecturers', 
        'courses', 
        'rooms', 
        'repeatStudents'
    ));
}

    // Display User Management Page
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }


    // Display Lecturers & Slots Page
    public function lecturers()
    {
        $lecturers = Lecturer::all();
        $availabilities = \DB::table('lect_availabilty')->get(); // Tarik slot ketersediaan

        return view('admin.lecturers', compact('lecturers', 'availabilities'));
    }

    public function storeLecturer(Request $request)
{
    $request->validate([
        'name'  => 'required',
        'email' => 'required|email',
    ]);

    Lecturer::create([
        'staff_id'  => $request->staff_id,
        'name'      => $request->name,
        'email'     => $request->email,
        'work_days' => $request->work_days,
    ]);

    return redirect()->back()->with('success', 'Pensyarah berjaya ditambah!');
}

public function lecturersAvailability()
{
    // Ambil semua data slot pensyarah dari table lect_availabilty
    $availabilities = \DB::table('lect_availabilty')->get();

    return view('admin.lecturers', compact('availabilities'));
}

public function updateLecturer(Request $request, $id)
{
    $lecturer = Lecturer::findOrFail($id);
    $lecturer->update([
        'name'      => $request->name,
        'email'     => $request->email,
        'work_days' => $request->work_days,
    ]);

    return redirect()->back()->with('success', 'Maklumat pensyarah berjaya dikemaskini!');
}

public function destroyLecturer($id)
{
    $lecturer = Lecturer::findOrFail($id);
    $lecturer->delete();

    return redirect()->back()->with('success', 'Pensyarah berjaya dipadam!');
}


    // Function untuk simpan Timetable baharu (Create)
    public function storeTimetable(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'nullable',
            'lecturer_id' => 'required',
            'course_id'   => 'required',
            'room_id'     => 'nullable',
            'session_id'  => 'required',
            'class_name'  => 'required|string',
            'day'         => 'required|string',
            'time_start'  => 'required',
            'time_end'    => 'required',
        ]);

        Timetable::create($validated);

        return redirect()->back()->with('success', 'Jadual waktu berjaya ditambah!');
    }

    // Function untuk padam Timetable (Delete)
    public function destroyTimetable($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();

        return redirect()->back()->with('success', 'Jadual waktu berjaya dipadam!');
    }


    public function editRepeat($id)
    {
        $repeat = RepeatStudent::findOrFail($id);
        $courses = Course::all();
        $sessions = AcademicSession::all();

        return view('admin.repeats_edit', compact('repeat', 'courses', 'sessions'));
    }


            public function storeUser(Request $request)
        {
            //dd($request->all());

            $request->validate([
                'name'     => 'required|string|max:255',
                'username' => 'required|string|unique:users,username',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role'     => 'required|in:admin,lecturer,student',
            ]);

            User::create([
                'name'     => $request->name,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            return redirect()->back()->with('success', 'Pengguna baharu berjaya ditambah!');
        }

        public function destroyUser($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'Pengguna berjaya dipadam!');
        }

        

         // Display Student Repeat Info Page
        public function repeats()
        {
            $repeatStudents = RepeatStudent::all();
            $courses = Course::all();

            return view('admin.repeats', compact('repeatStudents', 'courses' ));
        }

        public function storeRepeat(Request $request)
        {
            $request->validate([
                'student_matric' => 'required|string',
                'student_name'   => 'required|string',
                'course_id'      => 'required',
            ]);

            $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
            $academicSessionId = $activeSession ? $activeSession->id : 1;

            RepeatStudent::create([
                'student_matric' => $request->student_matric,
                'student_name'   => $request->student_name,
                'class'          => $request->class,
                'course_id'      => $request->course_id,
                'reason'         => $request->reason,
                'academic_session_id' => $academicSessionId,
            ]);

            return redirect()->back()->with('success', 'Pelajar repeat berjaya ditambah!');
        }

        
            // Proses Simpan Kemaskini Repeat Student
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
            
            public function destroyRepeat($id)
            {
                $student = RepeatStudent::findOrFail($id);
                $student->delete();

                return redirect()->back()->with('success', 'Rekod permohonan mengulang berjaya dipadam!');
            }



        public function rooms()
            {
                $rooms = Room::all();
                return view('admin.rooms', compact('rooms'));
            }

            public function storeRoom(Request $request)
            {
                $request->validate([
                    'room_name' => 'required',
                ]);

                Room::create([
                    'room_name' => $request->room_name,
                    'type'      => $request->type,
                    'capacity'  => $request->capacity,
                    'status'    => 'available',
                ]);

                return redirect()->back()->with('success', 'Bilik berjaya ditambah!');
            }

            public function updateRoom(Request $request, $id)
            {
                $room = Room::findOrFail($id);
                $room->update($request->all());

                return redirect()->back()->with('success', 'Maklumat bilik berjaya dikemaskini!');
            }

            public function destroyRoom($id)
            {
                $room = Room::findOrFail($id);
                $room->delete();

                return redirect()->back()->with('success', 'Bilik berjaya dipadam!');
            }


             public function courses()
            {
                // Ambil senarai pensyarah beserta kursus yang mereka ajar (menggunakan relasi Eloquent)
                $lecturers = User::where('role', 'lecturer')->with('courses')->get();
                $allCourses = Course::all();

                return view('admin.courses', compact('lecturers', 'allCourses'));
            }

            public function assignCoursesToLecturer(Request $request, $id)
            {
                $lecturer = User::findOrFail($id);
                
                // Simpan pilihan checkbox kursus ke dalam table pivot (pastikan ada table pivot seperti lecturer_course)
                $lecturer->courses()->sync($request->input('course_ids', []));

                return redirect()->back()->with('success', 'Kursus berjaya dikaitkan dengan pensyarah!');
            }

                public function storeCourse(Request $request)
            {
                $request->validate([
                    'course_code' => 'required',
                    'course_name' => 'required',
                ]);

                Course::create([
                    'course_code' => $request->course_code,
                    'course_name' => $request->course_name,
                    'credit_hours' => $request->credits ?? 3,
                    
                ]);

                return redirect()->back()->with('success', 'Kursus berjaya ditambah!');
            }

           public function globalSearch(Request $request)
        {
            if ($request->ajax()) {
                $keyword = $request->get('query');

                if (empty(trim($keyword))) {
                    return response()->json(['html' => '']);
                }

                // 1. Cari Student Repeat
                data_get(null, ''); // placeholder
                $repeats = \App\Models\RepeatStudent::where('student_name', 'LIKE', "%{$keyword}%")
                            ->orWhere('student_matric', 'LIKE', "%{$keyword}%")
                            ->limit(3)->get();

                // 2. Cari Lecturers/Users
                $users = \App\Models\User::where('name', 'LIKE', "%{$keyword}%")
                            ->orWhere('email', 'LIKE', "%{$keyword}%")
                            ->limit(3)->get();

                // 3. Cari Courses
                $courses = \App\Models\Course::where('course_code', 'LIKE', "%{$keyword}%")
                            ->orWhere('course_name', 'LIKE', "%{$keyword}%")
                            ->limit(3)->get();

                return response()->json([
                    'repeats' => $repeats,
                    'users' => $users,
                    'courses' => $courses,
                ]);
            }
        }
}