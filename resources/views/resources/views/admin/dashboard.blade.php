@extends('admin.layouts.backend')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Here's what's new with your recruiting platform.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Recruiters</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalRecruiter ?? '' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-people-fill fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card stat-card-success card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Category</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalCategroy ?? '' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-cart3 fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card stat-card-warning card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Location</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalLocation ?? '' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-map fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card stat-card-danger card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total State</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalState ?? '' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-map fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-4">
        <div class="card stat-card stat-card-info card-hover h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total City</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalCity ?? '' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-map fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

@endsection
