@extends('layouts.app')

@section('title', 'Room Availability - Admin')
@section('header_title', 'Room Availability')

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
    <a href="{{ route('admin.lecturers') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Lecturers & Slots</span>
    </a>
    <a href="{{ route('admin.rooms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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

    @if($errors->any())
    <div class="mb-4 p-4 bg-rose-100 border border-rose-400 text-rose-700 rounded-lg text-sm">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
         </div>
        @endif

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pengurusan Bilik & Makmal</h2>
                <p class="text-xs text-gray-500 mt-1">Senarai bilik kuliah, makmal, dan status kekosongan.</p>
            </div>
            
            <button @click="openModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center shadow-sm">
                <i class="fa-solid fa-plus mr-2"></i>Tambah Bilik / Makmal
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">NAMA BILIK / MAKMAL</th>
                        <th class="p-3">JENIS</th>
                        <th class="p-3">KAPASITI</th>
                        <th class="p-3">STATUS</th>
                        <th class="p-3 text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($rooms as $room)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-gray-700">{{ $room->room_name }}</td>
                            <td class="p-3 text-gray-600">
                                <span class="capitalize">{{ $room->type ?? 'Bilik Kuliah' }}</span>
                            </td>
                            <td class="p-3 text-gray-600">{{ $room->capacity ?? '-' }} Pelajar</td>
                            <td class="p-3">
                                @if(($room->status ?? 'available') == 'available')
                                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Tersedia</span>
                                @else
                                    <span class="px-2.5 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold">Diselenggara / Penuh</span>
                                @endif
                            </td>
                            <td class="p-3 text-center space-x-2">
                                <button @click="editModal = true; editData = {{ json_encode($room) }}" class="inline-flex items-center px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Padam bilik ini?');">
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
                            <td colspan="6" class="p-4 text-center text-gray-500">Tiada rekod bilik atau makmal dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH BILIK --}}
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="openModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Bilik / Makmal</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Bilik / Makmal</label>
                    <input type="text" name="room_name" placeholder="e.g. Makmal Komputer 1" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Jenis</label>
                    <select name="type" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="Bilik Kuliah">Bilik Kuliah</option>
                        <option value="Makmal Komputer">Makmal Komputer</option>
                        <option value="Dewan Kuliah">Dewan Kuliah</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kapasiti (Pelajar)</label>
                    <input type="number" name="capacity" placeholder="e.g. 30" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Bilik</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT BILIK --}}
    <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="editModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Kemaskini Bilik</h3>
                <button @click="editModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form :action="'{{ url('/admin/rooms') }}/' + editData.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kod Bilik</label>
                    <input type="text" name="room_code" x-model="editData.room_code" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Bilik / Makmal</label>
                    <input type="text" name="room_name" x-model="editData.room_name" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kapasiti</label>
                    <input type="number" name="capacity" x-model="editData.capacity" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                    <select name="status" x-model="editData.status" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="available">Tersedia</option>
                        <option value="maintenance">Diselenggara</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="editModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-lg text-sm hover:bg-amber-600">Kemaskini</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection