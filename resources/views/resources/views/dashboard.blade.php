@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Here's what's new with your recruiting platform.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    {{-- <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold mb-1">Total rating</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $ratingTotal->rating ?? '-' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-star fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card stat-card-success card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold mb-1">Total Recruiters</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalRecruiter ?? '-' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-person fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
