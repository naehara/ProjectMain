@extends('layouts.app')

@section('title', 'Admin Dashboard - TimetableSys')
@section('header_title', 'Admin Portal & Navigation Hub')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Jumlah Timetable</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">128</h3>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-calendar-days text-xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pelajar Repeat</p>
                <h3 class="text-2xl font-bold text-amber-600 mt-1">42</h3>
            </div>
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pensyarah Aktif</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">24</h3>
            </div>
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-user-tie text-xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Bilik Kosong Today</p>
                <h3 class="text-2xl font-bold text-indigo-600 mt-1">15 / 20</h3>
            </div>
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                <i class="fa-solid fa-door-open text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Modul Utama Grid -->
    <h2 class="text-lg font-bold text-gray-800 mb-4">Pengurusan Modul Utama</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <a href="{{ route('admin.timetables') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition">
                    <i class="fa-solid fa-calendar-plus text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-indigo-600 transition">Timetable Management</h3>
                    <p class="text-sm text-gray-500 mt-1">Penjadualan tanpa clash sem/sesi & tetapan slot</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.repeats') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-amber-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-amber-600 transition">Student Repeat Info</h3>
                    <p class="text-sm text-gray-500 mt-1">Semak sebab gagal & senarai subjek perlu diulang</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.lecturers') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition">
                    <i class="fa-solid fa-clock text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-emerald-600 transition">Lecturer & Availability</h3>
                    <p class="text-sm text-gray-500 mt-1">Semak hari bekerja & slot masa lapang pensyarah</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.rooms') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-purple-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition">
                    <i class="fa-solid fa-building text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-purple-600 transition">Room Availability</h3>
                    <p class="text-sm text-gray-500 mt-1">Urus makmal, bilik kuliah & kekosongan fizikal</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.courses') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-rose-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition">
                    <i class="fa-solid fa-book text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-rose-600 transition">Courses & Sessions</h3>
                    <p class="text-sm text-gray-500 mt-1">Daftar kursus baru & tetapan sesi (e.g. II 2026/2027)</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-users-gear text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">User Management</h3>
                    <p class="text-sm text-gray-500 mt-1">Kawalan akaun Admin, Pensyarah, dan Pelajar</p>
                </div>
            </div>
        </a>

    </div>
@endsection