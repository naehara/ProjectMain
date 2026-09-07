@extends('layouts.app')

@section('title', 'Student Repeat Info - Admin')
@section('header_title', 'Student Repeat Information')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.timetables') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-calendar-week"></i>
        <span>Timetable Mgmt</span>
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-users"></i>
        <span>User Management</span>
    </a>
    <a href="{{ route('admin.repeats') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Student Repeat Info</span>
    </a>
    <a href="{{ route('admin.lecturers') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Lecturers & Slots</span>
    </a>
    <a href="{{ route('admin.rooms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-door-open"></i>
        <span>Room Availability</span>
    </a>
    <a href="{{ route('admin.courses') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-book-bookmark"></i>
        <span>Courses & Session</span>
    </a>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Maklumat Pelajar Repeat</h2>
        <p class="text-gray-600 text-sm mb-4">Senarai pelajar yang mendaftar kursus mengulang beserta sebab kegagalan.</p>

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">No. Matrik</th>
                        <th class="p-3">Nama Pelajar</th>
                        <th class="p-3">Kelas / Kumpulan</th>
                        <th class="p-3">Kursus Mengulang</th>
                        <th class="p-3">Sebab Mengulang</th>
                        <th class="p-3 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($repeatStudents as $student)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-gray-700">{{ $student->student_matric ?? '-' }}</td>
                            <td class="p-3 font-semibold text-gray-900">{{ $student->student_name ?? '-' }}</td>
                            <td class="p-3 text-gray-600">{{ $student->class ?? '-' }}</td>

                            {{-- 4. Kursus (Panggil spesifik field course_code & course_name) --}}
                            <td class="p-3">
                                <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                    @if(is_object($student->course))
                                        {{ $student->course->course_code }} - {{ $student->course->course_name }}
                                    @else
                                        {{ $student->course_id ?? 'Tiada Kursus' }}
                                    @endif
                                </span>
                            </td>

                            <td class="p-3 text-gray-600">{{ $student->reason ?? '-' }}</td>

                            <!-- Butang Action (Edit & Delete) -->
                            <td class="p-3 text-center space-x-2">
                                <!-- Butang Edit -->
                                <a href="{{ route('admin.repeats.edit', $student->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </a>

                                <!-- Form Delete -->
                                <form action="{{ route('admin.repeats.destroy', $student->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Adakah anda pasti ingin memadam rekod ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-md transition">
                                        <i class="fa-solid fa-trash-can mr-1"></i> Padam
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Tiada rekod pelajar mengulang dijumpai dalam pangkalan data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection