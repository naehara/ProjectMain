@extends('layouts.app')

@section('title', 'User Management - Admin')
@section('header_title', 'User Management')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.timetables') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-calendar-week"></i>
        <span>Timetable Mgmt</span>
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
<div x-data="{ openModal: false }">

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pengurusan Pengguna</h2>
                <p class="text-xs text-gray-500 mt-1">Senarai semua akaun Admin, Pensyarah, dan Pelajar.</p>
            </div>
            
            {{-- Button to Open Modal --}}
            <button @click="openModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                <i class="fa-solid fa-user-plus mr-2"></i>Tambah Pengguna
            </button>
        </div>

        {{-- Table Users --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Username</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Peranan (Role)</th>
                        <th class="p-3">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($users as $user)
                        <tr>
                            <td class="p-3 text-gray-500">#{{ $user->id }}</td>
                            <td class="p-3 font-semibold text-gray-800">{{ $user->name }}</td>
                            <td class="p-3 text-gray-600">{{ $user->username ?? '-' }}</td>
                            <td class="p-3 text-gray-600">{{ $user->email }}</td>
                            <td class="p-3">
                                @if(strtoupper($user->role) === 'ADMIN')
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-bold uppercase">ADMIN</span>
                                @elseif(strtoupper($user->role) === 'LECTURER')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-bold uppercase">LECTURER</span>
                                @else
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-bold uppercase">STUDENT</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Padam pengguna ini?')">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-xs">
                                            <ul class="list-disc pl-4 space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Tiada pengguna ditemui.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH PENGGUNA --}}
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="openModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Pengguna Baharu</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Penuh</label>
                    <input type="text" name="name" placeholder="e.g. Ahmad Albab" class="w-full border rounded-lg p-2 text-sm" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Username</label>
                    <input type="text" name="username" placeholder="e.g. ahmad99" class="w-full border rounded-lg p-2 text-sm" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" placeholder="e.g. ahmad@example.com" class="w-full border rounded-lg p-2 text-sm" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Katalaluan (Password)</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full border rounded-lg p-2 text-sm" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Peranan (Role)</label>
                    <select name="role" class="w-full border rounded-lg p-2 text-sm" required>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
   