@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="header-title">Assignments</h1>
            <p class="text-muted">Manage and track all your course assignments</p>
        </div>
        <div>
            <a href="{{ route('assignments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Create Assignment
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Assignments</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search assignments..." id="searchAssignments">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(isset($assignments) && $assignments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Submissions</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $assignment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                                <i class="fas fa-file-alt text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $assignment->title }}</h6>
                                                <span class="text-muted small">{{ \Illuminate\Support\Str::limit($assignment->description ?? 'No description', 40) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-muted me-2"></i>
                                            {{ $assignment->due_date->format('M d, Y') }}
                                        </div>
                                        <span class="text-muted small">{{ $assignment->due_date->format('h:i A') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-info rounded-pill me-2">{{ $assignment->submissions->count() }}</span>
                                            <span class="text-muted small">submissions</span>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $now = now();
                                            $dueDate = $assignment->due_date;
                                            $status = $now > $dueDate ? 'Closed' : 'Active';
                                            $statusClass = $now > $dueDate ? 'bg-secondary' : 'bg-success';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <div class="text-muted small">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $assignment->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-sm btn-outline-secondary me-2" title="View Submissions">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit Assignment">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
                                                data-id="{{ $assignment->id }}" 
                                                data-title="{{ $assignment->title }}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $assignments->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="rounded-circle bg-light p-3 d-inline-block mb-3">
                        <i class="fas fa-file-alt fa-2x text-muted"></i>
                    </div>
                    <h5>No Assignments Created Yet</h5>
                    <p class="text-muted">Get started by creating your first assignment for your students.</p>
                    <a href="{{ route('assignments.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus-circle me-2"></i> Create Assignment
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Single Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the assignment "<span id="assignmentTitle"></span>"? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Assignment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Delete Button Click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const assignmentId = this.getAttribute('data-id');
            const assignmentTitle = this.getAttribute('data-title');

            document.getElementById('assignmentTitle').textContent = assignmentTitle;
            document.getElementById('deleteForm').setAttribute('action', `/assignments/${assignmentId}`);
        });
    });
});
</script>

@endsection
