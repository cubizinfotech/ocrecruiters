@extends('admin.layouts.backend')

@section('title', 'Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        <p class="text-muted">Manage your category database</p>
    </div>
    <div class="">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Category
        </a>
    </div>
</div>

<div class="card shadow mb-4 position-relative">
    <div class="card-header d-flex justify-content-center align-items-center d-md-none position-relative">
        <span class="fw-semibold">Filters</span>
        <button class="filter-toggle filter-icon" type="button" data-bs-toggle="collapse" data-bs-target="#categoryFilter" aria-expanded="false" aria-controls="categoryFilter" title="Toggle Filters">
            <i class="bi bi-funnel"></i>
        </button>
    </div>
    <div id="categoryFilter" class="card-body collapse d-md-block">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
            <div class="col-md-10">
                <label for="search" class="form-label">Search Categories</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by name">
            </div>
            <div class="col-6 col-md-1">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>
            </div>
            <div class="col-6 col-md-1">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <div class="d-grid">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    {{-- <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
        <div class="d-flex gap-2">
            <!-- Export Excel Button -->
            <a href="{{ route('customers.export', ['type' => 'excel'] + request()->all()) }}"
                class="btn btn-sm btn-outline-success tooltip-custom" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Export Customers to Excel"
            >
                <i class="bi bi-file-earmark-excel me-1"></i> Excel
            </a>

            <!-- Export PDF Button -->
            <a href="{{ route('customers.export', ['type' => 'pdf'] + request()->all()) }}"
                class="btn btn-sm btn-outline-danger tooltip-custom" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Export Customers to PDF"
            >
                <i class="bi bi-file-earmark-pdf me-1"></i> PDF
            </a>
        </div>
    </div> --}}

    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="fw-bold">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td>{{ $category->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="View">
                                        <a href="{{ route('admin.categories.show', $category) }}" 
                                           class="btn btn-sm btn-outline-info btn-action">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                    <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="btn btn-sm btn-outline-warning btn-action">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger btn-action"
                                                onclick="confirmDelete(`{{ route('admin.categories.destroy', $category) }}`, 'Delete Category', 'Are you sure you want to delete this category? This action cannot be undone.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                </div>
                <div class="">
                    {{ $categories->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">No categories found</h4>
                <p class="text-muted">Get started by adding your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add First Category
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
</style>
@endsection
