<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    {{-- <h3 class="text-center font-weight-bold text-primary mb-2">{{ __('Join as a Teacher') }}</h3> --}}
                    <p class="text-center text-muted mb-4">Create your account to get started</p>
                </div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-semibold">{{ __('Full Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa fa-user text-muted"></i>
                                </span>
                                <input id="name" type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa fa-lock text-muted"></i>
                                </span>
                                <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" name="password" placeholder="Create a strong password" required autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary border-start-0" onclick="togglePassword('password')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="text-muted">Password must be at least 8 characters long</small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa fa-lock text-muted"></i>
                                </span>
                                <input id="password-confirm" type="password" class="form-control border-start-0" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary border-start-0" onclick="togglePassword('password-confirm')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    {{ __('I agree to the') }} <a href="#" class="text-decoration-none">Terms of Service</a> {{ __('and') }} <a href="#" class="text-decoration-none">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">
                                {{ __('Create Account') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-muted mb-4">{{ __('Or sign up with') }}</p>
                            <div class="d-flex justify-content-center gap-3 mb-4">
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="fab fa-microsoft"></i>
                                </a>
                            </div>
                            <p class="mb-0">
                                {{ __('Already have an account?') }} <a href="{{ route('login') }}" class="fw-bold text-decoration-none">{{ __('Sign in') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
</script>
@endsection