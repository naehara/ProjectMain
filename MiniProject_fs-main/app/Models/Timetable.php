<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'course_id',
        'room_id',
        'session_id',
        'class_name',
        'day',
        'time_start',
        'time_end',
    ];

    protected $guarded = [];

    // Relationship ke Course
    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    // Relationship ke Repeat Student
    public function repeatStudents()
    {
        return $this->belongsTo(RepeatStudent::class, 'student_id', 'id');
    }

    // Relationship ke Lecturer (guna lect_id)
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lect_id', 'id');
    }

    // Relationship ke Room
    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
