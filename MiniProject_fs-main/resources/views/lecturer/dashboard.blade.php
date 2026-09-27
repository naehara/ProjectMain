@extends('layouts.app')

@section('title', 'Lecturer Portal')
@section('header_title', 'Lecturer Dashboard & Slot Availability')

@section('sidebar_menu')
    <a href="{{ route('lecturer.dashboard') }}" class="flex items-center px-4 py-3 bg-indigo-600 text-white rounded-lg font-medium space-x-3">
        <i class="fa-solid fa-calendar-day"></i><span>Dashboard</span>
    </a>
    <a href="{{ route('lecturer.schedule') }}" 
       class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('lecturer.schedule') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
        <i class="fa-solid fa-table-cells"></i>
        <span>Jadual Waktu Mengajar</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
   
    {{-- KAD MODUL UTAMA DENGAN IKON (Gaya Admin Dashboard) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- My Timetable --}}
        <a href="{{ route('lecturer.schedule') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-200 transition group">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:bg-indigo-600 group-hover:text-white transition">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <h3 class="text-base font-bold text-gray-800 mb-1">My Timetable</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Semak jadual waktu mengajar dan slot kelas anda untuk semester ini.</p>
        </a>

        {{-- Slot Availability / Form Availability --}}
        <a href="{{ route('lecturer.availability') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-200 transition group">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                <i class="fa-solid fa-clock"></i>
            </div>
            <h3 class="text-base font-bold text-gray-800 mb-1">Slot Availability</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Kemaskini hari bekerja, masa lapang, serta senarai kursus yang diajar.</p>
        </a>

        {{-- My Profile --}}
        <a href="{{ route('lecturer.profile') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-amber-200 transition group">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:bg-amber-600 group-hover:text-white transition">
                <i class="fa-solid fa-user-gear"></i>
            </div>
            <h3 class="text-base font-bold text-gray-800 mb-1">My Profile</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Kemas kini maklumat profil peribadi, kata laluan dan butiran staf.</p>
        </a>

    </div>

</div>
@endsection