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
<div x-data="{ openModal: false }">

    {{-- Alert Mesej Kejayaan --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        
        {{-- Header & Button Tambah --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Maklumat Pelajar Repeat</h2>
                <p class="text-xs text-gray-500 mt-1">Senarai pelajar yang mendaftar kursus mengulang beserta sebab kegagalan.</p>
            </div>
            
            <button @click="openModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center shadow-sm">
                <i class="fa-solid fa-user-plus mr-2"></i>Tambah Pelajar Repeat
            </button>
        </div>

        {{-- Jadual Senarai Pelajar --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">No. Matrik</th>
                        <th class="p-3">Nama Pelajar</th>
                        <th class="p-3">Kelas</th>
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
                            <td class="p-3 text-gray-600">{{ $student->class ?? $student->class_group ?? '-' }}</td>

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

                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('admin.repeats.edit', $student->id ?? $student->student_id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </a>

                                <form action="{{ route('admin.repeats.destroy', $student->id ?? $student->student_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Adakah anda pasti ingin memadam rekod ini?');">
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
                            <td colspan="6" class="p-4 text-center text-gray-500">Tiada rekod pelajar mengulang dijumpai dalam pangkalan data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH PELAJAR REPEAT --}}
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="openModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Pelajar Mengulang</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('admin.repeats.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">No. Matrik</label>
                    <input type="text" name="student_matric" placeholder="e.g. DIT21F1002" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Pelajar</label>
                    <input type="text" name="student_name" placeholder="e.g. Mew" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kelas / Kumpulan</label>
                    <input type="text" name="class" placeholder="e.g. DITP4" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kursus Mengulang</label>
                    <select name="course_id" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        <option value="">-- Pilih Kursus --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id ?? $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Sebab Mengulang</label>
                    <textarea name="reason" placeholder="e.g. Gagal peperiksaan akhir" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" rows="2"></textarea>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Pelajar</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection