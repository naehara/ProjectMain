<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepeatStudent extends Model
{
    use HasFactory;

    public $timestamps = false; // Matikan timestamps jika tiada created_at / updated_at

    protected $fillable = [
        'student_matric',
        'student_name',
        'course_id',
        'academic_session_id',
        'reason',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
    }
}
