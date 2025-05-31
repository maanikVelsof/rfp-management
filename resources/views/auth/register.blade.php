<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                name="password_confirmation" required autocomplete="new-password">
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
</x-guest-layout>
