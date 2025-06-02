<x-guest-layout>
    <style>
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>

    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}">
            <div class="error-message" id="name_error"></div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}">
            <div class="error-message" id="email_error"></div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password">
            <div class="error-message" id="password_error"></div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                name="password_confirmation">
            <div class="error-message" id="password_confirmation_error"></div>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>

        <!-- Social Registration -->
        <div class="text-center mt-4">
            <p class="mb-3">{{ __('Sign up with') }}</p>
            <div class="d-flex justify-content-center gap-2 mb-3">
                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-outline-info rounded-circle" style="width: 40px; height: 40px;">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 40px; height: 40px;">
                    <i class="fab fa-google"></i>
                </a>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-4">
            <p class="mb-0">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <i class="fas fa-sign-in-alt me-1"></i> {{ __('Already registered?') }}
                </a>
            </p>
        </div>
    </form>

    @push('scripts')
    <script src="{{ asset('assets/js/register.js') }}"></script>
    @endpush
</x-guest-layout>
