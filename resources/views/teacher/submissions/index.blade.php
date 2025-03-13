@extends('layouts.teacher')

@section('content')
    <div class="container-fluid py-4">
        <div class="page-header">
            <h1 class="header-title">Student Submissions</h1>
            <a href="{{ route('assignments.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Assignments
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-white py-3">
                <form action="{{ route('teacher.submissions') }}" method="GET">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-filter text-primary"></i>
                                </span>
                                <select name="assignment_id" class="form-select border-0 shadow-none"
                                    onchange="this.form.submit()">
                                    <option value="">All Assignments</option>
                                    @foreach (auth()->user()->assignments as $assignment)
                                        <option value="{{ $assignment->id }}"
                                            {{ request('assignment_id') == $assignment->id ? 'selected' : '' }}>
                                            {{ $assignment->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </span>
                                <select name="status" class="form-select border-0 shadow-none"
                                    onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                    <option value="graded" {{ request('status') == 'graded' ? 'selected' : '' }}>Graded
                                    </option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if ($submissions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Student</th>
                                    <th scope="col">Assignment</th>
                                    <th scope="col">Submitted</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $submission)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2 bg-light text-primary">
                                                    {{ substr($submission->student->name, 0, 1) }}
                                                </div>
                                                <span>{{ $submission->student->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $submission->assignment->title }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="fw-medium">{{ $submission->created_at->format('M d, Y') }}</span>
                                                <small
                                                    class="text-muted">{{ $submission->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($submission->grade !== null)
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Graded
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($submission->grade !== null && $submission->assignment->max_score > 0)
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <span
                                                            class="fw-medium text-dark">{{ $submission->grade }}/{{ $submission->assignment->max_score }}</span>
                                                    </div>
                                                    <div class="progress" style="width: 60px; height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ ($submission->grade / $submission->assignment->max_score) * 100 }}%;"
                                                            aria-valuenow="{{ $submission->grade }}" aria-valuemin="0"
                                                            aria-valuemax="{{ $submission->assignment->max_score }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">Not graded</span>
                                            @endif

                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('teacher.submission.show', $submission->id) }}"
                                                class="btn btn-sm {{ $submission->grade !== null ? 'btn-outline-primary' : 'btn-primary' }}">
                                                @if ($submission->grade !== null)
                                                    <i class="fas fa-eye me-1"></i> View
                                                @else
                                                    <i class="fas fa-check-circle me-1"></i> Grade
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $submissions->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-file-alt text-muted" style="font-size: 3rem;"></i>
                        <h4 class="mt-3">No submissions found</h4>
                        <p class="text-muted">There are no assignments submitted by students that match your current
                            filters.</p>
                        <a href="{{ route('teacher.submissions') }}" class="btn btn-outline-primary mt-2">
                            <i class="fas fa-sync-alt me-2"></i>View All Submissions
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
