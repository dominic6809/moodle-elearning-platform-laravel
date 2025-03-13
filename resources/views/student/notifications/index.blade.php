@extends('layouts.student')

@section('content')
<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="fas fa-bell text-primary me-2"></i>Notifications
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Your Notifications</h5>
            @if($notifications->count() > 0)
                <a href="#" class="btn btn-sm btn-light" id="markAllRead">
                    <i class="fas fa-check-double me-1"></i> Mark all as read
                </a>
            @endif
        </div>
        <div class="card-body p-0">
            @if($notifications->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <form id="notification-form-{{ $notification->id }}" action="{{ route('student.notification.read', $notification->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" onclick="event.preventDefault(); document.getElementById('notification-form-{{ $notification->id }}').submit();" 
                           class="list-group-item list-group-item-action border-0 {{ $notification->read ? 'bg-white' : 'bg-light' }} p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="notification-icon rounded-circle {{ $notification->read ? 'bg-secondary' : 'bg-primary' }} text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-{{ $notification->read ? 'envelope-open' : 'envelope' }}"></i>
                                    </div>
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 {{ $notification->read ? 'text-muted' : 'text-dark' }}">{{ $notification->title }}</h5>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-truncate">{{ $notification->message }}</p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info text-white me-2">
                                            <i class="fas fa-book-open me-1"></i> {{ $notification->assignment->title }}
                                        </span>
                                        @if(!$notification->read)
                                            <span class="badge bg-warning text-dark">New</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="px-3 py-2">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="alert alert-info m-3 mb-0">
                    <div class="text-center py-5">
                        <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                        <h5>No Notifications</h5>
                        <p class="text-muted">You don't have any notifications yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const markAllReadBtn = document.getElementById('markAllRead');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            /*  */
        });
    }
});
</script>
@endsection