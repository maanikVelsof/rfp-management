<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
    @endif

    <form method="POST" action="{{ route('login') }}"  id="loginForm">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}"  autofocus  autocomplete="nope">
            <div class="error-message" id="email_error"></div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password"  autocomplete="current-password">
            <div class="error-message" id="password_error"></div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    {{ __('Remember me') }}
                </label>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Social Login -->
        <div class="text-center mt-4">
            <p class="mb-3">{{ __('Sign in with') }}</p>
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

        <!-- Links -->
        <div class="text-center mt-4">
            <p class="mb-2">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    <i class="fas fa-user-plus me-1"></i> {{ __('Register as Admin') }}
                </a>
            </p>
            <p class="mb-2">
                <a href="{{ route('vendor.register') }}" class="text-decoration-none">
                    <i class="fas fa-user-plus me-1"></i> {{ __('Register as Vendor') }}
                </a>
            </p>
            @if (Route::has('password.request'))
                <p class="mb-0">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                        <i class="fas fa-lock me-1"></i> {{ __('Forgot your password?') }}
                    </a>
                </p>
            @endif
        </div>
    </form>

    @push('scripts')
    <script src="{{ asset('assets/js/login.js') }}"></script>
    @endpush
</x-guest-layout>