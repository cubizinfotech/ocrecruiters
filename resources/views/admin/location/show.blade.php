@extends('layouts.backend')

@section('title', 'Category Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Category Details</h1>
        <p class="text-muted">{{ $category->name }} {{ $category->name }}</p>
    </div>
    <div class="btn-group">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Category
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                   
                    <h5 class="mt-2 mb-0">{{ $category->name }} {{ $category->name }}</h5>
                </div>

                <div class="mb-3">
                    <strong><i class="bi bi-calendar me-2"></i>Created At:</strong><br>
                    <span class="text-muted">{{ $category->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit Category
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<style>
</style>
@endsection
