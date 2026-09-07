@extends('layouts.app')

@section('title', 'Room Availability - Admin')
@section('header_title', 'Room Availability')

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
    <a href="{{ route('admin.lecturers') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Lecturers & Slots</span>
    </a>
    <a href="{{ route('admin.rooms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
        <h2 class="text-xl font-bold text-gray-800 mb-4">Pengurusan Bilik & Makmal</h2>
        <p class="text-gray-600">Kekosongan makmal dan bilik kuliah akan dipaparkan di sini.</p>
    </div>
@endsection