@extends('layouts.app')

@section('title', 'Lecturers & Slots - Admin')
@section('header_title', 'Lecturers & Availability')

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
    <a href="{{ route('admin.repeats') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Student Repeat Info</span>
    </a>
    <a href="{{ route('admin.lecturers') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
        <h2 class="text-xl font-bold text-gray-800 mb-4">Pengurusan Pensyarah & Slot Masa</h2>
        
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID Staf</th>
                        <th class="p-3">Nama Pensyarah</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Hari Bekerja</th>
                        <th class="p-3">Kursus Diajar</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($lecturers as $lecturer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-gray-700">{{ $lecturer->staff_id ?? '-' }}</td>
                            <td class="p-3 font-semibold text-gray-900">{{ $lecturer->name }}</td>
                            <td class="p-3 text-gray-600">{{ $lecturer->email }}</td>
                            <td class="p-3">
                                <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                    {{ $lecturer->day ?? 'Belum Tetap' }}
                                </span>
                            </td>
                            <td class="p-3 text-gray-700">{{ $lecturer->course ?? 'Belum Tetap' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Tiada rekod pensyarah dijumpai dalam pangkalan data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection