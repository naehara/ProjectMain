@extends('layouts.app')

@section('title', 'Timetable Management - Admin')
@section('header_title', 'Timetable Management')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.timetables') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-calendar-week"></i>
        <span>Timetable Mgmt</span>
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-users"></i>
        <span>User Management</span>
    </a>
    <a href="{{ route('admin.repeats') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
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
<div x-data="{ openModal: false }">

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Penjadualan & Slot Waktu</h2>
            
            {{-- Button to Open Modal --}}
            <button @click="openModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i>Tambah Jadual
            </button>
        </div>

        {{-- Display Timetables Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">Kelas</th>
                        <th class="p-3">Kursus</th>
                        <th class="p-3">Nama Pelajar</th>
                        <th class="p-3">Nama Pensyarah</th>
                        <th class="p-3">Bilik</th>
                        <th class="p-3">Hari</th>
                        <th class="p-3">Masa</th>
                        <th class="p-3">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($timetables as $item)
                        <tr>
                            <td class="p-3 font-medium">{{ $item->class_name }}</td>
                            <td class="p-3">{{ $item->courses->course_name ?? $item->course_id }}</td>
                           <td class="p-3">{{ $item->repeatStudents->student_name ?? $item->repeatStudents->name ?? $item->student_id }}</td>
                            <td class="p-3">{{ $item->lecturer->name ?? $item->lect_id }}</td>
                            <td class="p-3">{{ $item->rooms->room_name ?? $item->room_id }}</td>
                            <td class="p-3">{{ $item->day }}</td>
                            <td class="p-3">{{ $item->time_start }} - {{ $item->time_end }}</td>
                            <td class="p-3">
                                <form action="{{ route('admin.timetables.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Padam jadual ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">Tiada rekod jadual waktu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL FORM --}}
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full p-6 space-y-4" @click.away="openModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Jadual Waktu Baharu</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form action="{{ route('admin.timetables.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    {{-- Nama Kelas --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Kelas</label>
                        <input type="text" name="class_name" placeholder="e.g. DITP4" class="w-full border rounded-lg p-2 text-sm" required>
                    </div>

                    {{-- Kursus / Subjek --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Kursus / Subjek</label>
                        <select name="course_id" class="w-full border rounded-lg p-2 text-sm" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pelajar Mengulang --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Pelajar Mengulang</label>
                        <select name="student_id" class="w-full border rounded-lg p-2 text-sm">
                            <option value="">-- Tiada / Pilih Pelajar --</option>
                            @foreach($repeatStudents as $student)
                                <option value="{{ $student->student_id }}">
                                    {{ $student->student_matric }} - {{ $student->student_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pensyarah --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Pensyarah</label>
                        <select name="lect_id" class="w-full border rounded-lg p-2 text-sm" required>
                            <option value="">-- Pilih Pensyarah --</option>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->staff_id }}">{{ $lecturer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bilik / Makmal --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Bilik / Makmal</label>
                        <select name="room_id" class="w-full border rounded-lg p-2 text-sm" required>
                            <option value="">-- Pilih Bilik --</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Hari --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Hari</label>
                        <select name="day" class="w-full border rounded-lg p-2 text-sm" required>
                            <option value="ISNIN">ISNIN</option>
                            <option value="SELASA">SELASA</option>
                            <option value="RABU">RABU</option>
                            <option value="KHAMIS">KHAMIS</option>
                            <option value="JUMAAT">JUMAAT</option>
                        </select>
                    </div>

                    {{-- Masa Mula --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Masa Mula</label>
                        <input type="time" name="time_start" class="w-full border rounded-lg p-2 text-sm" required>
                    </div>

                    {{-- Masa Tamat --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Masa Tamat</label>
                        <input type="time" name="time_end" class="w-full border rounded-lg p-2 text-sm" required>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Jadual</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection