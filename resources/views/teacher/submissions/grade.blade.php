@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header">
        <div>
            <h1 class="header-title">Grade Submission</h1>
            <p class="text-muted mb-0">
                <i class="fas fa-user-graduate me-2"></i>{{ $submission->student->name }} | 
                <i class="fas fa-tasks me-2"></i>{{ $submission->assignment->title }}
            </p>
        </div>
        <a href="{{ route('teacher.submissions') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Submissions
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-file-alt me-2 text-primary"></i>Student Submission</h5>
                    <div>
                        @if($submission->created_at->lte($submission->assignment->due_date))
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i> On Time
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                <i class="fas fa-exclamation-circle me-1"></i> Late ({{ $submission->created_at->diffInDays($submission->assignment->due_date) }} days)
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">Submission Content</h6>
                        <div class="p-4 bg-light rounded border">
                            {!! nl2br(e($submission->content)) !!}
                        </div>
                    </div>
                    
                    @if($submission->file)
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">Attachments</h6>
                            <div class="p-3 bg-light rounded border d-flex align-items-center">
                                <i class="fas fa-paperclip text-primary me-3 fs-4"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-medium">{{ basename($submission->file) }}</div>
                                    <div class="text-muted small">Attachment</div>
                                </div>
                                <a href="{{ asset('storage/submissions/' . $submission->file) }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <h6 class="fw-bold text-primary mb-3">Submission Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-check text-primary me-3 fs-4"></i>
                                            <div>
                                                <div class="text-muted small">Submitted on</div>
                                                <div class="fw-medium">{{ $submission->created_at->format('M d, Y') }}</div>
                                                <div class="text-muted small">{{ $submission->created_at->format('h:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-hourglass-end text-primary me-3 fs-4"></i>
                                            <div>
                                                <div class="text-muted small">Assignment Due</div>
                                                <div class="fw-medium">{{ $submission->assignment->due_date->format('M d, Y') }}</div>
                                                <div class="text-muted small">{{ $submission->assignment->due_date->format('h:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-check-circle me-2 text-primary"></i>
                        {{ $submission->grade !== null ? 'Update Grade' : 'Grade Submission' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.submission.grade', $submission->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="grade" class="form-label fw-medium">Score (out of {{ $submission->assignment->max_score }})</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-star text-primary"></i>
                                </span>
                                <input type="number" class="form-control border-0 shadow-none @error('grade') is-invalid @enderror" 
                                    id="grade" name="grade" min="0" max="{{ $submission->assignment->max_score }}"
                                    value="{{ old('grade', $submission->grade) }}" required>
                                <span class="input-group-text bg-light border-0 text-muted">
                                    / {{ $submission->assignment->max_score }}
                                </span>
                                @error('grade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label text-muted small">Score Preview</label>
                                <div class="progress" style="height: 8px;">
                                    @php
    $maxScore = $submission->assignment->max_score ?? 1; // Default to 1 to prevent division by zero
    $grade = old('grade', $submission->grade) ?? 0;
    $percentage = $maxScore > 0 ? ($grade / $maxScore) * 100 : 0;
@endphp

<div class="progress-bar bg-primary" id="grade-progress" role="progressbar" 
    style="width: {{ $percentage }}%;" 
    aria-valuenow="{{ $grade }}" 
    aria-valuemin="0" 
    aria-valuemax="{{ $maxScore }}">
</div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="feedback" class="form-label fw-medium">Feedback to Student</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-comment text-primary"></i>
                                </span>
                                <textarea class="form-control border-0 shadow-none @error('feedback') is-invalid @enderror" 
                                    id="feedback" name="feedback" rows="8" required>{{ old('feedback', $submission->feedback) }}</textarea>
                                @error('feedback')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Provide constructive feedback to help the student improve.</small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="fas {{ $submission->grade !== null ? 'fa-save' : 'fa-check-circle' }} me-2"></i>
                                {{ $submission->grade !== null ? 'Update Grade' : 'Submit Grade' }}
                            </button>
                            
                            @if($submission->grade !== null)
                                <a href="{{ route('teacher.submissions') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const gradeInput = document.getElementById('grade');
    const progressBar = document.getElementById('grade-progress');
    const maxScore = {{ $submission->assignment->max_score }};
    
    gradeInput.addEventListener('input', function() {
        const value = this.value;
        const percentage = (value / maxScore) * 100;
        progressBar.style.width = percentage + '%';
        progressBar.setAttribute('aria-valuenow', value);
    });
});
</script>
@endsection