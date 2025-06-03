@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quotes List</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>RFP Number</th>
                                    <th>Item Name</th>
                                    <th>Vendor ID</th>
                                    <th>Price Per Unit</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Submitted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotes as $quote)
                                    <tr>
                                        <td>{{ $quote->rfp->rfp_number }}</td>
                                        <td>{{ $quote->rfp->item_name }}</td>
                                        <td>{{ $quote->vendor_id }}</td>
                                        <td>{{ number_format($quote->price_per_unit, 2) }}</td>
                                        <td>{{ $quote->quantity }}</td>
                                        <td>{{ number_format($quote->total_cost, 2) }}</td>
                                        <td>{{ $quote->submitted_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No quotes found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $quotes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
