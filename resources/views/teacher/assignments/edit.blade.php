@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header">
        <h1 class="header-title">
            <i class="fas fa-edit me-2 text-primary"></i>Edit Assignment
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('assignments.index') }}">Assignments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Assignment Details</h5>
                    <span class="badge bg-primary">ID: #{{ $assignment->id }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('assignments.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Assignment Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-book"></i></span>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title', $assignment->title) }}" required>
                            </div>
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" name="description" rows="5">{{ old('description', $assignment->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label fw-bold">Due Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                            id="due_date" name="due_date" value="{{ old('due_date', $assignment->due_date) }}" required>
                                    </div>
                                    @error('due_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_score" class="form-label fw-bold">Maximum Score</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-star"></i></span>
                                        <input type="number" class="form-control @error('max_score') is-invalid @enderror" 
                                            id="max_score" name="max_score" value="{{ old('max_score', $assignment->max_score) }}" 
                                            min="1" max="100" required>
                                    </div>
                                    @error('max_score')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">
                                <i class="fas fa-paperclip me-1"></i>
                                Upload File (Optional)
                            </label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                id="file" name="file">
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            @if($assignment->file_path)
                            <div class="mt-2 p-2 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                    <span>Current file: {{ basename($assignment->file_path) }}</span>
                                    <a href="{{ asset($assignment->file_path) }}" class="btn btn-sm btn-outline-primary ms-auto">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>
                                <small class="text-muted">Uploading a new file will replace the current one</small>
                            </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-light">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Assignment Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Created</span>
                            <span>{{ $assignment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Last Updated</span>
                            <span>{{ $assignment->updated_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Due Date</span>
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Status</span>
                            @php
                                $today = \Carbon\Carbon::now();
                                $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                                $status = $dueDate->isPast() ? 'Expired' : 'Active';
                                $statusClass = $dueDate->isPast() ? 'danger' : 'success';
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">{{ $status }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Submissions</span>
                            <span class="badge bg-info">{{ $assignment->submissions->count() ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> View Assignment
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="fas fa-copy me-1"></i> Duplicate Assignment
                        </a>
                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" 
                            onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-trash-alt me-1"></i> Delete Assignment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection