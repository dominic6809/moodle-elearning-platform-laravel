@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="header-title">Students Management</h1>
            <p class="text-muted">Manage your classroom students and their information</p>
        </div>
        <div>
            <a href="{{ route('teacher.students.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus me-2"></i> Add New Student
            </a>
        </div>
    </div>
    
    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Total Students</h5>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $students->total() }}</h2>
                    <p class="text-muted">Active students</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">New Enrollments</h5>
                        <div class="rounded-circle bg-success bg-opacity-10 p-2">
                            <i class="fas fa-user-plus text-success"></i>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $students->where('created_at', '>=', now()->subDays(30))->count() }}</h2>
                    <p class="text-muted">Last 30 days</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Course Progress</h5>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2">
                            <i class="fas fa-chart-line text-info"></i>
                        </div>
                    </div>
                    <h2 class="mb-0">68%</h2>
                    <p class="text-muted">Average completion</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search students...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>All Courses</option>
                        <option>Web Development</option>
                        <option>Mobile App Design</option>
                        <option>Data Science</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Sort By</option>
                        <option>Name (A-Z)</option>
                        <option>Name (Z-A)</option>
                        <option>Newest First</option>
                        <option>Oldest First</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Students List -->
    <div class="card">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Student Roster</h5>
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Enrolled Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="student{{ $student->id }}">
                                            <label class="form-check-label" for="student{{ $student->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-3 bg-{{ ['primary', 'info', 'success', 'warning', 'danger'][array_rand(['primary', 'info', 'success', 'warning', 'danger'])] }}">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $student->name }}</h6>
                                                <small class="text-muted">ID: {{ $student->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ rand(10, 100) }}%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ ['success', 'warning', 'primary'][array_rand(['success', 'warning', 'primary'])] }} bg-opacity-10 text-{{ ['success', 'warning', 'primary'][array_rand(['success', 'warning', 'primary'])] }} px-3 py-2">
                                            {{ ['Active', 'Pending', 'In Progress'][array_rand(['Active', 'Pending', 'In Progress'])] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <li><a class="dropdown-item" href="{{ route('teacher.students.show', $student->id) }}"><i class="fas fa-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-chart-bar me-2"></i>View Progress</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>Send Message</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <p class="text-muted mb-0">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students</p>
                    </div>
                    <div>
                        {{ $students->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-user-graduate fa-4x text-muted opacity-50"></i>
                    </div>
                    <h5>No Students Yet</h5>
                    <p class="text-muted">You haven't added any students to your classroom yet.</p>
                    <a href="{{ route('teacher.students.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-user-plus me-2"></i> Add Your First Student
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    @if($students->count() > 0)
    <!-- Bulk Actions Footer -->
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-3"><span id="selectedCount">0</span> students selected</p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Message
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-file-export me-2"></i>Export
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash me-2"></i>Remove
                        </button>
                    </div>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-cog me-2"></i>More Options
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle "Select All" checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    const studentCheckboxes = document.querySelectorAll('input[id^="student"]');
    const selectedCountElement = document.getElementById('selectedCount');
    
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = this.checked;
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateSelectedCount();
    });
    
    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('input[id^="student"]:checked').length;
        selectedCountElement.textContent = selectedCount;
    }
});
</script>
@endsection