@extends('admin.layouts.backend')

@section('title', 'Add New Recruiter')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Add New Recruiter</h1>
        <p class="text-muted">Create a new recruiter account</p>
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
                <form action="{{ route('admin.recruiters.store') }}" method="POST" id="recruiterForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label required">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter recruiter's full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter email address" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label required">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Enter password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label required">Confirm Password</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Confirm password" required>
                        </div>
                    </div>

                    <!-- Optional fields - only include if they exist in your database -->
                    @if(in_array('company', $fillableFields ?? []))
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                   id="company" name="company" value="{{ old('company') }}" 
                                   placeholder="Enter company name">
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" 
                                   placeholder="Enter phone number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.recruiters.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Create Recruiter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        <strong>Name</strong> and <strong>Email</strong> are required fields.
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-shield-lock text-primary me-2"></i>
                        Password must be at least 8 characters long.
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope text-primary me-2"></i>
                        Ensure the email address is valid and unique.
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-person-plus text-primary me-2"></i>
                        The recruiter will be able to login with these credentials.
                    </li>
                </ul>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Default Status:</strong> Active
                </div>
                <div class="mb-2">
                    <strong>Email Verification:</strong> Required
                </div>
                <div class="mb-2">
                    <strong>Login Access:</strong> Immediate
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
        
        // Validate password
        const password = $('#password').val();
        if (!password) {
            $('#password').addClass('is-invalid');
            $('#password').after('<div class="invalid-feedback">Password is required.</div>');
            isValid = false;
        } else if (password.length < 8) {
            $('#password').addClass('is-invalid');
            $('#password').after('<div class="invalid-feedback">Password must be at least 8 characters long.</div>');
            isValid = false;
        }
        
        // Validate password confirmation
        const passwordConfirmation = $('#password_confirmation').val();
        if (password !== passwordConfirmation) {
            $('#password_confirmation').addClass('is-invalid');
            $('#password_confirmation').after('<div class="invalid-feedback">Passwords do not match.</div>');
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

    // Real-time password strength check
    $('#password').on('input', function() {
        const password = $(this).val();
        const strengthIndicator = $('#password-strength');
        
        if (password.length === 0) {
            strengthIndicator.text('').removeClass('text-warning text-success');
        } else if (password.length < 8) {
            strengthIndicator.text('Weak - at least 8 characters needed').addClass('text-warning').removeClass('text-success');
        } else {
            strengthIndicator.text('Strong password').addClass('text-success').removeClass('text-warning');
        }
    });

    // Real-time password match check
    $('#password_confirmation').on('input', function() {
        const password = $('#password').val();
        const confirmPassword = $(this).val();
        
        if (confirmPassword.length === 0) {
            $(this).removeClass('is-valid is-invalid');
        } else if (password === confirmPassword) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid');
        }
    });
});
</script>

<style>
.required::after {
    content: " *";
    color: #dc3545;
}

/* Add some styling for password strength indicator */
#password-strength {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>
@endsection