@extends('layouts.app')

@section('title', 'My Profile - Student')
@section('header_title', 'Profil Peribadi')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
     <!-- Butang Kembali ke Dashboard -->
        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-lg font-medium text-sm transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    
    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-xs">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Penuh</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" class="w-full border rounded-lg p-2 text-sm" required>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $student->username) }}" class="w-full border rounded-lg p-2 text-sm" required>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full border rounded-lg p-2 text-sm" required>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Katalaluan Baharu (Kosongkan jika tidak mahu tukar)</label>
            <input type="password" name="password" placeholder="••••••••" class="w-full border rounded-lg p-2 text-sm">
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">Kemaskini Profil</button>
        </div>
    </form>
</div>
@endsection