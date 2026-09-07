@extends('layouts.app')

@section('title', 'User Management - Admin')
@section('header_title', 'User Management')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.timetables') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-calendar-week"></i>
        <span>Timetable Mgmt</span>
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pengurusan Pengguna</h2>
                <p class="text-gray-500 text-sm mt-1">Senarai semua akaun Admin, Pensyarah, dan Pelajar.</p>
            </div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center space-x-2 text-sm font-medium">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Pengguna</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Username</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Peranan (Role)</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-gray-500">#{{ $user->id }}</td>
                            <td class="p-3 font-semibold text-gray-900">{{ $user->name }}</td>
                            <td class="p-3 text-gray-600">{{ $user->username }}</td>
                            <td class="p-3 text-gray-600">{{ $user->email ?? '-' }}</td>
                            <td class="p-3">
                                @if(strtolower($user->role) === 'admin')
                                    <span class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-xs font-semibold uppercase">
                                        Admin
                                    </span>
                                @elseif(strtolower($user->role) === 'lecturer')
                                    <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold uppercase">
                                        Lecturer
                                    </span>
                                @else
                                    <span class="bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-semibold uppercase">
                                        Student
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Tiada pengguna dijumpai dalam pangkalan data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection