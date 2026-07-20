<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    // 1. nama table
    protected $table = 'students';

    // 2. field apa yg bisa diisi
    protected $fillable = [
        'name',
        'nim',
        'prediction'
    ];

    // 3. table relationship
    public function scores(){
        return $this->hasMany(StudentScores::class, 'student_id');
    }

    // 4. custom function
    public function getAverage(): float{
        $count = $this->scores->count();
        
        if($count == 0){
            return 0;
        }

        return round($this->scores->avg('score'), 2);
    }

}
