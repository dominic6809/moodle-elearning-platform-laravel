@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header">
        <h1 class="header-title">Teacher Dashboard</h1>
        <div>
            <a href="{{ route('assignments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Assignment
            </a>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Students</p>
                            <h2 class="fw-bold mb-0">{{ $students }}</h2>
                        </div>
                        <div class="bg-primary-subtle p-3 rounded">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('teacher.students') }}" class="btn btn-sm btn-outline-primary">
                            View All Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Active Assignments</p>
                            <h2 class="fw-bold mb-0">{{ $assignments }}</h2>
                        </div>
                        <div class="bg-success-subtle p-3 rounded">
                            <i class="fas fa-tasks fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-outline-success">
                            View All Assignments
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Pending Reviews</p>
                            <h2 class="fw-bold mb-0">{{ $pendingSubmissions }}</h2>
                        </div>
                        <div class="bg-warning-subtle p-3 rounded">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('teacher.submissions') }}" class="btn btn-sm btn-outline-warning">
                            Grade Submissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions & Summary Section -->
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('teacher.students.create') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-user-plus me-2"></i>Add New Student</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="{{ route('assignments.create') }}" class="btn btn-outline-success d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-plus-circle me-2"></i>Create New Assignment</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="{{ route('teacher.submissions') }}" class="btn btn-outline-warning d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-check me-2"></i>Review Pending Submissions</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Activity Summary</h5>
                    <span class="badge bg-primary">Last 30 Days</span>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="230"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity Section -->
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Recent Activity</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Assignment "Final Project" was created</h6>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1 text-muted">You created a new assignment due on April 15.</p>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">New submission from John Doe</h6>
                                <small class="text-muted">5 days ago</small>
                            </div>
                            <p class="mb-1 text-muted">John submitted the "Midterm Essay" assignment.</p>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">You graded 5 submissions</h6>
                                <small class="text-muted">1 week ago</small>
                            </div>
                            <p class="mb-1 text-muted">Average grade: 85/100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample data for the activity chart
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Assignments Created',
                    data: [3, 5, 2, 4],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Submissions Received',
                    data: [12, 19, 15, 22],
                    borderColor: '#f72585',
                    backgroundColor: 'rgba(247, 37, 133, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false
            }
        });
    });
</script>
@endsection