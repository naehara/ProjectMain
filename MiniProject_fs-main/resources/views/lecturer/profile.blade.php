@extends('layouts.app')

@section('title', 'Lecturer Profile')
@section('header_title', 'My Profile')

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

    {{-- Butang Kembali --}}
    <div class="flex justify-between items-center">
        <a href="{{ route('lecturer.dashboard') }}" 
           class="inline-flex items-center space-x-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
    
    {{-- KAD PAPARAN PROFIL (VIEW MODE) --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg">
                    {{ substr(auth()->user()->name ?? 'L', 0, 1) }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-800">{{ auth()->user()->name ?? 'Nama Pensyarah' }}</h3>
                    <p class="text-xs text-gray-500">Portal Akaun Pensyarah</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm mb-6">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Penuh</span>
                <span class="text-gray-800 font-medium">{{ auth()->user()->name ?? '-' }}</span>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Emel Rasmi</span>
                <span class="text-gray-800 font-medium">{{ auth()->user()->email ?? '-' }}</span>
            </div>
        </div>

        {{-- Borang Kemaskini Terus (Boleh guna Alpine.js untuk toggle atau paparkan terus sebagai seksyen Edit di bawah) --}}
        <div class="border-t pt-6" x-data="{ openEdit: false }">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-sm font-bold text-gray-800 flex items-center space-x-2">
                    <i class="fa-solid fa-user-gear text-amber-600"></i>
                    <span>Tetapan Akaun</span>
                </h4>
                <button @click="openEdit = !openEdit" class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-xl transition flex items-center space-x-1.5">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span x-text="openEdit ? 'Tutup Borang' : 'Edit Profil'"></span>
                </button>
            </div>

            {{-- Form Edit yang tersembunyi / keluar bila tekan butang Edit --}}
            <form x-show="openEdit" style="display: none;" action="#" method="POST" class="space-y-4 bg-gray-50 p-4 rounded-xl border border-gray-200 mt-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kemaskini Nama Penuh</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kemaskini Emel Rasmi</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white font-medium text-xs rounded-xl hover:bg-indigo-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection