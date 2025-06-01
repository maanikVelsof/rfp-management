<x-guest-layout>

    <!-- Add Select2 CSS -->
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #86b7fe;
        }
        .select2-container--bootstrap-5 .select2-dropdown.select2-dropdown--below {
            border-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .is-invalid + .select2-container--bootstrap-5 .select2-selection {
            border-color: #dc3545;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
    @endpush

    <div class="vendor-register">
        <h4 class="text-center mb-4">Welcome to RFP Management System – Register as Vendor</h4>

        <form method="POST" action="{{ route('vendor.register') }}" id="vendorRegisterForm">
            @csrf

            <div class="row g-3">
                <!-- Name and Email Row -->
                <div class="col-md-6">
                    <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}">
                    <div class="error-message" id="name_error"></div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}">
                    <div class="error-message" id="email_error"></div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Row -->
                <div class="col-md-6">
                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password">
                    <div class="error-message" id="password_error"></div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation">
                    <div class="error-message" id="password_confirmation_error"></div>
                </div>

                <!-- Company Details Row -->
                <div class="col-md-4">
                    <label for="company_name" class="form-label">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                           id="company_name" name="company_name" value="{{ old('company_name') }}">
                    <div class="error-message" id="company_name_error"></div>
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="revenue" class="form-label">{{ __('Revenue (Last 3 Years in Lakh)') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('revenue') is-invalid @enderror" 
                           id="revenue" name="revenue" value="{{ old('revenue') }}" 
                           placeholder="e.g., 50.00">
                    <div class="error-message" id="revenue_error"></div>
                    @error('revenue')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="no_of_employees" class="form-label">{{ __('Number of Employees') }} <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('no_of_employees') is-invalid @enderror" 
                           id="no_of_employees" name="no_of_employees" value="{{ old('no_of_employees') }}" 
                           min="1">
                    <div class="error-message" id="no_of_employees_error"></div>
                    @error('no_of_employees')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- GST and PAN Row -->
                <div class="col-md-6">
                    <label for="gst_number" class="form-label">{{ __('GST Number') }}</label>
                    <input type="text" class="form-control @error('gst_number') is-invalid @enderror" 
                           id="gst_number" name="gst_number" value="{{ old('gst_number') }}" 
                           placeholder="15AABCU9603R1ZX">
                    <div class="error-message" id="gst_number_error"></div>
                    @error('gst_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="pan_number" class="form-label">{{ __('PAN Number') }}</label>
                    <input type="text" class="form-control @error('pan_number') is-invalid @enderror" 
                           id="pan_number" name="pan_number" value="{{ old('pan_number') }}" 
                           placeholder="ABCDE1234F">
                    <div class="error-message" id="pan_number_error"></div>
                    @error('pan_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone and Categories Row -->
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" 
                           id="phone_number" name="phone_number" value="{{ old('phone_number') }}" 
                           placeholder="10-digit mobile number">
                    <div class="error-message" id="phone_number_error"></div>
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="categories" class="form-label">{{ __('Categories') }} <span class="text-danger">*</span></label>
                    <select class="form-control @error('categories') is-invalid @enderror" 
                            id="categories" name="categories[]" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="error-message" id="categories_error"></div>
                    @error('categories')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Terms and Submit Section -->
            <div class="mt-4">
                <div class="form-check mb-3">
                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                           type="checkbox" id="terms" name="terms">
                    <label class="form-check-label" for="terms">
                        {{ __('I agree to the') }} <a href="#" class="text-primary">{{ __('Terms and Conditions') }}</a>
                    </label>
                    <div class="error-message" id="terms_error"></div>
                    @error('terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register as Vendor') }}
                    </button>
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
    </div>

    <!-- Add Select2 JS and Validation -->
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/vendor-registration.js') }}"></script>
    @endpush
</x-guest-layout> 