<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;

// Route Asas & Autentikasi
Route::get('/', function () { 
    return redirect('/login'); 
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route yang Memerlukan Log Masuk (Auth)
Route::middleware(['auth'])->group(function () {

    // Modul Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/timetables', [AdminController::class, 'timetables'])->name('timetables');
        Route::get('/repeats', [AdminController::class, 'repeats'])->name('repeats');
        Route::get('/lecturers', [AdminController::class, 'lecturers'])->name('lecturers');
       
        Route::get('/repeats', [AdminController::class, 'repeats'])->name('repeats');
        Route::get('/repeats/{id}/edit', [AdminController::class, 'editRepeat'])->name('repeats.edit');
        Route::put('/repeats/{id}', [AdminController::class, 'updateRepeat'])->name('repeats.update'); // Tambah ini

        Route::delete('/repeats/{id}', [AdminController::class, 'destroyRepeat'])->name('repeats.destroy');
        Route::post('/timetables/store', [AdminController::class, 'storeTimetable'])->name('timetables.store');
        Route::delete('/timetables/{id}', [AdminController::class, 'destroyTimetable'])->name('timetables.destroy');

        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');   
        Route::post('/repeats', [AdminController::class, 'storeRepeat'])->name('repeats.store');

        Route::post('/lecturers', [AdminController::class, 'storeLecturer'])->name('lecturers.store');
        Route::put('/lecturers/{id}', [AdminController::class, 'updateLecturer'])->name('lecturers.update');
        Route::delete('/lecturers/{id}', [AdminController::class, 'destroyLecturer'])->name('lecturers.destroy');
        Route::get('/lecturer/timetable', [App\Http\Controllers\LecturerController::class, 'schedule'])->name('lecturer.schedule');
        Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
        Route::post('/rooms', [AdminController::class, 'storeRoom'])->name('rooms.store');
        Route::put('/rooms/{id}', [AdminController::class, 'updateRoom'])->name('rooms.update');
        Route::delete('/rooms/{id}', [AdminController::class, 'destroyRoom'])->name('rooms.destroy');

        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::post('/lecturers/{id}/assign-courses', [AdminController::class, 'assignCoursesToLecturer'])->name('lecturers.assignCourses');
        Route::get('/global-search', [AdminController::class, 'globalSearch'])->name('global.search');

         });

    // Modul Lecturer
        Route::middleware(['auth'])->group(function () {

    // Modul Lecturer
       Route::prefix('lecturer')->name('lecturer.')->group(function () {
        Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
        Route::get('/timetable', [LecturerController::class, 'timetable'])->name('timetable');
        Route::get('/availability', [LecturerController::class, 'availability'])->name('availability');
        Route::post('/availability', [LecturerController::class, 'updateAvailability'])->name('availability.update');
        Route::get('/profile', [LecturerController::class, 'profile'])->name('profile');
        Route::get('/schedule', [LecturerController::class, 'schedule'])->name('schedule');

    });

    });

    // Modul Student
    Route::prefix('student')->name('student.')->group(function () {
        // 1. Dashboard
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        
        // 2. Papar Borang Repeat
        Route::get('/repeat-form', [StudentController::class, 'showRepeatForm'])->name('repeat_form'); 

        // 3. Simpan Data Borang
        Route::post('/repeat', [StudentController::class, 'submitRepeatForm'])->name('repeat.store');

        // 5. My Profile Routes (Baru)
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');
        
        // 6. My Timetable Routes (Baru - Dual input: Upload gambar or manual)
        Route::get('/timetable', [StudentController::class, 'timetable'])->name('timetable');
        Route::post('/timetable/store', [StudentController::class, 'storeTimetable'])->name('timetable.store');
    });

});