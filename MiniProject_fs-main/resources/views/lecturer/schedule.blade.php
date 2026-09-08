@extends('layouts.app')

@section('title', 'Jadual Waktu Mengajar')
@section('header_title', 'Jadual Waktu Mengajar Pensyarah')

@section('sidebar_menu')
    {{-- Link Jadual & Availability (Dashboard) --}}
    <a href="{{ route('lecturer.dashboard') }}" 
       class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('lecturer.dashboard') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
        <i class="fa-solid fa-calendar-day"></i>
        <span>Jadual & Availability</span>
    </a>

    {{-- Link Jadual Waktu Mengajar (Schedule) --}}
    <a href="{{ route('lecturer.schedule') }}" 
       class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('lecturer.schedule') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
        <i class="fa-solid fa-table-cells"></i>
        <span>Jadual Waktu Mengajar</span>
    </a>
@endsection

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-6">

    <!-- Butang Kembali -->
    <div class="flex justify-start">
        <a href="{{ route('lecturer.dashboard') }}" 
           class="inline-flex items-center space-x-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
    
    <!-- Info Headers -->
    <div class="flex justify-between items-start border-b pb-4 text-xs font-semibold text-gray-700">
        <div>
            <p><span class="text-gray-400">TARIKH KUATKUASA:</span> 22-June-2026</p>
            <p><span class="text-gray-400">PENSYARAH:</span> {{ auth()->user()->name ?? 'ANIS FATIHA BINTI AHMAD SAHIMI' }}</p>
        </div>
        <div class="text-right">
            <p><span class="text-gray-400">SESI:</span> SESI 1 2026/2027</p>
            <p><span class="text-gray-400">JABATAN:</span> TEKNOLOGI MAKLUMAT DAN KOMUNIKASI</p>
        </div>
    </div>

    <!-- Jadual Grid Utama -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-center text-xs">
            <thead>
                <tr class="bg-gray-100 text-gray-700 font-bold">
                    <th class="border border-gray-300 p-2 w-20">HARI \ MASA</th>
                    <th class="border border-gray-300 p-2">8:00 - 9:00</th>
                    <th class="border border-gray-300 p-2">9:00 - 10:00</th>
                    <th class="border border-gray-300 p-2">10:00 - 11:00</th>
                    <th class="border border-gray-300 p-2">11:00 - 12:00</th>
                    <th class="border border-gray-300 p-2">12:00 - 1:00</th>
                    <th class="border border-gray-300 p-2">1:00 - 2:00</th>
                    <th class="border border-gray-300 p-2">2:00 - 3:00</th>
                    <th class="border border-gray-300 p-2">3:00 - 4:00</th>
                    <th class="border border-gray-300 p-2">4:00 - 5:00</th>
                    <th class="border border-gray-300 p-2">5:00 - 6:00</th>
                </tr>
            </thead>
            <tbody>
                <!-- ISNIN -->
                <tr>
                    <td class="border border-gray-300 font-bold p-3 bg-gray-50">ISNIN</td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300 bg-gray-100 text-gray-400">REHAT</td>
                    <td class="border border-gray-300 bg-blue-50 p-1">
                        <div class="font-bold text-blue-900">DFP_50293(P)</div>
                        <div class="text-[10px] text-gray-600">JTMK_KHAS1</div>
                    </td>
                    <td class="border border-gray-300 bg-blue-50 p-1">
                        <div class="font-bold text-blue-900">DFP_50293(P)</div>
                        <div class="text-[10px] text-gray-600">JTMK_KHAS1</div>
                    </td>
                    <td class="border border-gray-300 bg-blue-50 p-1">
                        <div class="font-bold text-blue-900">DFP_50293(P)</div>
                        <div class="text-[10px] text-gray-600">JTMK_KHAS1</div>
                    </td>
                    <td class="border border-gray-300"></td>
                </tr>

                <!-- SELASA -->
                <tr>
                    <td class="border border-gray-300 font-bold p-3 bg-gray-50">SELASA</td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300 bg-orange-50 p-1">
                        <div class="font-bold text-orange-900">PA(0)</div>
                        <div class="text-[10px] text-gray-600">DITP5B</div>
                    </td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300 bg-gray-100 text-gray-400">REHAT</td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                </tr>

                <!-- RABU -->
                <tr>
                    <td class="border border-gray-300 font-bold p-3 bg-gray-50">RABU</td>
                    <td class="border border-gray-300 bg-emerald-50 p-1">
                        <div class="font-bold text-emerald-900">DFT50194(L)</div>
                        <div class="text-[10px] text-gray-600">DK-JTMK</div>
                    </td>
                    <td class="border border-gray-300 bg-emerald-50 p-1">
                        <div class="font-bold text-emerald-900">DFT50194(L)</div>
                        <div class="text-[10px] text-gray-600">DK-JTMK</div>
                    </td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300 bg-gray-100 text-gray-400">REHAT</td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                </tr>

                <!-- KHAMIS -->
                <tr>
                    <td class="border border-gray-300 font-bold p-3 bg-gray-50">KHAMIS</td>
                    <td class="border border-gray-300 bg-blue-50 p-1">
                        <div class="font-bold text-blue-900">DFP_50293(L)</div>
                        <div class="text-[10px] text-gray-600">JTMK_KHAS1</div>
                    </td>
                    <td class="border border-gray-300 bg-blue-50 p-1">
                        <div class="font-bold text-blue-900">DFP_50293(L)</div>
                        <div class="text-[10px] text-gray-600">JTMK_KHAS1</div>
                    </td>
                    <td class="border border-gray-300 bg-lime-50 p-1">
                        <div class="font-bold text-lime-900">DFP40443(P)</div>
                        <div class="text-[10px] text-gray-600">DITP4</div>
                    </td>
                    <td class="border border-gray-300 bg-lime-50 p-1">
                        <div class="font-bold text-lime-900">DFP40443(P)</div>
                        <div class="text-[10px] text-gray-600">DITP4</div>
                    </td>
                    <td class="border border-gray-300 bg-lime-50 p-1">
                        <div class="font-bold text-lime-900">DFP40443(P)</div>
                        <div class="text-[10px] text-gray-600">DITP4</div>
                    </td>
                    <td class="border border-gray-300 bg-gray-100 text-gray-400">REHAT</td>
                    <td class="border border-gray-300 bg-orange-50 p-1">
                        <div class="font-bold text-orange-900">DFT10194(P)</div>
                        <div class="text-[10px] text-gray-600">APDV1</div>
                    </td>
                    <td class="border border-gray-300 bg-orange-50 p-1">
                        <div class="font-bold text-orange-900">DFT10194(P)</div>
                        <div class="text-[10px] text-gray-600">APDV1</div>
                    </td>
                    <td class="border border-gray-300 bg-orange-50 p-1">
                        <div class="font-bold text-orange-900">DFT10194(P)</div>
                        <div class="text-[10px] text-gray-600">APDV1</div>
                    </td>
                    <td class="border border-gray-300"></td>
                </tr>

                <!-- JUMAAT -->
                <tr>
                    <td class="border border-gray-300 font-bold p-3 bg-gray-50">JUMAAT</td>
                    <td class="border border-gray-300 bg-purple-50 p-1">
                        <div class="font-bold text-purple-900">DFC10353(P)</div>
                        <div class="text-[10px] text-gray-600">DIT1A</div>
                    </td>
                    <td class="border border-gray-300 bg-purple-50 p-1">
                        <div class="font-bold text-purple-900">DFC10353(P)</div>
                        <div class="text-[10px] text-gray-600">DIT1A</div>
                    </td>
                    <td class="border border-gray-300 bg-lime-50 p-1">
                        <div class="font-bold text-lime-900">DFP40443(P)</div>
                        <div class="text-[10px] text-gray-600">DITP4</div>
                    </td>
                    <td class="border border-gray-300 bg-lime-50 p-1">
                        <div class="font-bold text-lime-900">DFP40443(P)</div>
                        <div class="text-[10px] text-gray-600">DITP4</div>
                    </td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300 bg-gray-100 text-gray-400">REHAT</td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                    <td class="border border-gray-300"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection