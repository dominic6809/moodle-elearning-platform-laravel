@extends('layouts.student')

@section('content')
<div class="container py-5">
    <!-- Header Section with Breadcrumb -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Submission Details</h1>
            <h5 class="text-muted font-weight-normal">{{ $submission->assignment->title }}</h5>
        </div>
        <div class="col-md-4 text-md-right">
            <a href="{{ route('student.assignment.show', $submission->assignment_id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to Assignment
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Submission Content Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fas fa-file-alt mr-2 text-primary"></i>Your Submission</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Content</h6>
                        <div class="p-4 bg-light rounded border">
                            {!! nl2br(e($submission->content)) !!}
                        </div>
                    </div>
                    
                    @if($submission->file)
                        <div class="mb-4">
                            <h6 class="font-weight-bold">Your Attachment</h6>
                            <a href="{{ asset('storage/submissions/' . $submission->file) }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-download mr-1"></i> Download Your Attachment
                            </a>
                        </div>
                    @endif
                    
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-muted mr-2"></i>
                            <p class="mb-0">
                                <strong>Submitted:</strong> {{ $submission->created_at->format('M d, Y h:i A') }}
                                @if($submission->created_at->gt($submission->assignment->due_date))
                                    <span class="badge badge-warning ml-2 px-3 py-2">Late</span>
                                @else
                                    <span class="badge badge-success ml-2 px-3 py-2">On Time</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Grade & Feedback Card -->
            @if($submission->grade !== null)
                <div class="card shadow-sm mb-4 border-left border-success border-5">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-success"><i class="fas fa-check-circle mr-2"></i>Feedback and Grade</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4 text-center">
                            <h6 class="font-weight-bold text-uppercase text-muted">Your Grade</h6>
                            <div class="d-inline-block p-4 bg-success-light rounded-circle mb-2">
                                <h1 class="display-4 mb-0 text-success font-weight-bold">{{ $submission->grade }}</h1>
                            </div>
                            <p class="text-muted">out of {{ $submission->assignment->max_score }} points</p>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="font-weight-bold">Teacher Feedback</h6>
                            <div class="p-4 bg-light rounded border">
                                {!! nl2br(e($submission->feedback)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow-sm mb-4 border-left border-info border-5">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-info"><i class="fas fa-hourglass-half mr-2"></i>Pending Grade</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center py-3">
                            <div class="mb-3">
                                <i class="fas fa-spinner fa-3x text-info"></i>
                            </div>
                            <p class="mb-0">Your submission is still being reviewed by your teacher. You will be notified when it has been graded.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Assignment Details Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 20px; z-index: 999;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fas fa-info-circle mr-2 text-primary"></i>Assignment Details</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Assignment:</span>
                        <strong>{{ $submission->assignment->title }}</strong>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Due Date:</span>
                        <strong>{{ $submission->assignment->due_date->format('M d, Y h:i A') }}</strong>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Maximum Score:</span>
                        <strong>{{ $submission->assignment->max_score }} points</strong>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Status:</span>
                        @if($submission->grade !== null)
                            <span class="badge badge-success px-3 py-2">Graded</span>
                        @else
                            <span class="badge badge-info px-3 py-2">Pending</span>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="{{ route('student.assignments') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-list-ul mr-1"></i> View All Assignments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-5 {
        border-width: 5px !important;
    }
    
    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }
</style>
@endsection