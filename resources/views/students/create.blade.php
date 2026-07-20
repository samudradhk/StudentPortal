@extends('layouts.master')
@section('title', __('main.ct.title'))

@section('content')
    <div class="dashboard-wrapper">
        @include('layouts.navbar')
        
        <div class="container mt-5">
            <div class="mb-4 d-flex justify-content-center">
                <div class="w-100" style="max-width: 600px;">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 fw-medium">
                        <i class="bi bi-arrow-left"></i> {{ __('main.ct.back') }}
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 600px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h4 class="fw-bold mb-0" style="color: #2d3748;">
                        <i class="bi bi-person-plus-fill me-2" style="color: #1f374a;"></i>{{ __('main.ct.header') }}
                    </h4>
                    <p class="text-muted small mt-1 mb-0">{{ __('main.ct.desc') }}</p>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{route('students.insert')}}" method="post">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.ct.name_lbl') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                                <input value="{{old('student_name')}}" class="form-control border-start-0 ps-0" name="student_name" type="text" required placeholder="{{ __('main.ct.name_plc') }}">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{ __('main.ct.nim_lbl') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-123"></i></span>
                                <input value="{{old('student_nim')}}" class="form-control border-start-0 ps-0" name="student_nim" type="number" required placeholder="{{ __('main.ct.nim_plc') }}">
                            </div>
                        </div>
                        
                        @include('components.error_message')
                        
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                            <a href="{{ route('home') }}" class="btn btn-light px-4 rounded-3 shadow-sm fw-medium">{{ __('main.ct.cancel') }}</a>
                            
                            <button type="submit" class="btn btn-theme d-inline-flex align-items-center gap-2 px-4 shadow-sm rounded-3">
                                <i class="bi bi-plus-lg"></i> {{ __('main.ct.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection