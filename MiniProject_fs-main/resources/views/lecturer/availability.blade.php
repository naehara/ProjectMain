@extends('layouts.app')

@section('title', 'Slot Availability')
@section('header_title', 'Lecturer Slot Availability')

@section('sidebar_menu')
    <a href="{{ route('lecturer.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-calendar-day"></i><span>Dashboard</span>
    </a>
    <a href="{{ route('lecturer.schedule') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-table-cells"></i><span>Jadual Waktu Mengajar</span>
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-800 mb-2 flex items-center space-x-2">
            <i class="fa-solid fa-clock text-emerald-600"></i>
            <span>Tetapan Hari Bekerja & Masa Lapang</span>
        </h3>
        <p class="text-xs text-gray-500 mb-6">Sila kemaskini slot masa ketersediaan anda untuk rujukan pentadbir dan pelajar.</p>

        <form action="{{ route('lecturer.availability.update') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Hari Pilihan</label>
                    <select name="day" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500">
                        <option value="Monday">Isnin (Monday)</option>
                        <option value="Tuesday">Selasa (Tuesday)</option>
                        <option value="Wednesday">Rabu (Wednesday)</option>
                        <option value="Thursday">Khamis (Thursday)</option>
                        <option value="Friday">Jumaat (Friday)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Status Ketersediaan</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500">
                        <option value="available">Available (Ada Masa Lapang)</option>
                        <option value="busy">Busy (Sibuk / Mengajar)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Nota / Catatan Masa (Cth: 09:00 AM - 12:00 PM)</label>
                <input type="text" name="time_slot" placeholder="Masukkan julat masa..." class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white font-medium text-xs rounded-xl hover:bg-emerald-700 transition">
                    Kemaskini Slot
                </button>
            </div>
        </form>
    </div>

</div>
@endsection