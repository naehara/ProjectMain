<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
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
}
