@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="header-title">Add New Student</h1>
            <p class="text-muted">Create a new student account with all required information</p>
        </div>
        <div>
            <a href="{{ route('teacher.students') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Students
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Main Form Card -->
            <div class="card mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Student Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.students.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-medium">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" 
                                        id="name" name="name" value="{{ old('name') }}" placeholder="Enter student's full name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ old('email') }}" placeholder="Enter student's email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                        id="password" name="password" placeholder="Create a secure password" required>
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Password must be at least 8 characters with letters and numbers.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-medium">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 ps-0" 
                                        id="password_confirmation" name="password_confirmation" placeholder="Repeat the password" required>
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleConfirmPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="course" class="form-label fw-medium">Assigned Course <span class="text-danger">*</span></label>
                                <select class="form-select @error('course') is-invalid @enderror" id="course" name="course" required>
                                    <option value="" selected disabled>Select a course...</option>
                                    <option value="1">Web Development Fundamentals</option>
                                    <option value="2">Mobile App Design</option>
                                    <option value="3">Data Science Basics</option>
                                    <option value="4">UI/UX Design Principles</option>
                                </select>
                                @error('course')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-medium">Account Status</label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="status" id="statusActive" value="active" checked>
                                        <label class="form-check-label" for="statusActive">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusPending" value="pending">
                                        <label class="form-check-label" for="statusPending">
                                            Pending
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="sendWelcomeEmail" name="sendWelcomeEmail" value="1" checked>
                            <label class="form-check-label" for="sendWelcomeEmail">
                                Send welcome email with login instructions
                            </label>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('teacher.students') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <div>
                                <button type="reset" class="btn btn-light me-2">
                                    <i class="fas fa-redo me-2"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i> Create Student Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Help Card -->
            {{-- <div class="card mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Help & Tips</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-lightbulb text-primary"></i>
                        </div>
                        <h6>Strong Passwords</h6>
                        <p class="text-muted small">Encourage students to use strong passwords with at least 8 characters, uppercase letters, numbers, and special characters.</p>
                    </div>
                    
                    <div class="mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-envelope text-success"></i>
                        </div>
                        <h6>Welcome Email</h6>
                        <p class="text-muted small">Students will receive an automated welcome email with login instructions if the option is checked.</p>
                    </div>
                    
                    <div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2 d-inline-block mb-2">
                            <i class="fas fa-user-edit text-info"></i>
                        </div>
                        <h6>Profile Completion</h6>
                        <p class="text-muted small">Students can complete their profile details after the initial account setup.</p>
                    </div>
                </div>
            </div> --}}
            
            <!-- Bulk Import Card -->
            <div class="card">
                <div class="card-body">
                    <div class="text-center py-3">
                        <div class="rounded-circle bg-light p-3 d-inline-block mb-3">
                            <i class="fas fa-file-upload fa-2x text-primary"></i>
                        </div>
                        <h5>Need to add multiple students?</h5>
                        <p class="text-muted">Save time by importing students in bulk using CSV or Excel files.</p>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-file-import me-2"></i> Bulk Import
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Toggle confirm password visibility
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordConfirm = document.getElementById('password_confirmation');
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirm.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Password strength validation
    const passwordInput = document.getElementById('password');
    
    passwordInput.addEventListener('input', function() {
        const value = this.value;
        // Add custom validation logic here if needed
    });
});
</script>
@endsection