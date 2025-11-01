@extends('admin.layouts.backend')

@section('title', 'Edit Recruiter')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Edit Recruiter</h1>
        <p class="text-muted">Update recruiter information</p>
    </div>
    <a href="{{ route('admin.recruiters.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Recruiters
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recruiter Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.recruiters.update', $recruiter) }}" method="POST" id="recruiterForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label required">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $recruiter->name) }}" 
                                   placeholder="Enter recruiter name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $recruiter->email) }}" 
                                   placeholder="Enter email address" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.recruiters.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Update Recruiter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recruiter Details</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID:</strong><br>
                    <span class="text-muted">{{ $recruiter->id }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Email Verified:</strong><br>
                    @if($recruiter->email_verified_at)
                        <span class="badge bg-success">Verified on {{ $recruiter->email_verified_at->format('M d, Y') }}</span>
                    @else
                        <span class="badge bg-warning">Not Verified</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Login Provider:</strong><br>
                    @if($recruiter->provider)
                        <span class="badge bg-info">{{ ucfirst($recruiter->provider) }}</span>
                    @else
                        <span class="badge bg-secondary">Email Registration</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <span class="text-muted">{{ $recruiter->created_at->format('M d, Y \a\t h:i A') }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <span class="text-muted">{{ $recruiter->updated_at->format('M d, Y \a\t h:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Form validation
    $('#recruiterForm').on('submit', function(e) {
        let isValid = true;
        
        // Clear previous error states
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Validate name
        if (!$('#name').val().trim()) {
            $('#name').addClass('is-invalid');
            $('#name').after('<div class="invalid-feedback">Name is required.</div>');
            isValid = false;
        }
        
        // Validate email
        const email = $('#email').val().trim();
        if (!email) {
            $('#email').addClass('is-invalid');
            $('#email').after('<div class="invalid-feedback">Email is required.</div>');
            isValid = false;
        } else if (!isValidEmail(email)) {
            $('#email').addClass('is-invalid');
            $('#email').after('<div class="invalid-feedback">Please enter a valid email address.</div>');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            $('.is-invalid').first().focus();
        }
    });
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
</script>

<style>
.required::after {
    content: " *";
    color: #dc3545;
}
</style>
@endsection