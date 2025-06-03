@extends('layouts.admin')

@section('title', 'Create RFP')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New RFP</h1>
        <a href="{{ route('admin.rfps.index') }}" class="btn btn-secondary">
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

    <!-- RFP Creation Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.rfps.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Item Details -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('item_name') is-invalid @enderror" 
                                   id="item_name" name="item_name" value="{{ old('item_name') }}" >
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="item_description" class="form-label">Item Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('item_description') is-invalid @enderror" 
                                      id="item_description" name="item_description" rows="4" >{{ old('item_description') }}</textarea>
                            @error('item_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" >
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Price and Date Details -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_date" class="form-label">Last Date for Submission <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('last_date') is-invalid @enderror" 
                                   id="last_date" name="last_date" value="{{ old('last_date') }}" >
                            @error('last_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="minimum_price" class="form-label">Minimum Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('minimum_price') is-invalid @enderror" 
                                       id="minimum_price" name="minimum_price" value="{{ old('minimum_price') }}" >
                            </div>
                            @error('minimum_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="maximum_price" class="form-label">Maximum Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('maximum_price') is-invalid @enderror" 
                                       id="maximum_price" name="maximum_price" value="{{ old('maximum_price') }}" >
                            </div>
                            @error('maximum_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Category and Vendors Selection -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" >
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vendors" class="form-label">Select Vendors <span class="text-danger">*</span></label>
                            <select class="form-select @error('vendors') is-invalid @enderror" 
                                    id="vendors" name="vendors[]" multiple >
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ in_array($vendor->id, old('vendors', [])) ? 'selected' : '' }}>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple vendors</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Create RFP
                    </button>
                    <a href="{{ route('admin.rfps.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize select2 for better vendor selection
    $(document).ready(function() {
        $('#vendors').select2({
            placeholder: "Select vendors",
            allowClear: true
        });
    });
</script>
@endpush

@endsection
