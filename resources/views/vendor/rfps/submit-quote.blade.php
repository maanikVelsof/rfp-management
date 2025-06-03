@extends('layouts.vendor')

@section('title', 'Submit Quote')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Submit Quote for RFP #{{ $rfp->rfp_number }}</h1>
        <a href="{{ route('vendor.rfps.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to RFPs
        </a>
    </div>

    <!-- Alert Messages -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('vendor.quotes.store', $rfp->id) }}" method="POST" id="quoteForm">
                @csrf
                <input type="hidden" name="rfp_id" value="{{ $rfp->id }}">
                
                <div class="mb-3">
                    <label for="price_per_unit" class="form-label">Price Per Unit <span class="text-danger">*</span></label>
                    <input type="number" 
                           step="0.01" 
                           class="form-control @error('price_per_unit') is-invalid @enderror" 
                           id="price_per_unit" 
                           name="price_per_unit" 
                           value="{{ old('price_per_unit') }}">
                    <span id="price_per_unit_error" class="error-message text-danger"></span>
                    @error('price_per_unit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="item_description" class="form-label">Item Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('item_description') is-invalid @enderror" 
                              id="item_description" 
                              name="item_description" 
                              rows="3">{{ old('item_description') }}</textarea>
                    <span id="item_description_error" class="error-message text-danger"></span>
                    @error('item_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" 
                           class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" 
                           name="quantity" 
                           value="{{ old('quantity') }}">
                    <span id="quantity_error" class="error-message text-danger"></span>
                    @error('quantity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_cost" class="form-label">Total Cost</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" 
                               step="0.01"
                               class="form-control @error('total_cost') is-invalid @enderror" 
                               id="total_cost" 
                               name="total_cost" 
                               value="{{ old('total_cost') }}">
                    </div>
                    <span id="total_cost_error" class="error-message text-danger"></span>
                    @error('total_cost')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('vendor.rfps.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Submit Quote
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/vendor/velovalidation/velovalidation.js') }}"></script>
<script src="{{ asset('assets/js/submit-quote.js') }}"></script>
@endpush 