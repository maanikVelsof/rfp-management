@extends('layouts.admin')

@section('title', 'Quotes')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotes</h1>
        <!-- You can add a button here if needed -->
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

    <!-- Quotes Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle">RFP Number</th>
                            <th class="align-middle">Item Name</th>
                            <th class="align-middle">Vendor ID</th>
                            <th class="align-middle">Price Per Unit</th>
                            <th class="align-middle">Quantity</th>
                            <th class="align-middle">Total Price</th>
                            <th class="align-middle">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr>
                                <td class="align-middle">{{ $quote->rfp->rfp_number }}</td>
                                <td class="align-middle">{{ $quote->rfp->item_name }}</td>
                                <td class="align-middle">{{ $quote->vendor_id }}</td>
                                <td class="align-middle">{{ number_format($quote->price_per_unit, 2) }}</td>
                                <td class="align-middle">{{ $quote->quantity }}</td>
                                <td class="align-middle">{{ number_format($quote->total_cost, 2) }}</td>
                                <td class="align-middle">{{ $quote->submitted_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No quotes found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($quotes->hasPages())
                <div class="d-flex justify-content-end mt-3">
                    {{ $quotes->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
