@extends('layouts.master')
@section('title', __('main.home.title'))

@section('content')
    <div class="dashboard-wrapper">
        @include('layouts.navbar')

        <div class="container mt-5">
            @if (session('success_message'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    {{session('success_message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                <div>
                    <h3 class="mb-2" style="color: #2d3748;">
                        {{__('main.home.welcome')}} <span class="fw-bold">{{Auth::user()->name}}!</span>
                    </h3>
                    <span class="badge rounded-pill role-badge px-3 py-2 shadow-sm">
                        {{__('main.home.role')}}: <span class="fw-bold">{{session('role')}}</span>
                    </span>
                </div>
                
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-3">
                        <a href="{{route('students.create')}}" class="btn btn-theme d-flex align-items-center gap-2 px-3">
                            <span class="fw-bold fs-5">+</span> {{__('main.home.adstud')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: #ffffff;">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width: 60px; height: 60px; background-color: #e2e8f0;">
                                <i class="bi bi-people-fill fs-2" style="color: #1f374a;"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-secondary fw-medium" style="font-size: 0.9rem;">{{__('main.home.ts')}}</p>
                                <h3 class="mb-0 fw-bold" style="color: #2d3748;">{{$totalStudents}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: #ffffff;">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width: 60px; height: 60px; background-color: #e2e8f0;">
                                <i class="bi bi-bar-chart-line-fill fs-2" style="color: #1f374a;"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-secondary fw-medium" style="font-size: 0.9rem;">{{__('main.home.ave')}}</p>
                                <h3 class="mb-0 fw-bold" style="color: #2d3748;">{{$overallAvg}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: #ffffff;">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width: 60px; height: 60px; background-color: #d1fae5;">
                                <i class="bi bi-cpu-fill fs-2" style="color: #059669;"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-secondary fw-medium" style="font-size: 0.9rem;">{{__('main.home.ptp')}}</p>
                                <h3 class="mb-0 fw-bold" style="color: #2d3748;">{{$predictedLulus}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-5">
                <div class="card-body p-0">
                    <table class="table table-custom table-hover mb-0">
                        <thead class="text-uppercase" style="background-color: #fafafa;">
                            <tr>
                                <th class="ps-4">{{__('main.home.no')}}</th>
                                <th>Nama</th>
                                <th class="text-center">{{__('main.home.ave')}}</th>
                                <th class="text-center">{{__('main.home.st')}}</th>
                                <th class="text-center">{{__('main.home.pred')}}</th>
                                <th class="text-center">{{__('main.home.ac')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $s)
                                @php
                                    $avg = $s->getAverage();
                                @endphp
                                <tr>
                                    <td class="ps-4">{{$loop->iteration}}</td>
                                    <td class="fw-medium" style="color: #2d3748;">
                                        {{$s->name}}
                                    </td>
                                    
                                    <td class="text-center">{{$avg}}</td>
                                    
                                    <td class="text-center">
                                        @if ($avg >= 65)
                                            <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">{{__('main.home.ll')}}</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">{{__('main.home.gg')}}</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($s->prediction === 1 || $s->prediction === '1')
                                            <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">{{__('main.home.gg')}}</span>
                                        @elseif ($s->prediction === 0 || $s->prediction === '0')
                                            <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">{{__('main.home.ll')}}</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3 py-2 shadow-sm">{{__('main.home.bl')}}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            
                                            <a href="{{route('students.detail', $s->id)}}" class="btn btn-outline-info btn-sm rounded-3 d-flex align-items-center gap-1 px-3">
                                                <i class="bi bi-file-earmark-plus"></i> {{__('main.home.dt')}}
                                            </a>

                                            <a href="{{route('students.edit', $s->id)}}" class="btn btn-outline-warning btn-sm rounded-3 d-flex align-items-center gap-1 px-3">
                                                <i class="bi bi-pencil-square"></i> {{__('main.home.ed')}}
                                            </a>
                                            
                                            <form action="{{route('students.delete', $s->id)}}" method="post" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 d-flex align-items-center gap-1 px-3" onclick="return confirm('{{ __('main.messages.del_confirm') }}')">
                                                    <i class="bi bi-trash"></i> {{__('main.home.del')}}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection