@extends('layouts.app')

@section('title', 'Jadual Waktu Kelas Student')
@section('header_title', 'Jadual Waktu Kelas Student')

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
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-6 max-w-6xl mx-auto">

     <!-- Butang Kembali -->
    <div class="flex justify-start">
        <a href="{{ route('student.dashboard') }}" 
           class="inline-flex items-center space-x-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
    
    <!-- Header Top Info & Logo -->
    <div class="text-center space-y-1">
        <div class="flex justify-center mb-2">
        <h1 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Jadual Waktu Kelas</h1>
    </div>

    <!-- Info Student & Sesi -->
    <div class="flex justify-between items-end text-[11px] font-semibold text-gray-700 border-b pb-3">
        <div class="space-y-0.5">
            <p><span class="text-gray-400">TARIKH KUATKUASA:</span> 22-June-2026</p>
            <p><span class="text-gray-400">KELAS:</span> DITP4</p>
        </div>
        <div class="text-right space-y-0.5">
            <p><span class="text-gray-400">SESI:</span> SESI 1 2026/2027</p>
            <p><span class="text-gray-400">JABATAN:</span> TEKNOLOGI MAKLUMAT DAN KOMUNIKASI</p>
        </div>
    </div>

    <!-- Table Jadual Kelas Utama -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-400 text-center text-[10px]">
            <thead>
                <tr class="bg-gray-100 text-gray-800 font-bold border-b border-gray-400">
                    <th class="border border-gray-400 p-2 w-16">HARI \ MASA</th>
                    <th class="border border-gray-400 p-1">8:00 - 9:00</th>
                    <th class="border border-gray-400 p-1">9:00 - 10:00</th>
                    <th class="border border-gray-400 p-1">10:00 - 11:00</th>
                    <th class="border border-gray-400 p-1">11:00 - 12:00</th>
                    <th class="border border-gray-400 p-1">12:00 - 1:00</th>
                    <th class="border border-gray-400 p-1">1:00 - 2:00</th>
                    <th class="border border-gray-400 p-1">2:00 - 3:00</th>
                    <th class="border border-gray-400 p-1">3:00 - 4:00</th>
                    <th class="border border-gray-400 p-1">4:00 - 5:00</th>
                    <th class="border border-gray-400 p-1">5:00 - 6:00</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                <!-- ISNIN -->
                <tr>
                    <td class="border border-gray-400 font-bold p-3 bg-gray-50">ISNIN</td>
                    <td class="border border-gray-400"></td>
                    <td class="border border-gray-400"></td>
                    <td class="border border-gray-400 p-1 bg-amber-50">
                        <div class="font-bold">DFK40063(P)</div>
                        <div class="text-[9px] text-gray-600">FARIZ, HAMIZI</div>
                        <div class="text-[8px] text-gray-400">IT3</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-amber-50">
                        <div class="font-bold">DFK40063(P)</div>
                        <div class="text-[9px] text-gray-600">FARIZ, HAMIZI</div>
                        <div class="text-[8px] text-gray-400">IT3</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-amber-50">
                        <div class="font-bold">DFK40063(P)</div>
                        <div class="text-[9px] text-gray-600">FARIZ, HAMIZI</div>
                        <div class="text-[8px] text-gray-400">IT3</div>
                    </td>
                    <td class="border border-gray-400 bg-gray-100 font-semibold text-gray-400">REHAT</td>
                    <td class="border border-gray-400 p-1 bg-blue-50">
                        <div class="font-bold">DFP40453(L)</div>
                        <div class="text-[9px] text-gray-600">MUNIRAH</div>
                        <div class="text-[8px] text-gray-400">APDV3</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-blue-50">
                        <div class="font-bold">DFP40453(P)</div>
                        <div class="text-[9px] text-gray-600">HUZANI, MUNIRAH</div>
                        <div class="text-[8px] text-gray-400">APDV3</div>
                    </td>
                    <td class="border border-gray-400"></td>
                    <td class="border border-gray-400"></td>
                </tr>

                <!-- SELASA -->
                <tr>
                    <td class="border border-gray-400 font-bold p-3 bg-gray-50">SELASA</td>
                    <td class="border border-gray-400 p-1 bg-emerald-50">
                        <div class="font-bold">DFC40343(L)</div>
                        <div class="text-[9px] text-gray-600">AMINAH</div>
                        <div class="text-[8px] text-gray-400">APPLE_EDU_JTMK</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-emerald-50">
                        <div class="font-bold">DFC40343(L)</div>
                        <div class="text-[9px] text-gray-600">AMINAH</div>
                        <div class="text-[8px] text-gray-400">APPLE_EDU_JTMK</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-indigo-50">
                        <div class="font-bold">DFC40343(L)</div>
                        <div class="text-[9px] text-gray-600">JAMALIAH</div>
                        <div class="text-[8px] text-gray-400">APDV1</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-indigo-50">
                        <div class="font-bold">DFK40433(P)</div>
                        <div class="text-[9px] text-gray-600">ANWAR, JAMALIAH</div>
                        <div class="text-[8px] text-gray-400">APDV1</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-indigo-50">
                        <div class="font-bold">DFK40433(P)</div>
                        <div class="text-[9px] text-gray-600">ANWAR, JAMALIAH</div>
                        <div class="text-[8px] text-gray-400">APDV1</div>
                    </td>
                    <td class="border border-gray-400 bg-gray-100 font-semibold text-gray-400">REHAT</td>
                    <td class="border border-gray-400"></td>
                    <td class="border border-gray-400"></td>
                    <td class="border border-gray-400 p-1 bg-amber-50">
                        <div class="font-bold">DFK40063(L)</div>
                        <div class="text-[9px] text-gray-600">HAMZI</div>
                        <div class="text-[8px] text-gray-400">IT3</div>
                    </td>
                    <td class="border border-gray-400 p-1 bg-amber-50">
                        <div class="font-bold">DFK40063(L)</div>
                        <div class="text-[9px] text-gray-600">HAMZI</div>
                        <div class="text-[8px] text-gray-400">IT3</div>
                    </td>
                </tr>

                <!-- RABU, KHAMIS, JUMAAT (Boleh teruskan isi ikut data korang) -->
            </tbody>
        </table>
    </div>

    <!-- Table Ringkasan Subjek & Kredit (Bawah Jadual) -->
    <div class="pt-4 max-w-md">
        <table class="w-full border-collapse border border-gray-400 text-left text-[10px]">
            <thead>
                <tr class="bg-gray-100 font-bold border-b border-gray-400">
                    <th class="border border-gray-400 p-1 w-20 text-center">KOD</th>
                    <th class="border border-gray-400 p-1">NAMA KURSUS</th>
                    <th class="border border-gray-400 p-1 w-16 text-center">JAM KREDIT</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                <tr>
                    <td class="border border-gray-400 p-1 font-semibold text-center">DFC40343</td>
                    <td class="border border-gray-400 p-1">SYSTEM ANALYSIS AND DESIGN FUNDAMENTALS</td>
                    <td class="border border-gray-400 p-1 text-center">3.0</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-1 font-semibold text-center">DFK40063</td>
                    <td class="border border-gray-400 p-1">SERVER ADMINISTRATION</td>
                    <td class="border border-gray-400 p-1 text-center">3.0</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-1 font-semibold text-center">DFK40073</td>
                    <td class="border border-gray-400 p-1">CLOUD COMPUTING</td>
                    <td class="border border-gray-400 p-1 text-center">3.0</td>
                </tr>
                <tr class="bg-gray-50 font-bold">
                    <td colspan="2" class="border border-gray-400 p-1 text-right">JUMLAH</td>
                    <td class="border border-gray-400 p-1 text-center">18.0</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection