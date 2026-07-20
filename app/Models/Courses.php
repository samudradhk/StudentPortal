<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'code'
    ];

    public function scores(){
        return $this->hasMany(StudentScores::class, 'course_id');
    }
}
