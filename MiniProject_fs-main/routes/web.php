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
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/repeats', [AdminController::class, 'repeats'])->name('repeats');
        Route::get('/lecturers', [AdminController::class, 'lecturers'])->name('lecturers');
        Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
        Route::get('/repeats', [AdminController::class, 'repeats'])->name('repeats');
        Route::get('/repeats/{id}/edit', [AdminController::class, 'editRepeat'])->name('repeats.edit');
        Route::put('/repeats/{id}', [AdminController::class, 'updateRepeat'])->name('repeats.update'); // Tambah ini
        Route::delete('/repeats/{id}', [AdminController::class, 'destroyRepeat'])->name('repeats.destroy');
    });

    // Modul Lecturer
   Route::middleware(['auth'])->group(function () {

    // Modul Lecturer
    Route::prefix('lecturer')->name('lecturer.')->group(function () {
        Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
        Route::post('/availability', [LecturerController::class, 'updateAvailability'])->name('availability.update');
    });

    });

    // Modul Student
  Route::prefix('student')->name('student.')->group(function () {
    // 1. Dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    
    // 2. Papar Borang Repeat (TAMBAH ROUTE NI)
    Route::get('/student.repeat-form', [StudentController::class, 'showRepeatForm'])->name('repeat.form'); 

    // 3. Simpan Data Borang
    Route::post('/repeat', [StudentController::class, 'submitRepeatForm'])->name('repeat.store');
});
});