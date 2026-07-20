<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScores extends Model
{
    protected $table = 'scores';
    protected $fillable = [
        'student_id',
        'course_id',
        'score',
        'attendance',
        'assignment',
        'mid_exam',
        'final_exam'
    ];

    public function course(){
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function students(){
        return $this->belongsTo(Students::class, 'student_id');
    }
}
