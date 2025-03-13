@extends('layouts.student')

@section('content')
<div class="container-fluid p-0">
    <!-- Breadcrumb & Title Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('student.assignments') }}">Assignments</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($assignment->title, 30) }}</li>
                                </ol>
                            </nav>
                            <h2 class="mb-1">{{ $assignment->title }}</h2>
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                <span class="text-muted">Due: {{ $assignment->due_date->format('M d, Y') }}</span>
                                @if(now()->gt($assignment->due_date) && !$submission)
                                    <span class="badge bg-danger ms-2">Overdue</span>
                                @elseif(now()->diffInDays($assignment->due_date, false) <= 2 && !$submission)
                                    <span class="badge bg-warning ms-2">Due Soon</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <a href="{{ route('student.assignments') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Assignments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Assignment Details Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <strong>Assignment Details</strong>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary">Description</h5>
                        <div class="p-3 bg-light rounded border">
                            {!! nl2br(e($assignment->description)) !!}
                        </div>
                    </div>
                    
                    @if($assignment->attachment)
                        <div class="mb-4">
                            <h5 class="text-primary">Attachment</h5>
                            <a href="{{ asset('storage/assignments/' . $assignment->attachment) }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-download me-2"></i> Download Attachment
                            </a>
                        </div>
                    @endif
                    
                    <div class="alert alert-light border mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-star text-warning me-3 fa-lg"></i>
                            <div>
                                <strong>Maximum Score:</strong> {{ $assignment->max_score }} points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($submission)
                <!-- Submission Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex align-items-center">
                        <i class="fas fa-paper-plane text-primary me-2"></i>
                        <strong>Your Submission</strong>
                        <span class="badge bg-{{ $submission->created_at->gt($assignment->due_date) ? 'warning' : 'info' }} ms-auto">
                            {{ $submission->created_at->gt($assignment->due_date) ? 'Late' : 'On Time' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="text-primary">Content</h5>
                            <div class="p-3 bg-light rounded border">
                                {!! nl2br(e($submission->content)) !!}
                            </div>
                        </div>
                        
                        @if($submission->file)
                            <div class="mb-4">
                                <h5 class="text-primary">Your Attachment</h5>
                                <a href="{{ asset('storage/submissions/' . $submission->file) }}" class="btn btn-outline-primary" target="_blank">
                                    <i class="fas fa-download me-2"></i> Download Your Attachment
                                </a>
                            </div>
                        @endif
                        
                        <div class="alert alert-light border mt-3">
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock text-info me-3 fa-lg"></i>
                                <div>
                                    <strong>Submitted:</strong> {{ $submission->created_at->format('M d, Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($submission->grade !== null)
                    <!-- Feedback Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Feedback and Grade</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="text-success">Grade</h5>
                                <div class="d-flex align-items-center">
                                    <h2 class="mb-0 me-2">{{ $submission->grade }}/{{ $assignment->max_score }}</h2>
                                    <span class="badge bg-{{ $submission->grade / $assignment->max_score >= 0.7 ? 'success' : ($submission->grade / $assignment->max_score >= 0.4 ? 'warning' : 'danger') }} ms-2">
                                        {{ round(($submission->grade / $assignment->max_score) * 100) }}%
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="text-success">Teacher Feedback</h5>
                                <div class="p-3 bg-light rounded border">
                                    {!! nl2br(e($submission->feedback)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Submit Assignment Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex align-items-center">
                        <i class="fas fa-upload text-primary me-2"></i>
                        <strong>Submit Your Assignment</strong>
                    </div>
                    <div class="card-body">
                        @if(now()->gt($assignment->due_date))
                            <div class="alert alert-warning d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-3"></i>
                                <div>This assignment is past due. Your submission will be marked as late.</div>
                            </div>
                        @endif
                        
                        <div class="text-center py-4">
                            <img src="{{ asset('images/upload.svg') }}" alt="Upload" class="img-fluid mb-3" style="max-height: 120px;">
                            <h5>Ready to Submit?</h5>
                            <p class="text-muted mb-4">Upload your completed assignment here</p>
                            <a href="{{ route('student.submission.create', $assignment->id) }}" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i> Submit Assignment
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <!-- Assignment Status Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex align-items-center">
                    <i class="fas fa-clipboard-check text-primary me-2"></i>
                    <strong>Assignment Status</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Status:</span>
                            <strong>
                                @if(!$submission)
                                    <span class="badge bg-warning">Not Submitted</span>
                                @elseif($submission->grade !== null)
                                    <span class="badge bg-success">Graded</span>
                                @else
                                    <span class="badge bg-info">Pending Grade</span>
                                @endif
                            </strong>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Due Date:</span>
                            <strong>{{ $assignment->due_date->format('M d, Y') }}</strong>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Time Remaining:</span>
                            <strong>
                                @if(now()->lt($assignment->due_date))
                                    <span class="text-{{ now()->diffInDays($assignment->due_date, false) <= 2 ? 'warning' : 'success' }}">
                                        {{ now()->diffForHumans($assignment->due_date, true) }}
                                    </span>
                                @else
                                    <span class="text-danger">Past Due</span>
                                @endif
                            </strong>
                        </li>
                        @if($submission)
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                <span>Submitted:</span>
                                <strong>{{ $submission->created_at->format('M d, Y H:i') }}</strong>
                            </li>
                        @endif
                    </ul>
                </div>
                
                @if(!$submission)
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('student.submission.create', $assignment->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i> Submit Assignment
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Related Assignments Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex align-items-center">
                    <i class="fas fa-link text-primary me-2"></i>
                    <strong>Related Assignments</strong>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @if($assignment->course)
    @foreach($assignment->course->assignments->where('id', '!=', $assignment->id)->take(3) as $relatedAssignment)
        <a href="{{ route('student.assignment.show', $relatedAssignment->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1">{{ Str::limit($relatedAssignment->title, 30) }}</h6>
                <small class="text-muted">Due: {{ $relatedAssignment->due_date->format('M d, Y') }}</small>
            </div>
            <i class="fas fa-chevron-right text-muted"></i>
        </a>
    @endforeach
@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for assignment page */
.card {
    border-radius: 10px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

.card-header {
    border-top-left-radius: 10px !important;
    border-top-right-radius: 10px !important;
}

.bg-light-primary {
    background-color: rgba(67, 97, 238, 0.1);
}

.bg-light-success {
    background-color: rgba(16, 183, 89, 0.1);
}

.bg-light-warning {
    background-color: rgba(255, 187, 0, 0.1);
}

.bg-light-info {
    background-color: rgba(0, 143, 251, 0.1);
}

.bg-light-danger {
    background-color: rgba(255, 82, 82, 0.1);
}

.text-primary {
    color: #4361ee !important;
}

.text-success {
    color: #10b759 !important;
}

.text-warning {
    color: #ffbb00 !important;
}

.text-info {
    color: #008ffb !important;
}

.text-danger {
    color: #ff5252 !important;
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
    font-size: 0.75em;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "\f105";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

.list-group-item {
    border-left: 0;
    border-right: 0;
}

.list-group-item:first-child {
    border-top: 0;
}

.list-group-item:last-child {
    border-bottom: 0;
}

/* Avatar styling */
.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

/* Alert styling */
.alert-light {
    background-color: #f8f9fa;
    border-color: #e9ecef;
}

/* Custom animation for status badges */
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.badge-success, .badge-warning, .badge-danger, .badge-info {
    animation: pulse 2s infinite;
}

/* Button hover effects */
.btn-primary, .btn-success, .btn-outline-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover, .btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
}

/* Description area */
.bg-light {
    background-color: #f9fafb !important;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .card-body {
        padding: 1rem;
    }
    
    h2 {
        font-size: 1.5rem;
    }
}
</style>
@endsection