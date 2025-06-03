@extends('layouts.vendor')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Open RFPs</h1>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- RFPs Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%" class="align-middle">ID</th>
                            <th class="align-middle">RFP Number</th>
                            <th class="align-middle">RFP Name</th>
                            <th class="align-middle">Last Date</th>
                            <th class="align-middle">RFP Minimum Price</th>
                            <th class="align-middle">RFP Maximum Price</th>
                            <th class="align-middle">RFP Status</th>
                            <th width="15%" class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rfps as $rfp)
                            <tr>
                                <td class="align-middle">{{ $rfp->id }}</td>
                                <td class="align-middle">{{ $rfp->rfp_number }}</td>
                                <td class="align-middle">{{ $rfp->item_name }}</td>
                                <td class="align-middle">{{ $rfp->last_date }}</td>
                                <td class="align-middle">{{ number_format($rfp->min_price, 2) }}</td>
                                <td class="align-middle">{{ number_format($rfp->max_price, 2) }}</td>
                                <td class="align-middle">
                                    <span class="badge bg-success">Open</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex gap-2">
                                        <button type="button" 
                                                class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#quoteModal{{ $rfp->id }}">
                                            Apply
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Quote Modal for each RFP -->
                            <div class="modal fade" id="quoteModal{{ $rfp->id }}" tabindex="-1" aria-labelledby="quoteModalLabel{{ $rfp->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="quoteModalLabel{{ $rfp->id }}">Submit Quote for RFP #{{ $rfp->rfp_number }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('vendor.quotes.store', ['rfp' => $rfp->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rfp_id" value="{{ $rfp->id }}">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="price_per_unit" class="form-label">Price Per Unit</label>
                                                    <input type="number" step="0.01" class="form-control" id="price_per_unit" name="price_per_unit" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="item_description" class="form-label">Item Description</label>
                                                    <textarea class="form-control" id="item_description" name="item_description" rows="3" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_cost" class="form-label">Total Cost</label>
                                                    <input type="number" step="0.01" class="form-control" id="total_cost" name="total_cost" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit Quote</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No open RFPs available for quotation</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rfps->hasPages())
                <div class="d-flex justify-content-end mt-3">
                    {{ $rfps->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calculate total cost when price or quantity changes
    const calculateTotal = function(modalId) {
        const price = document.querySelector('#quoteModal' + modalId + ' #price_per_unit').value;
        const quantity = document.querySelector('#quoteModal' + modalId + ' #quantity').value;
        const total = price * quantity;
        document.querySelector('#quoteModal' + modalId + ' #total_cost').value = total.toFixed(2);
    };

    // Add event listeners to all quote modals
    @foreach($rfps as $rfp)
        const modal{{ $rfp->id }} = document.querySelector('#quoteModal{{ $rfp->id }}');
        if (modal{{ $rfp->id }}) {
            modal{{ $rfp->id }}.querySelector('#price_per_unit').addEventListener('input', function() { calculateTotal({{ $rfp->id }}); });
            modal{{ $rfp->id }}.querySelector('#quantity').addEventListener('input', function() { calculateTotal({{ $rfp->id }}); });
        }
    @endforeach
});
</script>
@endpush
@endsection
