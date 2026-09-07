@extends('layouts.app')

@section('title', 'Lecturer Portal')
@section('header_title', 'Lecturer Dashboard & Slot Availability')

@section('sidebar_menu')
    <a href="{{ route('lecturer.dashboard') }}" class="flex items-center px-4 py-3 bg-indigo-600 text-white rounded-lg font-medium space-x-3">
        <i class="fa-solid fa-calendar-day"></i><span>Jadual & Availability</span>
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Left Half: Form Slot Availability -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Kemaskini Hari Bekerja & Slot Masa</h3>
       <form action="{{ route('lecturer.availability.update') }}" method="POST" class="space-y-4">
    @csrf

    <!-- Mesej Kejayaan -->
    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Hari Bekerja</label>
        <div class="flex flex-wrap gap-2 mt-2">
            <label class="flex items-center space-x-1 border px-3 py-1 rounded">
                <input type="checkbox" name="working_days[]" value="Monday"> <span>Isnin</span>
            </label>
            <label class="flex items-center space-x-1 border px-3 py-1 rounded">
                <input type="checkbox" name="working_days[]" value="Tuesday"> <span>Selasa</span>
            </label>
            <label class="flex items-center space-x-1 border px-3 py-1 rounded">
                <input type="checkbox" name="working_days[]" value="Wednesday"> <span>Rabu</span>
                <br><br>
            </label>
            <label class="flex items-center space-x-1 border px-3 py-1 rounded">
                <input type="checkbox" name="working_days[]" value="Thursday"> <span>Khamis</span>
            </label>
            <label class="flex items-center space-x-1 border px-3 py-1 rounded">
                <input type="checkbox" name="working_days[]" value="Friday"> <span>Jumaat</span>
            </label>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Kursus Diajar</label>
        <input type="text" name="course_taught" class="w-full border px-3 py-2 rounded-lg mt-1" placeholder="e.g. SEC101 - Web Development" required>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        Simpan Tetapan
    </button>
</form>
    </div>

    <!-- Right Half: Timetable from Admin -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Jadual Mengajar (Dari Admin)</h3>
        <div class="space-y-3">
            <div class="p-4 border-l-4 border-indigo-600 bg-indigo-50 rounded-r-lg">
                <p class="font-bold text-gray-800">SEC101 - Web Development</p>
                <p class="text-sm text-gray-600">Pelajar Repeat: Ahmad (AI200100)</p>
                <p class="text-xs text-indigo-700 mt-1"><i class="fa-solid fa-clock"></i> Isnin | 10:00 AM - 12:00 PM | Lab 3</p>
            </div>
        </div>
    </div>

</div>
@endsection