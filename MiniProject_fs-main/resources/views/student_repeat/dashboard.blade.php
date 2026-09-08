@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('header_title', 'Portal Permohonan Mengulang Kursus')

@section('content')

@section('sidebar_menu')
    {{-- Link Dashboard Student --}}
    <a href="{{ route('student.dashboard') }}" 
       class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('student.dashboard') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
    </a>

    {{-- Link Jadual Waktu Kelas Student --}}
    <a href="{{ route('student.schedule') }}" 
       class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('student.schedule') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
        <i class="fa-solid fa-table-cells"></i>
        <span>Jadual Waktu Kelas</span>
    </a>
@endsection

<!-- 1. BARIS ATAS: KAD WIDGET (2 KOLUM) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Kad Status -->
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Status Permohonan Timetable</p>
        <p class="text-xl font-bold text-emerald-600 mt-1">Diluluskan & Sedia</p>
    </div>

    <!-- Kad Jumlah Subjek -->
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Jumlah Kursus Ulangan</p>
        <p class="text-xl font-bold text-gray-800 mt-1">1 Subjek</p>
    </div>
</div>

<!-- 2. BARIS KEDUA: BUTANG MOHON REPEAT -->
<div class="mb-6">
    <a href="{{ route('student.repeat.form') }}" class="inline-flex items-center space-x-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-3 rounded-xl shadow-sm transition">
        <i class="fa-solid fa-circle-plus text-lg"></i>
        <span>Borang Permohonan Mengulang Kursus</span>
    </a>
</div>

<!-- 3. BARIS KETIGA: JADUAL WAKTU (DI BAWAH) -->
<div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm w-full">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Jadual Waktu Repeat Saya</h3>
    
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl">
        <h4 class="font-bold text-gray-800 text-base">SEC101 - Web Development</h4>
        <p class="text-sm text-gray-600 mt-0.5">Pensyarah: Dr. Nizam</p>
        
        <div class="flex items-center space-x-2 text-xs font-semibold text-emerald-700 mt-3">
            <i class="fa-regular fa-clock"></i>
            <span>Isnin | 10:00 AM - 12:00 PM | Lab 3</span>
        </div>
    </div>
</div>

@endsection