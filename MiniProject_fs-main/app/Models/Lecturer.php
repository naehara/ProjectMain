<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model {

    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'name',
        'email',
        'day',
        'course',
    ];
}
