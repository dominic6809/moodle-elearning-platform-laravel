@extends('layouts.student')

@section('content')
<div class="container py-5">
    <!-- Header Section with Breadcrumb -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-1">Submit Assignment</h1>
            <h5 class="text-muted font-weight-normal">{{ $assignment->title }}</h5>
        </div>
        <div class="col-md-4 text-md-right">
            <a href="{{ route('student.assignment.show', $assignment->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to Assignment
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">Assignment Submission</h5>
                    @if(now()->gt($assignment->due_date))
                        <span class="badge badge-warning px-3 py-2">
                            <i class="fas fa-clock mr-1"></i> Late Submission
                        </span>
                    @else
                        <span class="badge badge-info px-3 py-2">
                            <i class="fas fa-calendar-alt mr-1"></i> Due: {{ $assignment->due_date->format('M d, Y, g:i A') }}
                        </span>
                    @endif
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('student.submission.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="content" class="font-weight-bold">Your Answer/Response</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                id="content" name="content" rows="10" placeholder="Write your answer here..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-pencil-alt mr-1"></i> Write your complete answer or response to this assignment.
                            </small>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="file" class="font-weight-bold">Attachment (Optional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-paperclip mr-1"></i> Upload any supporting files (max 10MB).
                            </small>
                        </div>
                        
                        <div class="alert alert-info border-left border-info border-5">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <i class="fas fa-info-circle fa-2x text-info"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold mb-2">Before submitting:</h6>
                                    <ul class="mb-0 pl-3">
                                        <li class="mb-1">Make sure you've answered all parts of the assignment</li>
                                        <li class="mb-1">Check your work for errors</li>
                                        <li>Remember that you can only submit once</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-lock mr-1"></i> Your submission will be timestamped
                                </span>
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-paper-plane mr-1"></i> Submit Assignment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Additional Helper Card -->
            <div class="card mt-4 border-left border-primary border-5 shadow-sm">
                <div class="card-body p-3">
                    <h6 class="font-weight-bold"><i class="fas fa-lightbulb text-primary mr-2"></i>Submission Tips</h6>
                    <p class="mb-0 small">For optimal results, consider proofreading your submission and ensuring all file attachments are properly formatted. If you encounter any issues, please contact your instructor.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-5 {
        border-width: 5px !important;
    }
    
    textarea.form-control {
        min-height: 200px;
    }
</style>

@push('scripts')
<script>
    // Display file name when selected
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
@endsection