@extends('layouts.teacher')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header">
        <h1 class="header-title">
            <i class="fas fa-plus-circle me-2 text-primary"></i>Create New Assignment
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('assignments.index') }}">Assignments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Assignment Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Assignment Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-book"></i></span>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}" 
                                    placeholder="Enter assignment title" required>
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
                                    id="description" name="description" rows="5" 
                                    placeholder="Enter assignment instructions and details" required>{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Provide clear instructions and any specific requirements for the assignment.</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label fw-bold">Due Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                            id="due_date" name="due_date" value="{{ old('due_date') }}" required>
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
                                            id="max_score" name="max_score" value="{{ old('max_score', 100) }}" 
                                            min="1" max="100" required>
                                    </div>
                                    @error('max_score')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">Attachment (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-paperclip"></i></span>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                    id="file" name="file">
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Upload any supporting documents or resources (PDF, DOCX, XLSX, etc.)</small>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('assignments.index') }}" class="btn btn-light">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Create Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Tips for Creating Assignments</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Clear Instructions</strong>
                                <p class="mb-0 text-muted small">Provide specific guidelines about what students need to deliver.</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Set Realistic Deadlines</strong>
                                <p class="mb-0 text-muted small">Consider course workload when deciding due dates.</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Provide Resources</strong>
                                <p class="mb-0 text-muted small">Attach relevant materials students might need.</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Outline Grading Criteria</strong>
                                <p class="mb-0 text-muted small">Let students know how they'll be evaluated.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body bg-light">
                    <h6 class="card-title">
                        <i class="fas fa-lightbulb text-warning me-2"></i>Quick Actions
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-copy me-1"></i> Duplicate Existing Assignment
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-file-import me-1"></i> Import Assignment Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection