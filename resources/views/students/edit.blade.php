@extends('layouts.master')
@section('title', __('main.ed.title'))

@section('content')
    <div class="dashboard-wrapper">
        @include('layouts.navbar')
        
        <div class="container mt-5">
            <div class="mb-4 d-flex justify-content-center">
                <div class="w-100" style="max-width: 600px;">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 fw-medium">
                        <i class="bi bi-arrow-left"></i> {{ __('main.ed.back') }}
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 600px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h4 class="fw-bold mb-0" style="color: #2d3748;">
                        <i class="bi bi-person-lines-fill me-2" style="color: #1f374a;"></i>{{ __('main.ed.header') }}
                    </h4>
                    <p class="text-muted small mt-1 mb-0">{{ __('main.ed.desc') }}</p>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{route('students.update', $student->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.ed.name_lbl') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                                <input value="{{old('student_name', $student->name)}}" class="form-control border-start-0 ps-0" name="student_name" type="text" required placeholder="{{ __('main.ed.name_plc') }}">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.ed.nim_lbl') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-123"></i></span>
                                <input value="{{old('student_nim', $student->nim)}}" class="form-control border-start-0 ps-0" name="student_nim" type="text" required placeholder="{{ __('main.ed.nim_plc') }}">
                            </div>
                        </div>
                        
                        @include('components.error_message')
                        
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                            <a href="{{ route('home') }}" class="btn btn-light px-4 rounded-3 shadow-sm fw-medium">{{ __('main.ed.cancel') }}</a>
                            <button type="submit" class="btn btn-theme d-inline-flex align-items-center gap-2 px-4 shadow-sm rounded-3">
                                <i class="bi bi-save"></i> {{ __('main.ed.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection