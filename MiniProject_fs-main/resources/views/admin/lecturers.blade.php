@extends('layouts.app')

@section('title', 'Lecturers & Slots - Admin')
@section('header_title', 'Lecturers & Availability')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.timetables') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-calendar-week"></i>
        <span>Timetable Mgmt</span>
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-users"></i>
        <span>User Management</span>
    </a>
    <a href="{{ route('admin.repeats') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Student Repeat Info</span>
    </a>
    <a href="{{ route('admin.lecturers') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Lecturers & Slots</span>
    </a>
    <a href="{{ route('admin.rooms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-door-open"></i>
        <span>Room Availability</span>
    </a>
    <a href="{{ route('admin.courses') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-book-bookmark"></i>
        <span>Courses & Session</span>
    </a>
@endsection

@section('content')
<div x-data="{ openModal: false, editModal: false, editData: {} }">

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pengurusan Pensyarah & Slot Masa</h2>
            </div>
            
            <button @click="openModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center shadow-sm">
                <i class="fa-solid fa-user-plus mr-2"></i>Tambah Pensyarah
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID STAF</th>
                        <th class="p-3">NAMA PENSYARAH</th>
                        <th class="p-3">EMAIL</th>
                        <th class="p-3">HARI BEKERJA</th>
                        <th class="p-3">KURSUS DIAJAR</th>
                        <th class="p-3 text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($lecturers as $lecturer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-gray-600">{{ $lecturer->staff_id ?? $lecturer->username ?? '-' }}</td>
                            <td class="p-3 font-semibold text-gray-800">{{ $lecturer->name ?? $lecturer->lecturer_name }}</td>
                            <td class="p-3 text-gray-600">{{ $lecturer->email }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-semibold">
                                    {{ $lecturer->work_days ?? 'Belum Tetap' }}
                                </span>
                            </td>
                            <td class="p-3 text-gray-600">{{ $lecturer->assigned_course ?? 'Belum Tetap' }}</td>
                            <td class="p-3 text-center space-x-2">
                                <button @click="editModal = true; editData = {{ json_encode($lecturer) }}" class="inline-flex items-center px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.lecturers.destroy', $lecturer->id ?? $lecturer->lecturer_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Padam rekod pensyarah ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-md transition">
                                        <i class="fa-solid fa-trash-can mr-1"></i> Padam
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Tiada rekod pensyarah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH PENSYARAH --}}
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="openModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Pensyarah Baharu</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('admin.lecturers.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">ID Staf</label>
                    <input type="text" name="staff_id" placeholder="e.g. LECT101" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Pensyarah</label>
                    <input type="text" name="name" placeholder="e.g. Dr. Nizam" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" placeholder="e.g. nizam@example.com" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Hari Bekerja</label>
                    <input type="text" name="work_days" placeholder="e.g. Isnin - Khamis" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Pensyarah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT PENSYARAH --}}
    <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="editModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Kemaskini Pensyarah</h3>
                <button @click="editModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form :action="'{{ url('/admin/lecturers') }}/' + editData.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Pensyarah</label>
                    <input type="text" name="name" x-model="editData.name" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" x-model="editData.email" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Hari Bekerja</label>
                    <input type="text" name="work_days" x-model="editData.work_days" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="editModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-lg text-sm hover:bg-amber-600">Kemaskini</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SEKSYEN KETERSEDIAAN & SLOT PENSYARAH --}}
    <div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Senarai Slot Masa & Ketersediaan Pensyarah</h3>
            <p class="text-xs text-gray-500">Rekod masa dan hari bertugas yang dikemaskini sendiri oleh pensyarah.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID STAF</th>
                        <th class="p-3">NAMA PENSYARAH</th>
                        <th class="p-3">HARI</th>
                        <th class="p-3">MASA & STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($availabilities ?? [] as $slot)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-gray-600">{{ $slot->staff_id ?? '-' }}</td>
                            <td class="p-3 font-semibold text-gray-800">{{ $slot->Name ?? '-' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-xs font-semibold">
                                    {{ $slot->Day ?? '-' }}
                                </span>
                            </td>
                           {{-- SINI BAHAGIAN STEP 3 TU --}}
                            <td class="p-3">
                                @if(isset($slot->status) && strtolower($slot->status) == 'available')
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">
                                        Available ({{ $slot->Time ?? '-' }})
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-rose-50 text-rose-700 rounded-full text-xs font-semibold">
                                        {{ ucfirst($slot->status ?? 'Busy') }} ({{ $slot->Time ?? '-' }})
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Tiada rekod slot ketersediaan dimasukkan lagi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection