@extends('layouts.app')

@section('title', 'Student Portal')
@section('header_title', 'Portal Permohonan Mengulang Kursus')

@section('sidebar_menu')
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

@section('content')
<!-- Mesej Kejayaan jika borang dihantar -->
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-xl flex items-center justify-between">
        <span>{{ session('success') }}</span>
    </div>
@endif


<!-- BUTANG KEMBALI & TAJUK CARD -->
<div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
    <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
        <h3 class="text-lg font-bold text-gray-800">Borang Mengulang Kursus</h3>
        
        <!-- Butang Kembali ke Dashboard -->
        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-lg font-medium text-sm transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
        
        <form action="{{ route('student.repeat.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Matrik</label>
                <input type="text" name="student_matric" value="{{ Auth::user()->username ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Pelajar</label>
                <input type="text" name="student_name" value="{{ Auth::user()->name ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Dropdown Subjek / Course -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Subjek Gagal</label>
                <select name="course_id" class="w-full border px-3 py-2 rounded-lg mt-1" required>
                    <option value="">-- Pilih Subjek --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Sesi Akademik -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Sesi Akademik</label>
                <select name="academic_session_id" class="w-full border px-3 py-2 rounded-lg mt-1" required>
                    <option value="">-- Pilih Sesi --</option>
                    @foreach($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sebab Mengulang</label>
                <textarea name="reason" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Nyatakan sebab mengulang subjek..." required></textarea>
            </div>

            <button type="submit" class="w-full bg-amber-600 text-white font-medium px-4 py-2.5 rounded-lg hover:bg-amber-700 transition">
                Hantar Maklumat
            </button>
        </form>
    </div>

@endsection