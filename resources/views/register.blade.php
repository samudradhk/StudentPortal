@extends('layouts.master')
@section('title', __('main.rg.title'))

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-white" style="background-color: #1f374a; min-height: 100vh;">
                <div class="text-center px-5">
                    <h1 class="fw-bold display-5 mb-3" style="letter-spacing: 1px;">STUDENT<span style="opacity: 0.8;">PORTAL</span></h1>
                    <p class="fs-5 text-light" style="opacity: 0.85;">
                        {{__('main.rg.desc')}}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 vh-100 overflow-auto d-flex justify-content-center align-items-center" style="background-color: #f8f9fc;">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-sm-5 my-4" style="width: 100%; max-width: 500px;">
                    <div class="position-absolute top-0 end-0 p-4 z-3">
                    <div class="dropdown">
                        <button class="btn btn-white bg-white shadow-sm border-0 dropdown-toggle rounded-pill px-3 fw-medium text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe me-1"></i> {{ strtoupper(App::getLocale()) }}
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2">
                            <li>
                                <a class="dropdown-item py-2 fw-medium {{ App::getLocale() == 'id' ? 'active' : '' }}" href="{{ route('language.switch', 'id') }}">
                                    <span class="me-2">🇮🇩</span>Indonesia
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 fw-medium {{ App::getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                                    <span class="me-2">🇬🇧</span>English
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                    <div class="text-center mb-4 d-lg-none">
                        <h2 class="fw-bold" style="color: #1f374a;">STUDENT<span class="text-secondary">PORTAL</span></h2>
                    </div>

                    <div class="mb-4">
                        <h3 class="fw-bold" style="color: #2d3748;">{{__('main.rg.rg')}}</h3>
                        <p class="text-muted small">{{__('main.rg.desc_rg')}}</p>
                    </div>

                    <form method="POST" action="{{route('register.do')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary small mb-1">{{__('main.rg.name')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                                <input value="{{old('name')}}" name="name" type="text" class="form-control border-start-0 ps-0 form-control-lg fs-6" placeholder="{{__('main.rg.name_desc')}}" required autofocus/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary small mb-1">{{__('main.rg.email')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                <input value="{{old('email')}}" name="email" type="email" class="form-control border-start-0 ps-0 form-control-lg fs-6" placeholder="{{__('main.rg.email_desc')}}" required/>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary small mb-1">{{__('main.rg.pass')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                                <input name="password" id="regPassword" type="password" class="form-control border-start-0 border-end-0 ps-0 form-control-lg fs-6" placeholder="{{__('main.rg.pass_desc')}}" required/>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small mb-1">{{__('main.rg.confpass')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock-fill"></i></span>
                                <input name="password_confirmation" id="regConfirm" type="password" class="form-control border-start-0 border-end-0 ps-0 form-control-lg fs-6" placeholder="{{__('main.rg.confpass_desc')}}" required/>
                               
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 small" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" style="padding: 1rem;" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-theme w-100 btn-lg fs-6 fw-medium shadow-sm py-2 mb-3" style="background-color: #1f374a; color: white;">
                                <i class="bi bi-person-plus me-2"></i> {{__('main.rg.ra')}}
                            </button>
                            
                            <div class="text-center mt-3">
                                <span class="text-muted small">{{__('main.rg.bt_login')}}</span>
                                <a href="{{route('login')}}" class="text-decoration-none fw-bold ms-1" style="color: #3182ce;">
                                    {{__('main.rg.lg')}}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection