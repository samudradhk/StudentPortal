@extends('layouts.master')
@section('title', __('main.dt.title'))

@section('content')
    <div class="dashboard-wrapper">
        @include('layouts.navbar')
        
        <div class="container mt-5">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 65px; height: 65px; background-color: #e2e8f0;">
                            <i class="bi bi-person-fill fs-1" style="color: #4a5568;"></i>
                        </div>
                        
                        <div>
                            <h4 class="mb-1 fw-bold" style="color: #2d3748;">{{$data->name}}</h4>
                            <p class="mb-2 text-muted fw-medium"><i class="bi bi-person-badge me-1"></i> NIM: {{$data->nim}}</p>
                            
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-medium text-secondary" style="font-size: 0.9rem;">{{ __('main.dt.pred_lbl') }}</span>
                                @if(blank($data->prediction))
                                    <span class="badge bg-secondary rounded-pill px-3 py-1 shadow-sm">{{ __('main.dt.pred_none') }}</span>
                                @elseif($data->prediction)
                                    <span class="badge bg-danger rounded-pill px-3 py-1 shadow-sm">{{ __('main.dt.pred_fail') }}</span>
                                @else
                                    <span class="badge bg-success rounded-pill px-3 py-1 shadow-sm">{{ __('main.dt.pred_pass') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <form action="{{route('students.predict', $data->id)}}" method="post" class="m-0">
                            @csrf
                            <button class="btn btn-theme d-flex align-items-center gap-2 px-4 py-2 shadow-sm rounded-3">
                                <i class="bi bi-cpu fs-5"></i> {{ __('main.dt.btn_predict') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold mb-0" style="color: #2d3748;">
                        <i class="bi bi-plus-circle-fill me-2" style="color: #1f374a;"></i>{{ __('main.dt.add_score_title') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('students.score.insert')}}" method="post" class="row g-4">
                        @csrf
                        <input name="student_id" type="hidden" value="{{$data->id}}"/>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">{{ __('main.dt.course') }}</label>
                            <select name="course_id" class="form-select" required>
                                <option value="" disabled selected>{{ __('main.dt.sel_course') }}</option>
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{ $course->code }} - {{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">{{ __('main.dt.att') }}</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" name="attendance" class="form-control" required/>
                                <span class="input-group-text bg-light">%</span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">{{ __('main.dt.ass') }}</label>
                            <input type="number" min="0" max="100" name="assignment" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">{{ __('main.dt.mid') }}</label>
                            <input type="number" min="0" max="100" name="mid_exam" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">{{ __('main.dt.fin') }}</label>
                            <input type="number" min="0" max="100" name="final_exam" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary small">
                                {{ __('main.dt.score') }} (Auto)
                            </label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text border-0" style="background-color: #e2e8f0; color: #4a5568;">
                                    <i class="bi bi-calculator-fill"></i>
                                </span>
                                <input type="number" min="0" max="100" name="score" id="final_score_input" class="form-control border-0 fw-bold" readonly style="background-color: #f1f5f9; color: #2d3748; cursor: not-allowed;" required/>
                            </div>
                        </div>
                        
                        @include('components.error_message')
                        
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2 px-4 shadow-sm rounded-3">
                                <i class="bi bi-save"></i> {{ __('main.dt.btn_save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-5">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="text-uppercase" style="background-color: #fafafa; font-size: 0.85rem; color: #4a5568;">
                            <tr>
                                <th class="ps-4 py-3">{{ __('main.dt.th_course') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_att') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_ass') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_mid') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_fin') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_score') }}</th>
                                <th class="text-center py-3">{{ __('main.dt.th_grade') }}</th>
                                <th class="text-center py-3 pe-4">{{ __('main.dt.th_act') }}</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: 2px solid #edf2f7;">
                            @foreach ($scores as $score)
                                @php
                                    if ($score->score >= 90) $grade = 'A';
                                    elseif ($score->score >= 85) $grade = 'A-';
                                    elseif ($score->score >= 80) $grade = 'B+';
                                    elseif ($score->score >=75) $grade = 'B';
                                    elseif ($score->score >= 70) $grade = 'B-';
                                    elseif ($score->score >= 65) $grade = 'C';
                                    else $grade = 'D';
                                @endphp

                                <tr>
                                    <td class="ps-4 align-middle fw-medium" style="color: #2d3748;">
                                        {{$score->course->code}} - {{$score->course->name}}
                                    </td>
                                    <td class="text-center align-middle">{{$score->attendance}}%</td>
                                    <td class="text-center align-middle">{{$score->assignment}}</td>
                                    <td class="text-center align-middle">{{$score->mid_exam}}</td>
                                    <td class="text-center align-middle">{{$score->final_exam}}</td>
                                    <td class="text-center align-middle fw-bold">{{$score->score}}</td>
                                    <td class="text-center align-middle">
                                        <span class="badge rounded-circle d-inline-flex justify-content-center align-items-center" 
                                            style="width: 35px; height: 35px; font-size: 0.9rem;
                                            background-color: {{ in_array($grade, ['A', 'A-']) ? '#48bb78' : (in_array($grade, ['B+', 'B', 'B-']) ? '#4299e1' : (in_array($grade, ['C']) ? '#ecc94b' : '#f56565')) }};">
                                            {{$grade}}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle pe-4">
                                        <a href="{{ route('students.score.edit', $score->id) }}" class="btn btn-outline-warning btn-sm rounded-3 d-inline-flex align-items-center gap-1 px-3">
                                            <i class="bi bi-pencil-square"></i> {{ __('main.dt.btn_edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const attInput = document.querySelector('input[name="attendance"]');
            const assInput = document.querySelector('input[name="assignment"]');
            const midInput = document.querySelector('input[name="mid_exam"]');
            const finInput = document.querySelector('input[name="final_exam"]');
            const scoreInput = document.querySelector('input[name="score"]');

            function calculateFinalScore() {
                let att = parseFloat(attInput.value) || 0;
                let ass = parseFloat(assInput.value) || 0;
                let mid = parseFloat(midInput.value) || 0;
                let fin = parseFloat(finInput.value) || 0;

                let finalScore = (att * 0.10) + (ass * 0.20) + (mid * 0.30) + (fin * 0.40);
                
                scoreInput.value = Math.round(finalScore); 
            }

            [attInput, assInput, midInput, finInput].forEach(input => {
                if(input) {
                    input.addEventListener('input', calculateFinalScore);
                }
            });
        });
    </script>
@endsection