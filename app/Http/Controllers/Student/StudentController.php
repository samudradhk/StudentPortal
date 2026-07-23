<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Students;
use App\Models\StudentScores;
use App\Services\StudentPredictionService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function detail($id){
        $data = Students::firstWhere('id', $id);
        $scores = StudentScores::with('course')->where('student_id', $id)->get();
        $takenCourseIds = $scores->pluck('course_id');
        $courses = Courses::whereNotIn('id', $takenCourseIds)->get();

        return view('students.detail', compact('data', 'courses', 'scores'));
    }

    public function showCreate(){
        return view('students.create');
    }

    public function insertStudent(Request $request){
        $validated = $request->validate([
            'student_name' => ['required'],
            'student_nim' => ['required', 'unique:students,nim', 'numeric', 'min:10'],
        ]);

        $process = Students::create([
            'name' => $validated['student_name'],
            'nim' => $validated['student_nim']
        ]);

        if($process){
            return redirect()->route('home')->with('success_message', __('main.messages.student_added'));
        }else {
            return back()->withInput()->with('error_message', __('main.messages.unknown_error'));
        }
    }

    public function showEdit($id){
        if($id == 0 || $id == null){
            return back();
        }

        $student = Students::where('id', $id)->first(); 

        return view('students.edit', compact('student'));
    }

    public function updateStudent($id, Request $request){
        $validated = $request->validate([
            'student_name' => ['required'],
            'student_nim' => ['required', 'unique:students,nim', 'numeric', 'min:10'],
        ]);
        
        if($id == 0 || $id == null){
            return back()->withInput();
        }

        $student = Students::firstWhere('id', $id);
        if($student == null){
            return back()->withInput();
        }

        $updatedData = [];
        $newName = $validated['student_name'];
        $newNIM = $validated['student_nim'];

        if($newName != $student->name){
            $updatedData['name'] = $newName;
        }

        if($newNIM != $student->nim){
            $updatedData['nim'] = $newNIM;
        }

        if(!empty($updatedData)){
            $student->update($updatedData);
            return redirect()->route('home');
        }

        return back()->withInput();
    }

    public function deleteStudent($id){
        if($id == 0 || $id == null){
            return back();
        }

        $student = Students::where('id', $id)->first();
        if($student != null){
            $student->delete();

            return redirect()->route('home');
        }

        return back();
    }

    public function insertScore(Request $request){
        $validated = $request->validate([
            'student_id' => ['required'],
            'course_id' => ['required'],
            'attendance' => ['numeric', 'min:0', 'max:100'],
            'assignment' => ['numeric', 'min:0', 'max:100'],
            'mid_exam' => ['numeric', 'min:0', 'max:100'],
            'final_exam' => ['numeric', 'min:0', 'max:100']
        ]);
        
        $student_id = $validated['student_id'];
        $course_id = $validated['course_id'];
        $attendance = $validated['attendance'];
        $assignment = $validated['assignment'];
        $mid_exam = $validated['mid_exam'];
        $final_exam = $validated['final_exam'];

        // Perhitungan otomatis di backend saat input baru
        $score = round(($attendance * 0.10) + ($assignment * 0.20) + ($mid_exam * 0.30) + ($final_exam * 0.40));

        $insertData = StudentScores::create([
            'student_id' => $student_id,
            'course_id' => $course_id,
            'score' => $score,
            'attendance' => $attendance,
            'assignment' => $assignment,
            'mid_exam' => $mid_exam,
            'final_exam' => $final_exam
        ]);

        if($insertData){
            return redirect()->route('students.detail', $student_id);
        }

        return back()->withInput();
    }

    public function predictScore($id, StudentPredictionService $service){
        $scores = StudentScores::where('student_id', $id)->get();
        $avg_attendance = $scores->avg('attendance');
        $avg_assignment = $scores->avg('assignment');
        $avg_mid_exam = $scores->avg('mid_exam');
        $avg_final_exam = $scores->avg('final_exam');

        $prediction = $service->predict(
            $avg_attendance, $avg_assignment, $avg_mid_exam, $avg_final_exam);
        
        $student = Students::where('id', $id)->first();
        
        $student->prediction = $prediction;
        $student->save();

        return redirect()->route('students.detail', $id)->with('success_message', __('main.messages.predicted'));
    }

    public function edit($id){
        $score = StudentScores::findOrFail($id);
        $data = Students::findOrFail($score->student_id);
        $courses = Courses::all();
        return view('detailStud.update', compact('score', 'data','courses'));
    }

    public function editNilai($id, Request $request){
        // Menghapus validasi 'score' karena tidak lagi dikirim dari user
        $validated = $request->validate([
            'attendance' => ['numeric', 'min:0', 'max:100'],
            'assignment' => ['numeric', 'min:0', 'max:100'],
            'mid_exam'   => ['numeric', 'min:0', 'max:100'],
            'final_exam' => ['numeric', 'min:0', 'max:100']
        ]);

        // Menghitung ulang nilai akhir secara otomatis
        $score = round(($validated['attendance'] * 0.10) + ($validated['assignment'] * 0.20) + ($validated['mid_exam'] * 0.30) + ($validated['final_exam'] * 0.40));

        $scoreRecord = StudentScores::findOrFail($id);

        $isUpdated = $scoreRecord->update([
            'score'      => $score, // Memasukkan hasil hitungan backend
            'attendance' => $validated['attendance'],
            'assignment' => $validated['assignment'],
            'mid_exam'   => $validated['mid_exam'],
            'final_exam' => $validated['final_exam']
        ]);

        if ($isUpdated) {
            return redirect()->route('students.detail', $scoreRecord->student_id)
                             ->with('success', __('main.messages.score_updated'));
        }

        return back()->withInput()->with('error', __('main.messages.score_failed'));
    }
}