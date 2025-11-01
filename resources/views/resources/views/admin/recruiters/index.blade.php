@extends('admin.layouts.backend')

@section('title', 'Recruiters')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Recruiters</h1>
            <p class="text-muted">Manage your recruiters database</p>
        </div>
        <div class="">
            <a href="{{ route('admin.recruiters.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New Recruiter
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 position-relative">
        <div class="card-header d-flex justify-content-center align-items-center d-md-none position-relative">
            <span class="fw-semibold">Filters</span>
            <button class="filter-toggle filter-icon" type="button" data-bs-toggle="collapse"
                data-bs-target="#recruiterFilter" aria-expanded="false" aria-controls="recruiterFilter"
                title="Toggle Filters">
                <i class="bi bi-funnel"></i>
            </button>
        </div>
        <div id="recruiterFilter" class="card-body collapse d-md-block">
            <form method="GET" action="{{ route('admin.recruiters.index') }}" class="row g-3">
                <div class="col-md-10">
                    <label for="search" class="form-label">Search Recruiters</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email">
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
                        <a href="{{ route('admin.recruiters.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @if($recruiters->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Provider</th>
                                <th>Email Verified</th>
                                <th>Created At</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recruiters as $recruiter)
                                <tr>
                                    <td>{{ $recruiter->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-white"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $recruiter->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $recruiter->email }}</td>
                                    <td>
                                        @if($recruiter->provider)
                                            <span class="badge bg-info">{{ ucfirst($recruiter->provider) }}</span>
                                        @else
                                            <span class="badge bg-secondary">Email</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($recruiter->email_verified_at)
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $recruiter->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="View">
                                                <a href="{{ route('admin.recruiters.show', $recruiter->id) }}"
                                                    class="btn btn-sm btn-outline-info btn-action">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                            <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <a href="{{ route('admin.recruiters.edit', $recruiter->id) }}"
                                                    class="btn btn-sm btn-outline-warning btn-action">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-action"
                                                    onclick="confirmDelete('{{ route('admin.recruiters.destroy', $recruiter->id) }}', 'Delete Recruiter', 'Are you sure you want to delete this recruiter? This action cannot be undone.')">
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
                        Showing {{ $recruiters->firstItem() }} to {{ $recruiters->lastItem() }} of {{ $recruiters->total() }}
                        results
                    </div>
                    <div class="">
                        {{ $recruiters->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">No recruiters found</h4>
                    <p class="text-muted">Get started by adding your first recruiter.</p>
                    <a href="{{ route('admin.recruiters.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add First Recruiter
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(url, title, message) {
            if (confirm(message)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <style>
        .bg-primary {
            background-color: #007bff !important;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    </style>
@endsection