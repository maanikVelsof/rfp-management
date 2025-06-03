@extends('layouts.vendor')

@section('content')
<div class="container">
    <h2>{{ $rfp->item_name }} ({{ $rfp->rfp_number }})</h2>
    <p>{{ $rfp->item_description }}</p>
    <p><strong>Quantity:</strong> {{ $rfp->quantity }}</p>
    <p><strong>Last Date:</strong> {{ $rfp->last_date }}</p>

    <hr>
    <h4>Submit Your Quote</h4>

    <form method="POST" action="{{ route('vendor.quotes.store', $rfp->id) }}">
        @csrf

        <label>Price Per Unit</label>
        <input type="number" step="0.01" name="price_per_unit" required class="form-control mb-2">

        <label>Quantity</label>
        <input type="number" name="quantity" required class="form-control mb-2">

        <label>Item Description (Optional)</label>
        <textarea name="item_description" class="form-control mb-2"></textarea>

        <button class="btn btn-success">Submit Quote</button>
    </form>
</div>
@endsection
