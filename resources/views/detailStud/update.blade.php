@extends('layouts.master')
@section('title', __('main.es.title'))

@section('content')
    <div class="dashboard-wrapper">
        @include('layouts.navbar')
        
        <div class="container mt-5">
            <!-- Tombol Back -->
            <div class="mb-4">
                <a href="{{ route('students.detail', $data->id) }}" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 fw-medium">
                    <i class="bi bi-arrow-left"></i> {{ __('main.es.back') }}
                </a>
            </div>

            <!-- Card Info Mahasiswa -->
            <div class="card shadow-sm border-0 rounded-4 mb-4" style="background-color: #f8f9fc;">
                <div class="card-body p-3 px-4 d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex justify-content-center align-items-center bg-white shadow-sm" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-fill fs-3" style="color: #4a5568;"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small fw-medium">{{ __('main.es.subtitle') }}</p>
                        <h5 class="mb-0 fw-bold" style="color: #2d3748;">{{$data->name}} <span class="fs-6 text-secondary fw-normal ms-1">({{$data->nim}})</span></h5>
                    </div>
                </div>
            </div>
            
            <!-- Card Form Edit Score -->
            <div class="card shadow-sm border-0 rounded-4 mb-5">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold mb-0" style="color: #2d3748;">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>{{ __('main.es.header') }}
                    </h5>
                    <p class="text-muted small mt-1 mb-0">{{ __('main.es.desc') }}</p>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{route('students.score.update', $score->id)}}" method="post" class="row g-4">
                        @csrf
                        @method('PUT') 
                        
                        <!-- Data wajib yang dikirim secara tersembunyi -->
                        <input name="student_id" type="hidden" value="{{$data->id}}"/>
                        <input name="course_id" type="hidden" value="{{$score->course_id}}"/>
                        
                        <!-- Course (Locked) -->
                        <div class="col-md-12">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.course') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-book"></i></span>
                                <select class="form-select border-start-0 ps-0 bg-light text-muted" disabled style="cursor: not-allowed;">
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}" {{ $score->course_id == $course->id ? 'selected' : '' }}>
                                            {{ $course->code }} - {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock-fill"></i></span>
                            </div>
                        </div>
                        
                        <!-- Input Nilai -->
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.att') }}</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" name="attendance" class="form-control" value="{{old('attendance', $score->attendance)}}" required/>
                                <span class="input-group-text bg-light">%</span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.ass') }}</label>
                            <input type="number" min="0" max="100" name="assignment" class="form-control" value="{{old('assignment', $score->assignment)}}" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.mid') }}</label>
                            <input type="number" min="0" max="100" name="mid_exam" class="form-control" value="{{old('mid_exam', $score->mid_exam)}}" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.fin') }}</label>
                            <input type="number" min="0" max="100" name="final_exam" class="form-control" value="{{old('final_exam', $score->final_exam)}}" required/>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.es.score') }}</label>
                            <input type="number" min="0" max="100" name="score" class="form-control" value="{{old('score', $score->score)}}" required/>
                        </div>
                        
                        <div class="col-12">
                            @include('components.error_message')
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="col-12 mt-4 pt-3 border-top d-flex justify-content-end gap-3">
                            <a href="{{ route('students.detail', $data->id) }}" class="btn btn-light px-4 rounded-3 shadow-sm fw-medium">{{ __('main.es.cancel') }}</a>
                            <button type="submit" class="btn btn-warning d-inline-flex align-items-center gap-2 px-4 shadow-sm rounded-3 fw-medium">
                                <i class="bi bi-save"></i> {{ __('main.es.btn_update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection