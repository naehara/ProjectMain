@extends('layouts.app')

@section('title', 'Admin Dashboard - TimetableSys')
@section('header_title', 'Admin Portal & Navigation Hub')

@section('sidebar_menu')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-indigo-600 text-white font-medium transition">
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
    <a href="{{ route('admin.courses') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <i class="fa-solid fa-book-bookmark"></i>
        <span>Courses & Session</span>
    </a>
@endsection

@section('content')
    {{-- Kotak Carian AJAX --}}
        <!-- Kotak Carian Global (Dropdown Pop-up) -->
<div class="relative mb-6 w-full md:w-1/2">
    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input type="text" id="globalSearchBox" placeholder="Cari student, lecturer, course, timetable..." 
               class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" autocomplete="off">
    </div>

    <!-- Dropdown Pop-up Terapung Hasil Carian -->
    <div id="searchDropdown" class="absolute z-50 left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-gray-100 max-h-96 overflow-y-auto hidden divide-y divide-gray-100">
        <!-- Hasil carian akan masuk secara automatik kat sini -->
    </div>
</div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

           <!-- Jumlah Timetable -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Jumlah Timetable</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalTimetables }}</h3>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-calendar-days text-xl"></i>
            </div>
        </div>

        <!-- Pelajar Repeat -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pelajar Repeat</p>
                <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $repeatStudentsCount }}</h3>
            </div>
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
        </div>

         <!-- Pensyarah Aktif -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pensyarah Aktif</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $activeLecturersCount }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-user-tie text-xl"></i>
            </div>
        </div>


      <!-- Bilik Kosong Today -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Bilik Kosong Today</p>
                <h3 class="text-2xl font-bold text-indigo-600 mt-1">{{ $emptyRoomsToday }} / {{ $totalRooms }}</h3>
            </div>
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                <i class="fa-solid fa-door-open text-xl"></i>
            </div>
        </div>

    </div>

    <!-- Modul Utama Grid -->
    <h2 class="text-lg font-bold text-gray-800 mb-4">Pengurusan Modul Utama</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <a href="{{ route('admin.timetables') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition">
                    <i class="fa-solid fa-calendar-plus text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-indigo-600 transition">Timetable Management</h3>
                    <p class="text-sm text-gray-500 mt-1">Penjadualan tanpa clash sem/sesi & tetapan slot</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.repeats') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-amber-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-amber-600 transition">Student Repeat Info</h3>
                    <p class="text-sm text-gray-500 mt-1">Semak sebab gagal & senarai subjek perlu diulang</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.lecturers') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition">
                    <i class="fa-solid fa-clock text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-emerald-600 transition">Lecturer & Availability</h3>
                    <p class="text-sm text-gray-500 mt-1">Semak hari bekerja & slot masa lapang pensyarah</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.rooms') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-purple-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition">
                    <i class="fa-solid fa-building text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-purple-600 transition">Room Availability</h3>
                    <p class="text-sm text-gray-500 mt-1">Urus makmal, bilik kuliah & kekosongan fizikal</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.courses') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-rose-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition">
                    <i class="fa-solid fa-book text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-rose-600 transition">Courses & Sessions</h3>
                    <p class="text-sm text-gray-500 mt-1">Daftar kursus baru & tetapan sesi (e.g. II 2026/2027)</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition group">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-users-gear text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">User Management</h3>
                    <p class="text-sm text-gray-500 mt-1">Kawalan akaun Admin, Pensyarah, dan Pelajar</p>
                </div>
            </div>
        </a>

    </div>

<!-- Skrip JavaScript AJAX untuk Pop-up -->
<script>
    const searchBox = document.getElementById('globalSearchBox');
    const dropdown = document.getElementById('searchDropdown');

    searchBox.addEventListener('keyup', function() {
        let query = this.value.trim();

        if (query === '') {
            dropdown.classList.add('hidden');
            dropdown.innerHTML = '';
            return;
        }

        fetch(`{{ route('admin.global.search') }}?query=${query}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            dropdown.innerHTML = '';
            let hasResults = false;

            // 1. Bahagian Student / Repeat
            if (data.repeats && data.repeats.length > 0) {
                hasResults = true;
                let section = `<div class="p-3 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">Pelajar Repeat</div>`;
                data.repeats.forEach(item => {
                    let url = `{{ url('admin/repeats') }}/${item.id}/edit`;
                    section += `
                        <a href="${url}" class="block px-4 py-3 hover:bg-indigo-50 transition flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-gray-800">${item.student_name}</p>
                                <p class="text-xs text-gray-500">Matrik: ${item.student_matric}</p>
                            </div>
                            <span class="text-xs bg-amber-100 text-amber-700 px-2 py-1 rounded-full font-medium">Repeat</span>
                        </a>
                    `;
                });
                dropdown.innerHTML += section;
            }

            // 2. Bahagian Pengguna / Lecturer
            if (data.users && data.users.length > 0) {
                hasResults = true;
                let section = `<div class="p-3 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">Pengguna & Lecturer</div>`;
                data.users.forEach(item => {
                    let url = `{{ route('admin.users') }}`;
                    section += `
                        <a href="${url}" class="block px-4 py-3 hover:bg-indigo-50 transition flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-gray-800">${item.name}</p>
                                <p class="text-xs text-gray-500">${item.email}</p>
                            </div>
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-medium">User</span>
                        </a>
                    `;
                });
                dropdown.innerHTML += section;
            }

            // 3. Bahagian Courses
            if (data.courses && data.courses.length > 0) {
                hasResults = true;
                let section = `<div class="p-3 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">Kursus</div>`;
                data.courses.forEach(item => {
                    let url = `{{ route('admin.courses') }}`;
                    section += `
                        <a href="${url}" class="block px-4 py-3 hover:bg-indigo-50 transition flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-gray-800">${item.course_name}</p>
                                <p class="text-xs text-gray-500">Kod: ${item.course_code}</p>
                            </div>
                            <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full font-medium">Course</span>
                        </a>
                    `;
                });
                dropdown.innerHTML += section;
            }

            if (hasResults) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.innerHTML = `<div class="p-4 text-center text-sm text-gray-500">Tiada sebarang rekod dijumpai.</div>`;
                dropdown.classList.remove('hidden');
            }
        });
    });

    // Tutup dropdown kalau klik luar kotak carian
    document.addEventListener('click', function(e) {
        if (!searchBox.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection