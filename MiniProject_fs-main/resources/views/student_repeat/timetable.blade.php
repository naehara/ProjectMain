@extends('layouts.app')

@section('title', 'My Timetable - Student')
@section('header_title', 'Jadual Waktu Saya')

@section('sidebar_menu')
    <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('student.profile') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-user"></i>
        <span>My Profile</span>
    </a>
    <a href="{{ route('student.timetable') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-calendar-days"></i>
        <span>My Timetable</span>
    </a>
    <a href="{{ route('student.repeat_form') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-file-lines"></i>
        <span>Borang Mengulang</span>
    </a>
@endsection

@section('content')
<div class="space-y-6" x-data="{ inputType: 'image' }">
    
    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Paparan Jadual Waktu Semasa</h3>

        @if(!empty($timetableFile))
            <div class="text-center">
                @if(Str::endsWith($timetableFile, ['.pdf']))
                    <a href="{{ asset($timetableFile) }}" target="_blank" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg">Buka PDF Jadual</a>
                @else
                    <img src="{{ asset($timetableFile) }}" alt="Jadual Waktu" class="max-h-96 mx-auto rounded-lg border shadow-sm">
                @endif
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Tiada jadual waktu dimuat naik lagi. Sila guna borang di bawah untuk memuat naik jadual.</p>
        @endif
    </div>

</div>

    {{-- Bahagian Edit / Replace Timetable (Dual-Input: Upload Gambar ATAU Manual) --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Kemaskini / Replace Jadual Waktu</h3>
       <form action="{{ route('student.timetable.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Pilih Kaedah Input Jadual</label>
                <select x-model="inputType" name="input_type" class="w-full border rounded-lg p-2 text-sm" required>
                    <option value="image">Upload Gambar Jadual (PNG / JPG)</option>
                    <option value="manual">Isi Jadual Manual (Teks)</option>
                </select>
            </div>

            {{-- Pilihan A: Upload Gambar --}}
            <div x-show="inputType === 'image'" class="space-y-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1">Fail Gambar Jadual</label>
                <input type="file" name="timetable_file" class="w-full border rounded-lg p-2 text-sm bg-gray-50">
            </div>

            {{-- Pilihan B: Isi Manual --}}
            <div x-show="inputType === 'manual'" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Subjek</label>
                    <input type="text" name="subject_name" placeholder="e.g. SEC101 - Web Development" class="w-full border rounded-lg p-2 text-sm">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Hari</label>
                        <input type="text" name="day" placeholder="Isnin" class="w-full border rounded-lg p-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Masa</label>
                        <input type="text" name="time" placeholder="10:00 AM - 12:00 PM" class="w-full border rounded-lg p-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Bilik / Lokasi</label>
                        <input type="text" name="room" placeholder="Lab 3" class="w-full border rounded-lg p-2 text-sm">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">Simpan / Replace Jadual</button>
            </div>
        </form>
    </div>
</div>
@endsection