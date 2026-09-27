@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('header_title', 'Student Dashboard')

@section('sidebar_menu')
    <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kad-kad Menu Utama (Gaya Lecturer Dashboard) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Kad 1: My Timetable --}}
        <a href="{{ route('student.timetable') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-indigo-500 hover:shadow-md transition block group">
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition">
                <i class="fa-solid fa-calendar-days text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">My Timetable</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Semak, upload gambar, atau isi jadual waktu kelas anda untuk semester ini.</p>
        </a>

        {{-- Kad 2: My Profile --}}
        <a href="{{ route('student.profile') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-indigo-500 hover:shadow-md transition block group">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition">
                <i class="fa-solid fa-user text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">My Profile</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Kemas kini maklumat profil peribadi, nama, emel dan kata laluan anda.</p>
        </a>

        {{-- Kad 3: Borang Mengulang Kursus --}}
        <a href="{{ route('student.repeat_form') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-indigo-500 hover:shadow-md transition block group">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                <i class="fa-solid fa-file-lines text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Borang Mengulang</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Mohon kursus ulangan (repeat course) dan semak jumlah subjek yang diambil.</p>
        </a>

    </div>

    {{-- Ringkasan / Status Bawah --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Permohonan Timetable</p>
            <h3 class="text-xl font-bold text-emerald-600 mt-2">Diluluskan & Sedia</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Kursus Ulangan</p>
            <h3 class="text-xl font-bold text-gray-800 mt-2">{{ $repeatCount ?? 0 }} Subjek</h3>
        </div>
    </div>

</div>
@endsection