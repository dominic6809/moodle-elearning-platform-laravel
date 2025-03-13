@extends('layouts.student')

@section('content')
<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Assignments</h1>
            <p class="text-muted">Manage and track your assignments</p>
        </div>
        <div class="d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-light dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-1"></i> Sort
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="{{ route('student.assignments', ['sort' => 'due_date', 'order' => 'asc']) }}">Due Date (Earliest)</a></li>
                    <li><a class="dropdown-item" href="{{ route('student.assignments', ['sort' => 'due_date', 'order' => 'desc']) }}">Due Date (Latest)</a></li>
                    <li><a class="dropdown-item" href="{{ route('student.assignments', ['sort' => 'title', 'order' => 'asc']) }}">Title (A-Z)</a></li>
                    <li><a class="dropdown-item" href="{{ route('student.assignments', ['sort' => 'title', 'order' => 'desc']) }}">Title (Z-A)</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Status Filters -->
    <div class="card mb-4">
        <div class="card-body p-0">
            <div class="nav nav-pills nav-fill flex-column flex-sm-row" id="assignment-status-tabs" role="tablist">
                <a class="nav-link {{ request('status') == '' ? 'active' : '' }}" href="{{ route('student.assignments') }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-list me-2"></i>
                        <span>All Assignments</span>
                    </div>
                </a>
                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('student.assignments', ['status' => 'pending']) }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-hourglass-half me-2"></i>
                        <span>Not Submitted</span>
                    </div>
                </a>
                <a class="nav-link {{ request('status') == 'submitted' ? 'active' : '' }}" href="{{ route('student.assignments', ['status' => 'submitted']) }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-check me-2"></i>
                        <span>Submitted</span>
                    </div>
                </a>
                <a class="nav-link {{ request('status') == 'graded' ? 'active' : '' }}" href="{{ route('student.assignments', ['status' => 'graded']) }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-star me-2"></i>
                        <span>Graded</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
        
    <!-- Assignments List -->
    <div class="card">
        <div class="card-body">
            @if($assignments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 40%">Assignment</th>
                                <th style="width: 15%">Due Date</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 15%">Grade</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $assignment)
                                @php
                                    $submission = $assignment->submissions->where('student_id', auth()->guard('student')->id())->first();
                                    $isLate = now()->gt($assignment->due_date);
                                    $daysLeft = now()->diffInDays($assignment->due_date, false);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="assignment-icon me-3">
                                                <i class="fas fa-file-alt fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $assignment->title }}</h6>
                                                <span class="text-muted small">{{ Str::limit($assignment->description, 60) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ $assignment->due_date->format('M d, Y') }}</span>
                                            @if(!$submission)
                                                @if($isLate)
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-exclamation-circle me-1"></i> 
                                                        Overdue
                                                    </span>
                                                @elseif($daysLeft <= 2)
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Due in {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if(!$submission)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-hourglass-half me-1"></i> Not Submitted
                                            </span>
                                        @elseif($submission->grade !== null)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle me-1"></i> Graded
                                            </span>
                                        @else
                                            <span class="badge badge-info">
                                                <i class="fas fa-paper-plane me-1"></i> Submitted
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($submission && $submission->grade !== null)
                                            @php
                                                $maxScore = $assignment->max_score ?? 1; // Default to 1 to prevent division by zero
                                                $grade = $submission->grade;
                                                $percentage = $maxScore > 0 ? ($grade / $maxScore) * 100 : 0;
                                                $progressClass = $percentage >= 70 ? 'success' : ($percentage >= 40 ? 'warning' : 'danger');
                                            @endphp
                                    
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                    <div class="progress-bar bg-{{ $progressClass }}" 
                                                         role="progressbar" 
                                                         style="width: {{ $percentage }}%" 
                                                         aria-valuenow="{{ $grade }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="{{ $maxScore }}">
                                                    </div>
                                                </div>
                                                <span>{{ $grade }}/{{ $maxScore }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <a href="{{ route('student.assignment.show', $assignment->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        @if(!$submission && !$isLate)
                                            <a href="{{ route('student.submission.store', $assignment->id) }}" class="btn btn-sm btn-success mt-1">
                                                <i class="fas fa-upload me-1"></i> Submit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $assignments->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h5>No assignments found</h5>
                    <p class="text-muted">There are no assignments matching your current filters.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection