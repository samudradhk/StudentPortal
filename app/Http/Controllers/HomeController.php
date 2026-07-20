<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(){
        $students = Students::get();

        $totalStudents = $students->count();
        $overallAvg = $totalStudents > 0 
            ? round($students->avg(fn($s) => $s->getAverage()), 2) 
            : 0;
        $predictedLulus = $students->filter(fn($s) => $s->prediction === 0 || $s->prediction === '0')->count();
        return view('home', compact('students', 'totalStudents', 'overallAvg', 'predictedLulus'));
    }
}
