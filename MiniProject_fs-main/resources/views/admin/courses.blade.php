@extends('layouts.app')

@section('title', 'Courses & Lecturers Assignment - Admin')
@section('header_title', 'Courses & Lecturer Assignment')

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
    <a href="{{ route('admin.rooms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-door-open"></i>
        <span>Room Availability</span>
    </a>
    <a href="{{ route('admin.courses') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
        <i class="fa-solid fa-book-bookmark"></i>
        <span>Courses & Session</span>
    </a>
@endsection

@section('content')
<div x-data="{ assignModal: false, addCourseModal: false, selectedLecturer: {} }">

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- KURSUS & PENSYARAH SEKSYEN --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pengurusan Kaitan Pensyarah & Kursus</h2>
                <p class="text-xs text-gray-500 mt-1">Tetapkan kursus yang diajar oleh setiap pensyarah untuk penjadualan.</p>
            </div>
            
            <button @click="addCourseModal = true" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center shadow-sm text-sm font-medium">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Kursus Baru
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">ID STAF</th>
                        <th class="p-3">NAMA PENSYARAH</th>
                        <th class="p-3">EMAIL</th>
                        <th class="p-3">KURSUS DIAJAR</th>
                        <th class="p-3 text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($lecturers as $lecturer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-semibold text-indigo-600">{{ $lecturer->staff_id ?? $lecturer->id }}</td>
                            <td class="p-3 font-medium text-gray-800">{{ $lecturer->name }}</td>
                            <td class="p-3 text-gray-600">{{ $lecturer->email }}</td>
                            <td class="p-3">
                                @if(isset($lecturer->courses) && $lecturer->courses->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($lecturer->courses as $c)
                                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded text-xs font-semibold border border-indigo-100">
                                                {{ $c->course_code }} - {{ $c->course_name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="px-2 py-1 bg-amber-50 text-amber-700 rounded text-xs font-medium border border-amber-200">Belum Diisi</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <button @click="assignModal = true; selectedLecturer = {{ json_encode($lecturer) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition shadow-sm">
                                    <i class="fa-solid fa-link mr-1"></i> Tetapkan Kursus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Tiada rekod pensyarah dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH KURSUS BARU --}}
    <div x-show="addCourseModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 space-y-4" @click.away="addCourseModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tambah Kursus Baru</h3>
                <button @click="addCourseModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kod Kursus</label>
                    <input type="text" name="course_code" placeholder="e.g. DFP50132" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Kursus</label>
                    <input type="text" name="course_name" placeholder="e.g. Web Programming" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kredit</label>
                    <input type="number" name="credit_hours" placeholder="e.g. 3" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="addCourseModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Kursus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TETAPKAN KURSUS KEPADA PENSYARAH --}}
    <div x-show="assignModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 space-y-4" @click.away="assignModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-gray-800">Tetapkan Kursus untuk <span class="text-indigo-600" x-text="selectedLecturer.name"></span></h3>
                <button @click="assignModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form :action="'{{ url('/admin/lecturers') }}/' + (selectedLecturer.id) + '/assign-courses'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Pilih Kursus yang Diajar:</label>
                    <div class="max-h-48 overflow-y-auto space-y-2 border p-3 rounded-lg bg-gray-50">
                        @foreach($allCourses as $course)
                            <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 p-1 rounded">
                                <input type="checkbox" name="course_ids[]" value="{{ $course->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                <span><strong>{{ $course->course_code }}</strong> - {{ $course->course_name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="assignModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Simpan Kaitan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection