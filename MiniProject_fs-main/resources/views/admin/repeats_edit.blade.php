@extends('layouts.app')

@section('title', 'Edit Student Repeat Info')
@section('header_title', 'Kemaskini Maklumat Pelajar Repeat')

@section('content')
<div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm max-w-2xl mx-auto">
    <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
        <h3 class="text-lg font-bold text-gray-800">Edit Rekod Permohonan</h3>
        <a href="{{ route('admin.repeats') }}" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg transition">
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.repeats.update', $repeat->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">No. Matrik</label>
            <input type="text" name="student_matric" value="{{ old('student_matric', $repeat->student_matric) }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Pelajar</label>
            <input type="text" name="student_name" value="{{ old('student_name', $repeat->student_name) }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Subjek Repeat</label>
            <select name="course_id" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $repeat->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->course_code }} - {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Sesi Akademik</label>
            <select name="academic_session_id" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1" required>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}" {{ $repeat->academic_session_id == $session->id ? 'selected' : '' }}>
                        {{ $session->session_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Sebab Mengulang</label>
            <textarea name="reason" class="w-full border border-gray-300 px-3 py-2 rounded-lg mt-1" required>{{ old('reason', $repeat->reason) }}</textarea>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection