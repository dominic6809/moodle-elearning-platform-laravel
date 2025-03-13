@extends('layouts.student')

@section('content')
    <div class="container-fluid p-0">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-1">Welcome back, {{ Auth::guard('student')->user()->name }}!</h2>
                                <p class="mb-0">Here's what's happening with your courses</p>
                            </div>
                            <div class="d-none d-md-block">
                                <i class="fas fa-graduation-cap fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Alert -->
        @if ($notifications > 0)
            <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                <div class="flex-shrink-0 me-3">
                    <i class="fas fa-bell fa-lg"></i>
                </div>
                <div>
                    You have <strong>{{ $notifications }} new notification(s)</strong>.
                    <a href="{{ route('student.notifications') }}" class="alert-link">View all <i
                            class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <div class="card h-100 border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-light-primary p-3 me-3">
                            <i class="fas fa-tasks text-primary"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Pending Assignments</h6>
                            <h2 class="mt-2 mb-0">
                                {{ $assignments->where(function ($query) {
                                        return $query->whereDoesntHave('submissions', function ($q) {
                                            $q->where('student_id', auth()->guard('student')->id());
                                        });
                                    })->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <div class="card h-100 border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-light-success p-3 me-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Completed</h6>
                            <h2 class="mt-2 mb-0">{{ $submissions->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <div class="card h-100 border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-light-info p-3 me-3">
                            <i class="fas fa-hourglass-half text-info"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Upcoming Due</h6>
                            <h2 class="mt-2 mb-0">{{ $assignments->where('due_date', '>', now())->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-light-warning p-3 me-3">
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Avg. Grade</h6>
                            <h2 class="mt-2 mb-0">
                                @php
                                    $grades = $submissions->whereNotNull('grade')->pluck('grade')->toArray();
                                    $avgGrade =
                                        count($grades) > 0 ? round(array_sum($grades) / count($grades), 1) : 'N/A';
                                @endphp
                                {{ $avgGrade }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Assignments -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-list me-2 text-primary"></i>
                            Recent Assignments
                        </h5>
                        <a href="{{ route('student.assignments') }}" class="btn btn-sm btn-primary">
                            View All
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if ($assignments->count() > 0)
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Assignment</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assignments as $assignment)
                                            @php
                                                $submission = $assignment->submissions
                                                    ->where('student_id', auth()->guard('student')->id())
                                                    ->first();
                                                $isLate = now()->gt($assignment->due_date);
                                                $daysLeft = now()->diffInDays($assignment->due_date, false);
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <span class="avatar rounded-circle bg-light text-primary">
                                                                <i class="fas fa-file-alt"></i>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $assignment->title }}</h6>
                                                            <small
                                                                class="text-muted">{{ Str::limit($assignment->description, 40) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $assignment->due_date->format('M d, Y') }}
                                                        <div>
                                                            @if (!$submission)
                                                                @if ($isLate)
                                                                    <span class="badge badge-danger">Overdue</span>
                                                                @elseif($daysLeft <= 2)
                                                                    <span class="badge badge-warning">Due Soon</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (!$submission)
                                                        <span class="badge badge-warning">Not Submitted</span>
                                                    @elseif($submission->grade !== null)
                                                        <span class="badge badge-success">Graded</span>
                                                    @else
                                                        <span class="badge badge-info">Submitted</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('student.assignment.show', $assignment->id) }}"
                                                            class="btn btn-sm btn-outline-primary me-2">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        @if (!$submission)
                                                            <a href="{{ route('student.submission.store', $assignment->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard fa-3x text-muted mb-3"></i>
                                <h5>No Assignments Yet</h5>
                                <p class="text-muted">All your assignments will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Submissions -->
                <div class="card border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>
                            Recent Submissions
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if ($submissions->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($submissions as $submission)
                                    <div class="list-group-item border-0 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">{{ $submission->assignment->title }}</h6>
                                            @if ($submission->grade !== null && $submission->assignment->max_score > 0)
    <span class="badge bg-{{ $submission->grade / $submission->assignment->max_score >= 0.7 ? 'success' : ($submission->grade / $submission->assignment->max_score >= 0.4 ? 'warning' : 'danger') }}">
        {{ $submission->grade }}/{{ $submission->assignment->max_score }}
    </span>
@else
    <span class="badge bg-secondary">Pending</span>
@endif

                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                Submitted {{ $submission->created_at->format('M d, Y') }}
                                            </small>
                                            <a href="{{ route('student.assignment.show', $submission->assignment->id) }}"
                                                class="btn btn-sm btn-link p-0">
                                                View <i class="fas fa-chevron-right ms-1 small"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-file-upload fa-3x text-muted mb-3"></i>
                                <h5>No Submissions Yet</h5>
                                <p class="text-muted">Your submitted assignments will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Calendar Widget -->
                <div class="card border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            Upcoming Deadlines
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $upcomingAssignments = $assignments
                                ->where('due_date', '>', now())
                                ->sortBy('due_date')
                                ->take(3);
                        @endphp

                        @if ($upcomingAssignments->count() > 0)
                            <div class="timeline">
                                @foreach ($upcomingAssignments as $assignment)
                                    @php
                                        $daysLeft = now()->diffInDays($assignment->due_date, false);
                                        $urgencyClass =
                                            $daysLeft <= 2 ? 'danger' : ($daysLeft <= 5 ? 'warning' : 'info');
                                    @endphp
                                    <div class="timeline-item">
                                        <div class="timeline-left">
                                            <div
                                                class="timeline-date bg-light-{{ $urgencyClass }} text-{{ $urgencyClass }} rounded px-3 py-1 small fw-bold mb-1">
                                                {{ $assignment->due_date->format('M d') }}
                                            </div>
                                            <div class="text-muted small">{{ $daysLeft }} days left</div>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">{{ $assignment->title }}</h6>
                                            <p class="mb-0 text-muted small">
                                                {{ Str::limit($assignment->description, 50) }}</p>
                                            <a href="{{ route('student.assignment.show', $assignment->id) }}"
                                                class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-sm btn-outline-primary">View
                                    Calendar</a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="far fa-calendar-check fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No upcoming deadlines</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Dashboard Specific Styles */
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

        /* Badge styles for consistency */
        .badge-success {
            background-color: #10b759;
            color: #fff;
        }

        .badge-warning {
            background-color: #ffbb00;
            color: #212529;
        }

        .badge-danger {
            background-color: #ff5252;
            color: #fff;
        }

        .badge-info {
            background-color: #008ffb;
            color: #fff;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        /* Avatar styling */
        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        /* Timeline styling */
        .timeline {
            position: relative;
            padding-left: 0;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 20px;
            position: relative;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-left {
            flex-shrink: 0;
            margin-right: 15px;
            width: 90px;
        }

        .timeline-content {
            flex-grow: 1;
            padding-bottom: 15px;
            position: relative;
            border-bottom: 1px dashed #e0e0e0;
        }

        .timeline-item:last-child .timeline-content {
            border-bottom: none;
            padding-bottom: 0;
        }

        /* Card hover effects */
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .timeline-left {
                width: 70px;
            }
        }
    </style>
@endsection
