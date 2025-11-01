@extends('admin.layouts.backend')

@section('title', 'Recruiter Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Recruiter Details</h1>
            <p class="text-muted">View detailed information about the recruiter</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('recruiters.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Recruiters
            </a>
        </div>
    </div>

    <!-- Debug Information Card (You can remove this later) -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white py-3">
            <h6 class="m-0 font-weight-bold">
                <i class="bi bi-bug me-2"></i>Debug Information
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Variable exists:</strong>
                        <span class="badge bg-{{ isset($recruiter) ? 'success' : 'danger' }}">
                            {{ isset($recruiter) ? 'YES' : 'NO' }}
                        </span>
                    </p>
                    @if(isset($recruiter))
                        <p><strong>Data Type:</strong> <code>{{ get_class($recruiter) }}</code></p>
                        <p><strong>Recruiter ID:</strong> <span class="badge bg-primary">{{ $recruiter->id }}</span></p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if(isset($recruiter))
                        <p><strong>Recruiter Name:</strong> {{ $recruiter->name }}</p>
                        <p><strong>Recruiter Email:</strong> {{ $recruiter->email }}</p>
                    @else
                        <p class="text-danger"><strong>ERROR: $recruiter variable is not set!</strong></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($recruiter))
        <div class="row">
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-person-badge me-2"></i>Profile Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="mt-3 mb-1">{{ $recruiter->name }}</h5>
                            <p class="text-muted">{{ $recruiter->email }}</p>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-envelope me-2"></i>Email:</strong><br>
                            <span class="text-muted">{{ $recruiter->email }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-shield-check me-2"></i>Email Verification:</strong><br>
                            @if($recruiter->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>Verified on
                                    {{ $recruiter->email_verified_at->format('M d, Y') }}
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Not Verified
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-box-arrow-in-right me-2"></i>Login Provider:</strong><br>
                            @if($recruiter->provider)
                                <span class="badge bg-info">{{ ucfirst($recruiter->provider) }}</span>
                            @else
                                <span class="badge bg-secondary">Email Registration</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Account Details Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i>Account Details
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="bi bi-calendar-plus me-2"></i>Created At:</strong><br>
                            <span class="text-muted">{{ $recruiter->created_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-calendar-check me-2"></i>Updated At:</strong><br>
                            <span class="text-muted">{{ $recruiter->updated_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-database me-2"></i>User ID:</strong><br>
                            <span class="text-muted font-monospace">{{ $recruiter->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-lightning me-2"></i>Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('recruiters.edit', $recruiter) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-1"></i> Edit Recruiter
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Statistics Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-graph-up me-2"></i>User Statistics
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <i class="bi bi-people fs-1 text-primary"></i>
                                    <h4 class="mt-2 mb-1">{{ $recruiter->customers->count() }}</h4>
                                    <p class="text-muted mb-0">Customers</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <i class="bi bi-cart fs-1 text-success"></i>
                                    <h4 class="mt-2 mb-1">{{ $recruiter->orders->count() }}</h4>
                                    <p class="text-muted mb-0">Orders</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <i class="bi bi-credit-card fs-1 text-info"></i>
                                    <h4 class="mt-2 mb-1">{{ $recruiter->payments->count() }}</h4>
                                    <p class="text-muted mb-0">Payments</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <i class="bi bi-file-earmark-text fs-1 text-warning"></i>
                                    <h4 class="mt-2 mb-1">{{ $recruiter->resume ? '1' : '0' }}</h4>
                                    <p class="text-muted mb-0">Resumes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i>Additional Information
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($recruiter->company || $recruiter->phone || $recruiter->address)
                            @if($recruiter->company)
                                <div class="mb-3">
                                    <strong><i class="bi bi-building me-2"></i>Company:</strong><br>
                                    <span class="text-muted">{{ $recruiter->company }}</span>
                                </div>
                            @endif

                            @if($recruiter->phone)
                                <div class="mb-3">
                                    <strong><i class="bi bi-telephone me-2"></i>Phone:</strong><br>
                                    <span class="text-muted">{{ $recruiter->phone }}</span>
                                </div>
                            @endif

                            @if($recruiter->address)
                                <div class="mb-3">
                                    <strong><i class="bi bi-geo-alt me-2"></i>Address:</strong><br>
                                    <span class="text-muted">{{ $recruiter->address }}</span>
                                </div>
                            @endif

                            @if($recruiter->website)
                                <div class="mb-3">
                                    <strong><i class="bi bi-globe me-2"></i>Website:</strong><br>
                                    <a href="{{ $recruiter->website }}" target="_blank" class="text-primary">
                                        {{ $recruiter->website }}
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
                                <p class="mt-3">No additional information available</p>
                                <small>Edit the recruiter to add more details</small>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Resume Information Card -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-file-earmark-person me-2"></i>Resume Information
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($recruiter->resume)
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                Resume uploaded and available
                            </div>
                            <!-- You can add more resume details here when available -->
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                No resume uploaded yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
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

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
    </style>
@endsection