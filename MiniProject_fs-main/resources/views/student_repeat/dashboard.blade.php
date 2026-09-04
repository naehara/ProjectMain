@extends('layouts.app')

@section('title', 'Student Portal')
@section('header_title', 'Portal Permohonan Subjek Repeat')

@section('sidebar_menu')
    <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-3 bg-indigo-600 text-white rounded-lg font-medium space-x-3">
        <i class="fa-solid fa-user-graduate"></i><span>Status & Form Repeat</span>
    </a>
@endsection

@section('content')
<!-- Top Widgets -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <p class="text-sm text-gray-500">Status Permohonan Timetable</p>
        <p class="text-xl font-bold text-emerald-600 mt-1">Diluluskan & Sedia</p>
    </div>
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <p class="text-sm text-gray-500">Jumlah Subjek Repeat</p>
        <p class="text-xl font-bold text-gray-800 mt-1">1 Subjek</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Form Maklumat Gagal -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Borang Subjek Repeat</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Semester Semasa</label>
                <input type="text" class="w-full border px-3 py-2 rounded-lg mt-1" placeholder="e.g. Semester 4">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Subjek Gagal</label>
                <input type="text" class="w-full border px-3 py-2 rounded-lg mt-1" placeholder="e.g. SEC101 Web Development">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sebab Gagal</label>
                <textarea class="w-full border px-3 py-2 rounded-lg mt-1" rows="3" placeholder="Nyatakan sebab..."></textarea>
            </div>
            <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded-lg">Hantar Maklumat</button>
        </form>
    </div>

    <!-- Paparan Jadual dari Admin -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Jadual Waktu Repeat Saya</h3>
        <div class="p-4 border-l-4 border-emerald-500 bg-emerald-50 rounded-r-lg">
            <p class="font-bold text-gray-800">SEC101 - Web Development</p>
            <p class="text-sm text-gray-600">Pensyarah: Dr. Nizam</p>
            <p class="text-xs text-emerald-700 mt-1"><i class="fa-solid fa-clock"></i> Isnin | 10:00 AM - 12:00 PM | Lab 3</p>
        </div>
    </div>
</div>
@endsection