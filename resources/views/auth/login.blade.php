<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" required autocomplete="current-password">
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
                    <i class="fas fa-user-plus me-1"></i> {{ __('Register') }}
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
</x-guest-layout>