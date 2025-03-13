@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header">
        <div>
            <h1 class="header-title mb-1">{{ $assignment->title }}</h1>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-primary">Assignment #{{ $assignment->id }}</span>
                <span class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Created {{ $assignment->created_at->format('M d, Y') }}</span>
                @php
                    $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                    $today = \Carbon\Carbon::now();
                    $daysRemaining = $today->diffInDays($dueDate, false);
                    
                    if ($dueDate->isPast()) {
                        $statusColor = 'danger';
                        $statusText = 'Expired';
                    } elseif ($daysRemaining <= 2) {
                        $statusColor = 'warning';
                        $statusText = 'Due Soon';
                    } else {
                        $statusColor = 'success';
                        $statusText = 'Active';
                    }
                @endphp
                <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('assignments.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> Back to Assignments
            </a>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="assignmentActions" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog me-1"></i> Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="assignmentActions">
                    <li><a class="dropdown-item" href="{{ route('assignments.edit', $assignment->id) }}"><i class="fas fa-edit me-2"></i> Edit Assignment</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i> Duplicate Assignment</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i> Send Reminder</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt me-2"></i> Delete Assignment
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2 text-primary"></i>Assignment Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <div class="p-3 bg-light rounded border-start border-primary border-4">
                            {!! nl2br(e($assignment->description)) !!}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary mb-3">Due Date</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="display-4 me-3">
                                            <i class="fas fa-calendar-day text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fs-5 fw-bold">{{ $assignment->due_date->format('M d, Y') }}</div>
                                            @if($daysRemaining > 0)
                                                <div class="text-success">{{ $daysRemaining }} days remaining</div>
                                            @else
                                                <div class="text-danger">Past due by {{ abs($daysRemaining) }} days</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary mb-3">Maximum Score</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="display-4 me-3">
                                            <i class="fas fa-award text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fs-5 fw-bold">{{ $assignment->max_score }} points</div>
                                            <div class="text-muted">Out of 100%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($assignment->file_path)
                        <div class="mb-4">
                            <h6 class="fw-bold">Attachment</h6>
                            <div class="p-3 bg-light rounded d-flex align-items-center">
                                <i class="fas fa-paperclip fs-4 text-primary me-3"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ basename($assignment->file_path) }}</div>
                                    <div class="text-muted small">Uploaded {{ $assignment->updated_at->format('M d, Y') }}</div>
                                </div>
                                <a href="{{ asset($assignment->file_path) }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2 text-primary"></i>Performance Overview</h5>
                </div>
                <div class="card-body">
                    @php
                        $submissions = $assignment->submissions;
                        $submissionCount = $submissions->count();
                        $gradedCount = $submissions->whereNotNull('grade')->count();
                        $avgGrade = $gradedCount > 0 ? $submissions->whereNotNull('grade')->avg('grade') : 0;
                        
                        // Performance distribution
                        $excellent = $gradedCount > 0 ? $submissions->where('grade', '>=', 90)->count() : 0;
                        $good = $gradedCount > 0 ? $submissions->where('grade', '>=', 75)->where('grade', '<', 90)->count() : 0;
                        $average = $gradedCount > 0 ? $submissions->where('grade', '>=', 60)->where('grade', '<', 75)->count() : 0;
                        $needsImprovement = $gradedCount > 0 ? $submissions->where('grade', '<', 60)->count() : 0;
                    @endphp
                    
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Grade Distribution</h6>
                            <div class="progress mb-2" style="height: 10px;">
                                @if($gradedCount > 0)
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($excellent/$gradedCount)*100 }}%"></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($good/$gradedCount)*100 }}%"></div>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($average/$gradedCount)*100 }}%"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($needsImprovement/$gradedCount)*100 }}%"></div>
                                @else
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between small text-muted">
                                <div><span class="badge bg-success me-1"></span>Excellent</div>
                                <div><span class="badge bg-info me-1"></span>Good</div>
                                <div><span class="badge bg-warning me-1"></span>Average</div>
                                <div><span class="badge bg-danger me-1"></span>Needs Improvement</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <h6 class="text-muted mb-2">Average Grade</h6>
                                <div class="display-5 fw-bold text-primary">{{ number_format($avgGrade, 1) }}</div>
                                <div class="text-muted">out of {{ $assignment->max_score }} points</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0"><i class="fas fa-tasks me-2 text-primary"></i>Submission Status</h5>
                </div>
                <div class="card-body">
                    @php
                        $totalStudents = $assignment->teacher->students->count();
                        $submissionRate = $totalStudents > 0 ? ($submissionCount / $totalStudents) * 100 : 0;
                        $pendingGrades = $submissionCount - $gradedCount;
                    @endphp
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <div>
                                <div class="text-muted small">Submission Rate</div>
                                <div class="fs-4 fw-bold">{{ number_format($submissionRate, 1) }}%</div>
                            </div>
                            <div class="text-end">
                                <div class="fs-5 fw-bold">{{ $submissionCount }} / {{ $totalStudents }}</div>
                                <div class="text-muted small">submissions received</div>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $submissionRate }}%"></div>
                        </div>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="bg-light rounded p-3 text-center h-100">
                                <div class="text-muted small">Graded</div>
                                <div class="fs-4 fw-bold text-success">{{ $gradedCount }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light rounded p-3 text-center h-100">
                                <div class="text-muted small">Pending</div>
                                <div class="fs-4 fw-bold text-warning">{{ $pendingGrades }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('teacher.submissions') }}?assignment_id={{ $assignment->id }}" class="btn btn-primary">
                            <i class="fas fa-list-alt me-1"></i> View All Submissions
                        </a>
                        @if($pendingGrades > 0)
                            <a href="{{ route('teacher.submissions') }}?assignment_id={{ $assignment->id }}&status=ungraded" class="btn btn-outline-primary">
                                <i class="fas fa-tasks me-1"></i> Grade Pending Submissions
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0"><i class="fas fa-clock me-2 text-primary"></i>Timeline</h5>
                </div>
                <div class="card-body p-0">
                    <div class="p-3 border-bottom d-flex">
                        <div class="me-3">
                            <div class="bg-primary rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold">Assignment Created</div>
                            <div class="text-muted small">{{ $assignment->created_at->format('M d, Y - g:i A') }}</div>
                        </div>
                    </div>
                    
                    @if($assignment->created_at != $assignment->updated_at)
                    <div class="p-3 border-bottom d-flex">
                        <div class="me-3">
                            <div class="bg-info rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold">Last Updated</div>
                            <div class="text-muted small">{{ $assignment->updated_at->format('M d, Y - g:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="p-3 border-bottom d-flex">
                        <div class="me-3">
                            <div class="bg-{{ $statusColor }} rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-calendar-check text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold">Due Date</div>
                            <div class="text-muted small">{{ $assignment->due_date->format('M d, Y - g:i A') }}</div>
                        </div>
                    </div>
                    
                    @if($submissionCount > 0)
                    <div class="p-3 d-flex">
                        <div class="me-3">
                            <div class="bg-success rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold">First Submission</div>
                            <div class="text-muted small">{{ $assignment->submissions->sortBy('created_at')->first()->created_at->format('M d, Y - g:i A') }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0"><i class="fas fa-bullhorn me-2 text-primary"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-bell me-1"></i> Send Reminder to Students
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="fas fa-file-export me-1"></i> Export Grades
                        </a>
                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-edit me-1"></i> Edit Assignment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection